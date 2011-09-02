<?php 
	class Router {
		public $parentURLArray = array(
			"login_action" =>array(SECTION_KEY => "user",ACTION_KEY=> "login") 
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
				$section = $this->URLArray[$name][SECTION_KEY];
				$action = $this->URLArray[$name][ACTION_KEY];
			} else if ($this->parentURLArray[$name]) {
				$section = $this->parentURLArray[$name][SECTION_KEY];
				$action = $this->parentURLArray[$name][ACTION_KEY];
			}
			$URL .= "?" .SECTION_KEY . "=" . $section . "&" . ACTION_KEY . "=" . $action;
			if ($paramsString) {
				$URL .= "&" . $paramsString;
			}
			return $URL;
 		}
	}
?>