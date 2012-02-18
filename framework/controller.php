<?php 
class _{
	static $global = array();
	static function assign ($key, $value,$section, $root = false) {
		if ($root) {
			if (!isset(_::$global[$key])) { 
				_::$global[$key] = $value; 
			} else {
			#report this
			}
		} else {
			if (!isset(_::$global[$section][$key])) {
				_::$global[$section][$key] = $value;	
			} else {
			#report this
			
			}
		}	
	}

}

class Controller extends _{
	public $assigned           = array();
	static $section            = null;
	static $action             = null;
	static $boxes              = array();
	static $global             = array();
	public $MAILER_LOADED      = false;
	public $isAJAX             = false;
    public $statuscodes_LOADED = false;
    public $router             = false;
    public $routers            = false;
	
	function __contruct() {
		//Controller::$global[$section] = array();
	}
	
	static function assign ($key,$value,$root = false) {
		_::assign($key, $value, Controller::$section, $root);
	}
    
	function routine () {
		$main_menu = array ("Inicio","Noticias","Eventos");
		$this->assign ("main_menu", $main_menu, true);

		//$register_url = $this->router->getURL(
		//Login assinging 
		if ($_SESSION['user']['logged']) {
			$this->assign ("logged", true, true); 
            

            $this->assign ("user_data" , array(
                "name"      => $_SESSION['user']['name'],
                "lastname"  => $_SESSION['user']['lastname'],
                "email"     => $_SESSION['user']['email'],
                "web_url_pic"=> $_SESSION['user']['web_url_pic']
            ), true);
            
            
		} else {
			$this->assign ("logged", false, true);
		}
        //Current user profile
        $current_user_profile = $this->router->getURL("profile");
        $this->assign('current_user_profile_url', $current_user_profile, true);
        $user_logout_Action = $this->router->getURL('logout_action');
        $this->assign('logout_action', $user_logout_Action, true);
        
        //Login action 
        //if ($this->routers['user']) {
        $login_action = $this->router->getURL("login_action");
        $this->assign("login_action", $login_action, true);
	}
	
	static function addBox($key, $template) {
		if (!isset(Controller::$boxes[$key])) {
			Controller::$boxes[$key] = array ();
		}	
		Controller::$boxes[$key][] = $template; 
	}
	
	function renderTemplete ($template, $variable) {
		$loader = new Twig_Loader_Filesystem (TEMPLATES);
		$twig = new Twig_Environment ($loader);
		$template = $twig->loadTemplate ($template);
		return $template->render ($variable);
	}
	/**
	 * @message hasta to be HTML
	 */
	function sendMail($subject= "", $email="", $name="", $msg="") {
	
		if (!$this->MAILER_LOADED) {
			$swift_path = PLUGINS . DS . 'mailswifter' . DS . 'lib' . DS . 'swift_required.php';
			__autoload($swift_path);
			$this->MAILER_LOADED = true;
		}
		//Create the Transport
		$transport = Swift_SmtpTransport::newInstance (MAIL_HOST, 25)
		  ->setUsername (MAILER_USER)
		  ->setPassword (MAILER_PASSWORD);
		//Create the Mailer using your created Transport
		$mailer = Swift_Mailer::newInstance ($transport);
		
		//Create a message
		$message = Swift_Message::newInstance ($subject)
		  ->setFrom (array (MAILER_USER => 'socialUABC.com'))
		  ->setTo (array ($email, $email => $name))
		  ->setBody ($msg,'text/html');
		  
		//Send the message
		$result = $mailer->send ($message);
		if (!$result) {
			#report mail failed
		}
	}
    
    function getStatusCodeDescription ($code) {
        if (!$this->statuscodes_LOADED) {
            $path = ROOT . DS . 'statuscodes.php';
            require_once($path);
            $this->statuscodes_LOADED = true;                  
        } 
        global $statuscodes;
        if (isset($statuscodes[$code])) {
            return $statuscodes[$code];         
        } else return false;   
    }
    
	function systemURLS() {
	 //  $    
	}
    
	function redirect($url) {
		header("Location:".$url);	
	}
    
   function getStream ($usr_id, $limit = false) {
         $return = array();
         $stream;
         $start  = 0; 
         $amount = 8;
         
         if ($limit['start']) {
            $start = $limit['start'];
         }
         if ($limit['amount']) {
            $amount = $limit['amount'];
         }
         
         $stream = $this->models['user']->getStream($usr_id, $start, $amount);
       
         if ($stream) {
             $return['items']  = $stream;
             $return['start']   = $start;
             $return['amount']  = $amount;
             return $return;
         } else return false;
    }
}


?>