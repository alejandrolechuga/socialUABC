<?php 
class userController extends Controller {
    public $models    = array ("friends");
    public $routers   = array ("friends");
    
	function __construct(){}
	function index () {}
	function add () {}
	function get () {
	    
        
	}
    
	function register ($args) {
		$this->isAJAX = isset($_POST['ajax']) ? true : false;
		$result['status'] = null;
		$result['success'] = false;
		
		#TODO 
		#[ ] Clean inputs
		#[ ] Validate Email
		#[ ] Validate Password
		#[x] Check if Email address exists
		#[x] Add to database
		#[x] Send Email for , or enable if cron not working think Cron Job?
		#[x] Template for email
		#[ ] Notice cliente in fails
		
 		$time = time();
		$email = trim($args['email']);
		$password = trim($args['password']);
		$token;
		$confirmation_url;
		$response = $this->models['user']->emailAccountExists($email);
		if ($response['success']) {
			$token = md5($time + $email);
			
			$response = $this->models['user']->add(array(
				"email" 			=> $email,
				"password"			=> $password,
				"registered_date" 	=> $time,
				"token" 			=> $token
			));
			
			$confirmation_url = $this->router->getURL("email_confirm",array (
				"token"	=> $token,
				"email"	=> $email
			));
			
			//Should be Using Template
			$html = $this->renderTemplete('user_mail_confirmation.tpl', array("confirmation_url" => $confirmation_url));
			$this->sendMail("Bienvenido a socialUABC confirma tu cuenta con el siguiente link", $email, $email, $html);
            				
			$result['success'] = true;
			$result['status'] = 1000;
		} else {
			//email already in use
			$result['success'] = false;
			$result['status'] = 1001;
		}
        
		if ($this->isAJAX) exit;
        $this->actionCase($result['status']);
	}

	function emailConfirm ($args) {
		$email = $args['email'];
		$token = $args['token'];
		$response = $this->models['user']->confirmEmailAccount($email, $token);
        
		if ($response['succes']) {
			#[x] Redirect to Profile
			#[ ] Login by confirmation 
 			$profile_url = $this->router->getURL("profile", array (
				"id"	=> $id
			));
			
			$this->redirect($profile_url);
		} else {
			#[ ] Redirect to Form-Register & Show Message
			//$register_form_url = $this->router->getURL();
			$this->actionCase($statusCode); 	
		}	
	}
	
	function edit ($args) {
	    if ($_SESSION['user']['logged']) {
        } else {
            //redirect
            
        }
        
        $id = $_SESSION['user']['id'];
        $user = $this->models['user']->get($id);
        $this->assign("profile_data", $user);
        switch ($args['sub']) {
            case "edit_info":     
            case "edit_networks":
            break;
        }
	}
	
	function checkUser() {}
	function delete() {}
	function block() {}
	function report() {}
	function ban () {}
	function mailLogin() {}
	function login ($args) {
		
		#[ ] clean inputs 
		#[ ] validate
		#[ ] check if is already logged

		$email 		= $args['email'];
		$password	= $args['password'];
		if ($password && $email) {
			$record = $this->models['user']->logIn(array(
				"email"		=> $email, 
				"password"	=> $password
			));
		} else {
			//No valid arguments 
			$return['status'] = 1002;
			$return['error'] = true;
			$return['success'] = false; 
		}
		
		if ($record) {
			if ($record['account_confirmed'] == 1) {
				if ($record['password'] == $password) {
					//Successful login
					$return['status'] = 1000;
					$return['success'] = true; 
				} else {
					//The password doesn't match
					$return['status'] = 1003;
					$return['success'] = false;
				}
			} else {
				//Account not confirmed yet
				$return['status'] = 1005;
				$return['success'] = false;	
			}
		} else {
			//The email doesn't exist
			$return['status'] = 1006;
			$return['success'] = false;
		}
		if ($return['success']) {
			$_SESSION['user'] = array();
			$_SESSION['user']['logged'] = true;
			$_SESSION['user']['email'] = $email;
			$_SESSION['user']['password'] = $password;
			$_SESSION['user']['name'] = $record['name'];
            $_SESSION['user']['lastname'] = $record['lastname'];
			$_SESSION['user']['id'] = $record['id'];
			$id = $record['id'];
			$url =  $profile_url = $this->router->getURL("profile",array (
				"id"	=> $id
			));
			#Redirecting to User Profile
			$this->redirect($url);
		}
        $this->actionCase($return['status']);
	}

	function actionCase ($statusCode) {
	    $url;
	    switch ($statusCode) {
            case 1001:
            case 1003:
            case 1004:
            case 1005:
            case 1006:
            case 1007:
                $url = $this->router->getURL("root", array(
                    "statuscode" => $statusCode
                ));
                $this->redirect($url);  
            break;
	    }
	}
    
	function logout(){
		session_destroy();
        $this->redirect(WEB_URL);
	}
    
	function changeEmail(){
	}
	function changePassword(){
	}
	function cancelAccount(){
	}
	function getFriends(){
	}
	function addFriendship(){
	}
	function deleteFriendship(){
	}
    
	function inviteFriends(){
	}
	
