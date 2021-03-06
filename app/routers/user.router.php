<?php 

	class userRouter extends Router{
		public $URLArray = array (
			"register_action"        => array(SECTION_KEY => "user", ACTION_KEY => "register") ,
			"email_confirm"          => array(SECTION_KEY => "user", ACTION_KEY => "emailConfirm"),
			"profile"                => array(SECTION_KEY => "user", ACTION_KEY => "profile"),
			"profile_edit"           => array(SECTION_KEY => "user", ACTION_KEY => "profile_edit"),
			"entry_box_action"       => array(SECTION_KEY => "user", ACTION_KEY => "addPost"),
			"remove_post_action"     => array(SECTION_KEY => "user", ACTION_KEY => "removePost"),
			"read_more_posts_action" => array(SECTION_KEY => "user", ACTION_KEY => "readMorePosts"),
            
			"uploadProfilePic"       => array(SECTION_KEY => "user", ACTION_KEY => "uploadProfilePic"),
			"reset_password"         => array(SECTION_KEY => "user", ACTION_KEY => "resetPassword"),
			"reset_password_action"  => array(SECTION_KEY => "user", ACTION_KEY => "resetPasswordAction")
		);
        
		function index () {
			return array(
				"register_action"   => $this->getURL("register_action"),
				"login_action"      => $this->getURL("login_action"),
				"logout_action"     => $this->getURL("logout_action"),
                "activity"          => $this->getURL("activity"),
                "newUsers"          => $this->getURL("newUsers") 			
			);	
		}
        
        function profile () {
            return array(
                "logout_action"             => $this->getURL("logout_action"),
                "remove_post_action"        => $this->getURL("remove_post_action"),
                "read_more_posts_action"    => $this->getURL("read_more_posts_action"),
                "activity"                  => $this->getURL("activity"),
                "newUsers"                  => $this->getURL("newUsers"),
                "add_friend"                => $this->getURL("add_friend"),
                "reject_friend"             => $this->getURL("reject_user"),
                "add_comment"               => $this->getURL("add_comment"),
                "remove_comment"            => $this->getURL("remove_comment")
            );
        }
        
        function friendProfile () {
            
        }
        
        function edit () {
            return array (
                "edit_profile_pic"  => $this->getURL("edit", array(
                    "sub" => "edit_profile_pic"
                )),
                "edit_info"         => $this->getURL("edit", array(
                    "sub" => "edit_info"
                )),
                "edit_networks"     => $this->getURL("edit", array(
                    "sub" => "edit_networks"
                )),
                "edit_friends"      => $this->getURL("edit", array(
                    "sub" => "edit_friends"
                )),
                "activity"          => $this->getURL("activity"),
                "newUsers"          => $this->getURL("newUsers"),
                "action_user_edit_photo_upload" => $this->getURL("uploadProfilePic")
            );
        }
	}
?>