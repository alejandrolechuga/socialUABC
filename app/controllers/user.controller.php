<?php 
class userController extends Controller {
    public $models    = array ("friends","photos");
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
			$html = $this->renderTemplete('user_mail_confirmation.tpl', array(
			 "confirmation_url" => $confirmation_url,
			 "img_path" => WEB_IMG 
            ));
            
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

    /**
     * @todo validate email input agaisnt hack
     * 
     * @method recovery
     * @param $args
     */
    function recovery ($args) {
        $email = trim($args['recovery_email']);
        $time = time();
        $response = $this->models['user']->getUserByEmail($email);
        if ($response) {
           $email = $response['email'];
           $id =  $response['id'];
           $token = md5($time + $email);
           
           $recovery_url = $this->router->getURL("reset_password",array (
                "token" => $token,
                "email" => $email
           ));
           ///echo $recovery_url;
           
           $recovery = $this->models['user']->setRecoveryToken($id, $token);
           if ($recovery['success']) {
               $html = $this->renderTemplete('user_mail_password_recovery.tpl', array(
                    "recovery_url" => $recovery_url,
                    "img_path" => WEB_IMG 
               ));
               $this->sendMail("socialUABC.com solicitud para cambiar tu contraseña", $email, $email, $html);
           } 
           $this->actionCase(1010);
        } else {
            //email already in use
            //$result['success'] = false;
            //$result['status'] = 1001;
        }
    }
    /**
     * @todo if user is already logged  logout him 
     * @todo sanatize inputs
     * @todo use captchas!! 
     */
    function resetPassword ($args) {
        $token = $args['token'];
        $email = $args['email'];
        $response = $this->models['user']->isTokenRightForEmail($email, $token);
        if ($response['success']) {
            //echo "success";
            $this->assign("show_reset_password", true, true);
            $this->assign("user_id",$response['result']['id']); 
            $this->assign("user_email", $email);
            $this->assign("user_token", $token);
            
            if ($args['statuscode']) {
                $this->checkStatusCode($args['statuscode']);
            }
            
        } else {
            // IF the token or email aren't right
            $this->actionCase(1012);
        }
    }
    
    /**
     * @todo use captchas!!
     * @todo update new password
     * @todo validate if the pasword is correct
     * @todo show status error y the password is incorrect
     * @todo sanatize inputs 
     * @todo new token to change the password
     * @todo validate all cases
     */
    function resetPasswordAction ($args) {
        $new_password = $args["new_password"];
        $confirmed_password = $args["confirmed_password"];
        $user_id = $args["user_id"];
        $token = $args['user_token'];
        $email = $args['user_email'];
        
        if ($confirmed_password != "" && $confirmed_password != ""  && $new_password == $confirmed_password && $user_id) {
           $response = $this->models['user']->updatePassword($user_id, $confirmed_password);
           if ($response['success']) {
              $response = $this->models['user']->removeToken($user_id);    
              //echo "su password ha cambiado exitosamente";
              $this->actionCase(1011);     
           } else {
              //echo "no cambio algun error ";  
           }
        } else {
            $url = $this->router->getURL("reset_password",array(
               'token' => $token, 
               'email' => $email,
               'statuscode' => 1013 
            ));
            $this->redirect($url);
        }
    }
    /**
     * @todo sanatize inputs
     * 
     */
	function emailConfirm ($args) {
		$email = $args['email'];
		$token = $args['token'];
		$response = $this->models['user']->confirmEmailAccount($email, $token);
        console($response);
		if ($response['success']) {
			#[x] Redirect to Profile
			#[ ] Login by confirmation 
			$data = $response['data'];
			$this->buildUserData($data);
 			$profile_url = $this->router->getURL("profile", array (
				"id"	=> $data['id']
			));
			$this->redirect($profile_url);
		} else {
			#[ ] Redirect to Form-Register & Show Message
			//$register_form_url = $this->router->getURL();
			$this->actionCase($statusCode); 	
		}	
	}
    