	function findFriends() {
	}
    /** 
     * @todo
     * validate arguments inputs
     */
    /**
     * @todo 
     * -validate arguments inputs
     */
	function profile ($args){
	    
	    //Get networks
	    if ($_SESSION['user']['logged']) {	   
	       $id;
           $isMe = false; 
           
	       if ($args['id']) {
	           $id = $args['id']; 
	       } else {
	           $id = $_SESSION['user']['id'];
                    
	       }
           
	       $user = $this->models['user']->get($id);
           $profile_data = array();

           $profile_data['name'] = $user['name'];
           $profile_data['lastname'] = $user['lastname'];
            //Networks
            $networks = false;
            if (isset($user['facebook'])) {
                $networks = array();
                
                if ($user['facebook'] != "-1") {
                    $networks['facebook'] = $user['facebook'];
                }   
            
                if ($user['twitter'] != "-1") {
                    $networks['twitter'] = $user['twitter'];
                }

                if ($user['gplus'] != "-1") {
                    $networks['gplus'] = $user['gplus'];
                }
            
                if ($user['flickr'] != "-1") {
                    $networks['flickr'] = $user['flickr'];
                }
            
                if ($user['linkedin'] != "-1") {
                    $networks['linkedin'] = $user['linkedin'];
                } 
            
                if ($user['scribd'] != "-1") {
                    $networks['scribd'] = $user['scribd'];
                } 
            
                if ($user['tumblr'] != "-1") {
                    $networks['tumblr'] = $user['tumblr'];
                }
                if ($user['youtube'] != "-1") {
                    $networks['youtube'] = $user['youtube'];
                }
             }
             $profile_data['networks'] = $networks;
             
             //Info
                //Location 
             $location = array();
             if ($user['born_city_text'] != -1) {
                $location["born_city"] = $user['born_city_text'];     
             }
             if ($user['live_city_text'] != -1) {
                 $location["live_city"] = $user['live_city_text'];
             }
             $profile_data['location'] = $location;
                //education
             $education = false;
             if ($user['education'] != -1) {
                $profile_data['education'] = $user['education'];  
             }
                //occupation
             if ($user['occupation'] != -1) {
                 $profile_data['occupation'] = $user['occupation'];
             }
            // console($profile_data);
             $this->assign("profile_data", $profile_data);
             
             //Stream
                //Entrybox input action
                $entry_box_url = $this->router->getURL("entry_box_action", array (
                    "id" => $_SESSSION['user']['id']
                ));
                
                $this->assign("entry_box_action", $entry_box_url);
                //Stream feed
                
             $stream = array(); 
             $streamData = $this->getStream ($id);;  
             if ($streamData) {
                 //console($streamData);
                 $items = $streamData['items'];
                 $itemsLength = count($items);
                 for ($i = 0; $i < $itemsLength; $i++) {
                    $item = $items[$i]; 
                    //console($item);
                    $posted_by = $item['posted_by'];
                    if ($posted_by == $id || $posted_by == 0 ) {
                        //echo
                        //$items[$i]['posted_by']['id'] = $id;
                        $items[$i]['posted_by']  = $_SESSION['user'];
                    } else {
                        $friend = $this->models["friends"]->getFriendInfo($posted_by); 
                    }
                    //exit;
                    //$this->   
                 }
             }
             
             $stream['items'] = $streamData['items'];
             $stream['start'] = $streamData['start'];
             $stream['amount'] = $streamData['amount'];
             
             
             $this->assign ("stream", $stream);
             $this->assign ("show_more_posts" , false);
             
             //Get Notifications
             $notifications = $this->getNotifications($id);
             //Friend Reuqests
             if ($notifications['request']) {
                 $friendRequests = $notifications['request'];
                 $friendRequestsLength = count($friendRequests); 
                 ///echo $friendRequestsLength;
                 for ($i = 0 ; $i < $friendRequestsLength; $i++) {
                     
                     $user_info = $this->models['friends']->getFriendInfo($id);
                     if ($user_info['success']) {
                        $friendRequests[$i]['user'] = $user_info['result'];
                        $add_friend_url = $this->routers['friends']->getURL("add_friend");
                        $friendRequests[$i]['user']['add_friend_url'] = $add_friend_url; 
                        $remove_friend_url = $this->routers['friends']->getURL("reject_friend");
                        $friendRequests[$i]['user']['reject_friend_url'] = $remove_friend_url; 
                     }    
                 }
                 $this->assign("friend_requests", $friendRequests);           
             }      

                   
        } else {
           //Redirect 
        } 
	}
    
    function getNotifications ($user_id) {
        $return = array();
        // Getting Friend Request Notifications
        $resp = $this->models['friends']->getFriendRequests($user_id);
        if ($resp) {
            $return['request'] = $resp;  
            return $return; 
        } else return false;
    }
    
    function getFriendList () {
      $return = array();
      $resp = $this->models['friends']->getFriends();
        
    }
    
    
    
	function profileSettings(){
	}
	function editProfileSettings(){
	}
	function sendMessage(){
	}
	function readMessage(){
	}
	function deleteMessage(){
	}
	function messagesInbox(){
	}
	function sentMessageInbox(){
	}
	function addComment(){

	}
	function deleteComment(){
	}
    
	function addPost ($params){
	    $output = array('success'=> false);
	    #[ ] santizate the input
        $input = $params['post'];
        $time   = time();
        $user_id = $_SESSION['user']['id'];
        $response = $this->models['user']->addPost($input, $_SESSION['user']['id'], $time);
        
        if ($response['success']) {
           $output['success'] = true; 
           $output['time'] = $time;
           $output['text'] = $input;
           $output['id'] = $response['id'];
        } 
        
        return $output;
	}
    
    function removePost($params) {
        $output = array ('success' => false);
        #[ ] sanatize input
        $id = $params['id'];
        $response = $this->models['user']->removePost($id);
        if ($response['success']) {
            $output['success'] = true;
            $output['id'] = $id;
        }
        return $output;
    }
    
    function readMorePosts ($params) {
          
    }
}

?>