<?php 
	class Router {
	    
		public $parentURLArray = array (
		    #bootstrap
		    "activity"           => array (SECTION_KEY => "bootstrap", ACTION_KEY => "activity"),
		    
		    #friend
		    "newUsers"           => array (SECTION_KEY => "friends", ACTION_KEY => "newUsers"),
		    "friendProfile"      => array (SECTION_KEY => "friends", ACTION_KEY => "friendProfile"),
		    "events"             => array (SECTION_KEY => "events"),
		    
		    #user
			"login_action"       => array (SECTION_KEY => "user", ACTION_KEY => "login"),
			"logout_action"      => array (SECTION_KEY => "user", ACTION_KEY => "logout"),
			"edit"               => array (SECTION_KEY => "user", ACTION_KEY => "edit"),
			"profile"            => array (SECTION_KEY => "user", ACTION_KEY => "profile"),
            "register_action"    => array (SECTION_KEY => "user", ACTION_KEY => "register"),
            "recovery_action"    => array (SECTION_KEY => "user", ACTION_KEY => "recovery"),
            #add comment
            "add_comment"            => array(SECTION_KEY => "user", ACTION_KEY => "addComment"),
            "remove_comment"         => array(SECTION_KEY => "user", ACTION_KEY => "removeComment")
		); 
		
		function getURL($name,$params= array()) {
			$URL = WEB_URL . DS;
			$paramsString = false;
			$section;
			$action;
			if(is_array($params)) {
				$paramsString = http_build_query ($params);	
			}
			
			if ($this->URLArray[$name]){
				$section    = $this->URLArray[$name][SECTION_KEY];
				$action     = $this->URLArray[$name][ACTION_KEY];
			} else if ($this->parentURLArray[$name]) {
				$section    = $this->parentURLArray[$name][SECTION_KEY];
				$action     = $this->parentURLArray[$name][ACTION_KEY];
			}
			if ($section != "") {
			    $URL .= "?" .SECTION_KEY . "=" . $section . "&" . ACTION_KEY . "=" . $action;
                if ($paramsString) {
                    $URL .= "&" . $paramsString;
                }
            } else if ($paramsString) {
                $URL .= "?". $paramsString;
                    
            }
            
			return $URL;
 		}
	}
?>