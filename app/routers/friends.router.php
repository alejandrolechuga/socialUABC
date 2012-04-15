<?php 

	class friendsRouter extends Router{
		public $URLArray = array (
			"register_action"        => array(SECTION_KEY => "user", ACTION_KEY => "register") ,
			"email_confirm"          => array(SECTION_KEY => "user", ACTION_KEY => "emailConfirm"),
			"friendProfile"          => array(SECTION_KEY => "friends", ACTION_KEY=> "friendProfile"),
            "sendFriendRequest"      => array(SECTION_KEY => "friends", ACTION_KEY => "sendFriendRequest"),
            "add_friend"             => array(SECTION_KEY => "friends", ACTION_KEY => "addFriend"),
            "reject_friend"          => array(SECTION_KEY => "friends", ACTION_KEY => "rejectFriend"),
            "entry_box_action"       => array(SECTION_KEY => "friends", ACTION_KEY => "addPostToFriend"),
            "add_comment"            => array(SECTION_KEY => "friends", ACTION_KEY => "addComment"),
            "remove_comment"         => array(SECTION_KEY => "friends", ACTION_KEY => "removeComment")
		);
        
		function index() {
			return array(
				"register_action"        => $this->getURL("register_action"),
				"login_action"           => $this->getURL("login_action"),
				"add_comment"            => $this->getURL("add_comment"),
                "remove_comment"         => $this->getURL("remove_comment")
			);	
		}
        
        function friendProfile () {
            return array(
                "add_comment"            => $this->getURL("add_comment"),
                "remove_comment"         => $this->getURL("remove_comment")
            );
        }
		
		
	}

?>