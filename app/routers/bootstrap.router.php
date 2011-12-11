<?php 
	class bootstrapRouter extends Router{
		public $URLArray = array (
			"register_action" => array(SECTION_KEY => "user",ACTION_KEY=> "register"), 
		);

		function index() {
			return array(
				"register_action"   => $this->getURL("register_action"),
				"login_action"      => $this->getURL("login_action"),
				"logout_action"     => $this->getURL("logout_action"),
				"profile"           => $this->getURL("profile")
			);	
		}
	}
?>