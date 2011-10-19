<?php 

	class friendsRouter extends Router{
		public $URLArray = array (
			"register_action" => array(SECTION_KEY => "user",ACTION_KEY=> "register") ,
			"email_confirm" => array(SECTION_KEY => "user",ACTION_KEY=> "emailConfirm"),
			"profile" => array(SECTION_KEY => "user",ACTION_KEY=> "profile") 
		);
		function index() {
			return array(
				"register_action" => $this->getURL("register_action"),
				"login_action" =>$this->getURL("login_action") 			
			);	
		}
	}

?>