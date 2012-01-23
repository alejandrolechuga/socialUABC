<?php 

	class friendsRouter extends Router{
		public $URLArray = array (
			"register_action"        => array(SECTION_KEY => "user", ACTION_KEY => "register") ,
			"email_confirm"          => array(SECTION_KEY => "user", ACTION_KEY => "emailConfirm"),
			"friendProfile"          => array(SECTION_KEY => "friends", ACTION_KEY=> "friendProfile"),
            "sendFriendRequest"      => array(SECTION_KEY => "friends", ACTION_KEY => "sendFriendRequest"),
            "add_friend"               => array(SECTION_KEY => "friends", ACTION_KEY => "addFriend"),
            "reject_friend"            => array(SECTION_KEY => "friends", ACTION_KEY => "rejectFriend"),
            "entry_box_action"       => array(SECTION_KEY => "friends", ACTION_KEY => "addPostToFriend")
		);
        
		function index() {
			return array(
				"register_action" => $this->getURL("register_action"),
				"login_action" =>$this->getURL("login_action")
			);	
		}
	}

?>