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
                "id"            => $_SESSION['user']['id'],
                "name"          => $_SESSION['user']['name'],
                "lastname"      => $_SESSION['user']['lastname'],
                "email"         => $_SESSION['user']['email'],
                "web_url_pic"   => $_SESSION['user']['web_url_pic']
            ), true);
            
            $this->assign ("edit_info", $this->router->getURL ("edit", array (
                "sub" => "edit_info"
            )), true);
                                    
		} else {
			$this->assign ("logged", false, true);
		}
        //Current user profile
        $current_user_profile = $this->router->getURL ("profile");
        $this->assign ('current_user_profile_url', $current_user_profile, true);
        $user_logout_Action = $this->router->getURL ('logout_action');
        $this->assign ('logout_action', $user_logout_Action, true);
        //Login action 
        //if ($this->routers['user']) {
        $login_action = $this->router->getURL ("login_action");
        $this->assign ("login_action", $login_action, true);
        
        $recovery_action = $this->router->getURL ("recovery_action");
        $this->assign ("recovery_action", $recovery_action, true);
        
        $reset_password_action = $this->router->getURL ("reset_password_action");
        $this->assign ("reset_password_action", $reset_password_action, true);
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
   
    function addComment ($args) {
       $return = array (
           "success" => false
       ); 
       $text = $args["text"];
       $item_id = $args["item_id"];
       $type = $args["type"];
       $type_id = null;
       $user_id = $id = $_SESSION['user']['id'];
       
       switch ($type) {
           case "post":
               $type_id = 1; 
               break;
           case "photos":
               $type_id = 2;
               break;
       }
       
        $response = $this->models['user']->addComment(array( 
            "text"      => $text,
            "item_id"   => $item_id,
            "type"      => $type_id,
            "user_id"   => $user_id,
            "date"      => time()
        ));
        
        if ($response) {
            $return["success"] = true;
            $return["text"] =  $text;
            $return['comment_id'] = $response['id'];
            $return["user"]['web_url_pic']  = $_SESSION['user']['web_url_pic']; 
            $return["user"]['name']         = $_SESSION['user']['name'];
            $return["user"]['lastname']     = $_SESSION['user']['lastname'];
            $return["user"]['id']           = $_SESSION['user']['id'];
            $return["user"]['email']        = $_SESSION['user']['email'];
            $urlProfile = $this->router->getURL("profile", array ("id" => $return["user"]['id']));
            $return["user"]['profile_url'] = $urlProfile; 
            
        }
        return $return;
    }
    
    function removeComment ($args) {
        $return = array(
            "success" => false
        );
        $comment_id = $args['comment_id'];
        $response = $this->models['user']->removeComment(array( 
            "comment_id"      => $comment_id
        ));
        
        if ($response) {
            $return = array(
                "success" => true,
                "response" => $response
            );                
        }
        return $return;
    }
    
    function convertToHumanTime ($epoc) {
        $formattedDate = "1111111";
        return $formattedDate;       
    }
    
    function defaultFormatDate($fecha) {
        $months = array();
        $months [] = "Enero";
        $months [] = "Febrero";
        $months [] = "Marzo";
        $months [] = "Abril";
        $months [] = "Mayo";
        $months [] = "Junio";
        $months [] = "Julio";
        $months [] = "Agosto";
        $months [] = "Septiembre";
        $months [] = "Octubre";
        $months [] = "Noviembre";
        $months [] = "Diciembre";
        $diferencia = time() - $fecha;
        $tiempo;
        if($diferencia < 60) {
            $tiempo = "Hace menos de 1 minuto.";
        }
        else {
            if($diferencia < 60*60) {
                $tiempo = "Hace ".(int) date("i", $diferencia);
                if(date("i", $diferencia) == 1) {
                    $tiempo .= " minuto.";
                }
                else {
                    $tiempo .= " minutos.";
                }
            }
            else {
                if($diferencia < 60*60*24) {
                    $tiempo = "Hace ".(int) date("H", $diferencia);
                    if(date("H", $diferencia) == 1) {
                        $tiempo .= " hora.";
                    }
                    else {
                        $tiempo .= " horas.";
                    }
                }
                else {
                    $hora = (int) date("H", $fecha).":".date("i", $fecha);
                    $tiempo = $months[(int) date("m", $fecha) - 1]." ".(int) date("d", $fecha)." de ".date("Y", $fecha);
                    if(date("G", $fecha) < 13) {
                        $hora .= " am.";
                    }
                    else {
                        $hora .= " pm.";
                    }
                    if(date("H", $fecha) == 1) {
                        $tiempo .= " a la ". $hora;
                    }
                    else {
                        $tiempo .= " a las ". $hora;
                    }
                }
            }
        }
        return $tiempo;
    } 
}


?>