	function buildUserData ($data) {
	   print_r($data); 
	   $this->models['photos']->createDefaultAlbums($data);     
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
            case "edit_photo":
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
			$_SESSION['user']['logged']      = true;
			$_SESSION['user']['email']       = $email;
			$_SESSION['user']['password']    = $password;
			$_SESSION['user']['name']        = $record['name'];
            $_SESSION['user']['lastname']    = $record['lastname'];
			$_SESSION['user']['id']          = $record['id'];
            $_SESSION['user']['web_url_pic'] = $record['web_url_pic'];
            
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
            case 1010:
            case 1011:
            case 1012:    
                $url = $this->router->getURL("root", array(
                    "statuscode" => $statusCode
                ));
                $this->redirect($url);  
            break;
	    }
	}
    
    function checkStatusCode ($statusCode) {
        switch ($statusCode) {
            case 1013:
                $details = $this->getStatusCodeDescription($statusCode);
                $this->assign("top_message", array (
                    "title"             => $details['title'],
                    "message"           => $details['message'],
                    "top_message_right" => true        
                ), true);
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
             
             if ($user['web_url_pic']) {
                 $profile_data['web_url_pic'] = $user['web_url_pic'];   
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
             $streamData = $this->getStream($id);  
             if ($streamData) {
                 //console($streamData);
                 $items = $streamData['items'];
                 $itemsLength = count($items);
                 for ($i = 0; $i < $itemsLength; $i++) {
                    $item = $items[$i]; 
                    $items[$i]['formatted_date'] = $this->defaultFormatDate($items[$i]['date']); 
                    //console($item);
                    $posted_by = $item['posted_by'];
                    if ($posted_by == $id || $posted_by == 0 ) {
                        //echo
                        //$items[$i]['posted_by']['id'] = $id;
                        $items[$i]['posted_by']  = $_SESSION['user'];
                    } else {
                        $friend = $this->models["friends"]->getFriendInfo($posted_by); 
                        $items[$i]['posted_by']  = $friend['result'];
                        $friendProfile_url = $this->routers['friends']->getURL("friendProfile",array ("id"=>$posted_by));
                        $items[$i]['posted_by']['profile_url'] = $friendProfile_url;
                    }
                    
                    // Get Comments
                    $comments = $this->models['user']->getCommentsByItem($items[$i]['id'], 1);
                    
                    if ($comments['success']) {
                        $items[$i]['comments'] = $comments['results'];
                        $commentsLength = count($items[$i]['comments']);

                        for ($j = 0 ; $j < $commentsLength; $j++) {
                            $user_id = $items[$i]['comments'][$j]['user_id'];
                            $items[$i]['comments'][$j]['formatted_date'] =  $this->defaultFormatDate($items[$i]['comments'][$j]['date']);
                            if ($user_id == $id || $user_id == 0 ) {
                                $items[$i]['comments'][$j]['posted_by'] = $_SESSION['user']; 
                            } else {
                                $friend = $this->models["friends"]->getFriendInfo($user_id);
                                $items[$i]['comments'][$j]['posted_by'] = $friend['result'];
                                $friendProfile_url = $this->routers['friends']->getURL("friendProfile", array ("id" => $user_id));
                                $items[$i]['comments'][$j]['posted_by']['profile_url'] = $friendProfile_url;
                                 
                            }    
                        } 
                        //console($items[$i]);exit;
                    }
                 }
                 $streamData['items'] = $items;
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

            $friendList = $this->getFriendList($id);
            if ($friendList) {
                $this->assign("friend_set", $friendList);
            }
                   
        } else {
           //Redirect 
        } 
	}

    /**
     * @method  getNotifications
     * @param int $user_id
     * @return boolean | array 
     */
    function getNotifications ($user_id) {
        $return = array();
        // Getting Friend Request Notifications
        $resp = $this->models['friends']->getFriendRequests($user_id);
        if ($resp) {
            $return['request'] = $resp;  
            return $return; 
        } else return false;
    }
    
    function getFriendList ($userId) {
        $return = array();  
        $resp = $this->models['friends']->getFriends($userId);
        if ($resp['success']) {
            //Do your things!
            $length = count($resp['results']);

            for ($i = 0; $i < $length; $i++) {
                $id = $resp['results'][$i]['id'];
                $friendId;
                if ($resp['results'][$i]['a'] != $userId) {
                    $friendId = $resp['results'][$i]['a'];
                } else {
                    $friendId = $resp['results'][$i]['b'];
                }
                $result = $this->models['friends']->getFriendInfo($friendId);
                $resp['results'][$i]['user'] = $result['result'];
                unset($result); 
                $friendProfileURL = $this->routers['friends']->getURL("friendProfile",array("id"=>$friendId));   
                $resp['results'][$i]['user']['profileURL'] = $friendProfileURL;
            }
            return $resp['results'];
        } else {
            return false;
        }
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

    // -- Posts
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
           $output["user"]['web_url_pic']  = $_SESSION['user']['web_url_pic']; 
           $output["user"]['name']         = $_SESSION['user']['name'];
           $output["user"]['lastname']     = $_SESSION['user']['lastname'];
           $output["user"]['id']           = $_SESSION['user']['id'];
           $output["user"]['email']        = $_SESSION['user']['email'];
           $urlProfile = $this->router->getURL("profile", array ("id" => $output["user"]['id']));
           $output["user"]['profile_url'] = $urlProfile; 
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
    
    // -- Posts
    function uploadProfilePic ($args) {
        $this->uploadPhoto($args);
    }
}

?>