<?php 
class userController extends Controller {
	function __construct(){}
	function index(){}
	function add(){}
	function get(){}
	
	function register($args) {
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
		#[ ] Template for email
		#[ ] Notice cliente in fails
		
 		$time = time();
		$email = $args['email'];
		$password = $args['password'];
		$token;
		$confirmation_url;
		
		if (!$this->models['user']->emailAccountExists($email)) {
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
	}
	
	function emailConfirm ($args) {
		$email = $args['email'];
		$token = $args['token'];
		$response = $this->models['user']->confirmEmailAccount($email, $token);
		if ($response['succes']) {
			#[ ] Redirect to Profile
			#[ ] Login by confirmation 
 			$profile_url = $this->router->getURL("profile",array (
				"id"	=> $id
			));
			$this->redirect($profile_url);
		} else {
			#[ ] Redirect to Form-Register & Show Message
			//$register_form_url = $this->router->getURL();
			$this->redirect($register_form_url);	
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
		$email = $args['email'];
		$password = $args['password'];
		if ($password && $email) { 
			$record = $this->models['user']->logIn(array(
				"email"		=> $email, 
				"password"	=> $password
			));
		} else {
			//No valid arguments 
			$return['status'] = 102;
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
			$return['status'] = 1004;
			$return['success'] = false;
		}
	}
	
	function logout(){
		session_detroy();
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
	function findFriends(){
	}
	function profile(){
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
		$aaa = "
			baboso
			mierda
			maricon
			culo
			culon
			puta
			puto
			culero
			pendejo
			cabron
			chingado
			chingon
			fuck";
	}
	function deleteComment(){
	}
	function addPost(){
	}
	function deletePost(){
	}
}

?>