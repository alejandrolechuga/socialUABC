<?php 
	class userModel extends Model{
	    function __construct(){}
		function index(){}
		
        function get ($id) {
            $query =
            "SELECT 
                 `id`, 
                 `name`,
                 `lastname`,
                 `password`, 
                 `email`,
                 `education`,
                 `occupation`,
                 `account_confirmed`,
                 `live_city_text`,
                 `born_city_text`,
                 
                 `facebook`,
                 `twitter`,
                 `gplus`,
                 `flickr`,
                 `linkedin`,
                 `scribd`,
                 `tumblr`,
                 `youtube`,
                 
                 `profile_pic_name`,
                 `abs_path_pic`,
                 `web_url_pic`
            FROM `user` WHERE `id` = '".$id."'";
            $this->connect();
            $this->query($query);
            $record = $this->nextRecord();
            if ($record) {
                return $record;
            } else return false;
        }
        
		function add($args) {
			$email 				= $args['email'];
			$password 			= $args['password'];
			$registered_date 	= $args['registered_date'];
			$token				= $args['token'];
			
			$query = 
			"INSERT INTO `user` (
				`email`,
				`password`,
				`registered_date`,
				`token_email_confirmation`
			) 
			VALUES (
				'"	. $email . "',
				'" . $password . "',
				" . $registered_date . ",
				'" . $token . "'
			);";
			
			$this->connect();
			
			if ($this->query($query)) {
			    
				$return = array(
					"status"   => 1000,
					"id"       => $this->lastInsertId(),
					"success"  => true
				);
				
			} else {
				$return = array(
					"status"   => 2001,
					"success"  => false,
					"id"       => false
				);
			}
			return $return;
		}
		
		function setRecoveryToken ($id , $token) {
		    $return = array();
		    $query = "UPDATE `user` 
            SET 
                `user`.`token_recovery_email` = '" . $token . "' 
            WHERE 
                `user`.`id` = " . $id;
            
            $this->connect();
            if ($this->query($query)) {  
                $return = array(
                    "status"   => 1000,
                    "id"       => $this->lastInsertId(),
                    "success"  => true
                );
                
            } else {
                $return = array(
                   // "status"   => 2001,
                    "success"  => false,
                    "id"       => false
                );
            }
            return $return;   
		}
		
        function removeToken ($user_id) {
            $return = array();
            $query = "UPDATE  `user` 
            SET 
                `user`.`token_recovery_email` = ''
            WHERE 
                `user`.`id` = " . $user_id;
            $this->connect();
            if ($this->query($query)) {
                $return = array(
                    "status"   => 1000,
                    "id"       => $this->lastInsertId(),
                    "success"  => true
                );
            } else {
                $return = array (
                   // "status"   => 2001,
                    "success"  => false,
                    "id"       => false
                ); 
            } 
            return $return;  
        } 
        
		function emailAccountExists($email) {
			$return = array();
			$query = "SELECT `id`,`email` FROM `user` WHERE `email` = '" . $email . "';";
			$this->connect();
			$this->query($query);
			$record = $this->nextRecord();            
            
			if (isset($record['email'])) {
				//The email account already exist
				$return["success"] = false;
				$return["status"] = 1000;
			} else { 
				//Email doesn't exist
				$return["success"] = true;
				$return["status"] = 1004;
			} 
			return $return;
		}
		
		function confirmEmailAccount($email, $token){
			$id;
			$return = array();
			$query = "SELECT `id`,`email`,`account_confirmed` FROM `user` WHERE `email` = '" . $email . "' AND  `token_email_confirmation`='".$token."';";

			$this->connect();
			$this->query($query);
			$record = $this->nextRecord();
			if ($record) {
				if ($record['account_confirmed'] != 1) {
					$id = $record['id'];
					$query = "UPDATE `user` SET `account_confirmed` = 1 , `confirmed_date` = " . time() . " WHERE id = " . $id . ";";
					$this->query($query);
					$return['status'] = 1000;
					$return['success'] = true;
				} else {
					//Account already confirmed
					$return['status'] = 1002;
					$return['success'] = false;
				}	
			} else {
				//Account token & email doesn't exist
				$return['status'] = 1003;
				$return['success'] = false;
			}
			return $return;
		}
		
		function logIn ($args) {
			$return = array();
			$email = $args['email'];
			$password = $args['password'];
			
			$query = "SELECT 
			     `id`, 
			     `name`,
			     `lastname`,
			     `password`, 
			     `email`,
			     `account_confirmed` ,
			     `facebook`,
			     `twitter`,
			     `gplus`,
			     `flickr`,
			     `linkedin`,
			     `scribd`,
			     `tumblr`,
			     `youtube`,
			     `profile_pic_name`,
                 `abs_path_pic`,
                 `web_url_pic`
			 FROM 
			     `user` 
			 WHERE `email` = '" . $email . "';";
			$this->connect();
			$this->query($query);
			$record = $this->nextRecord(); 
			/*
			if ($record) {
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
				//The email doesn't exist
				$return['status'] = 1004;
				$return['success'] = false;
			}*/
			return $record;
		}

        function getUserByEmail ($email) {
            return $this->logIn(array("email"=>$email));
        }
        
        function isTokenRightForEmail($email, $token) {
            $return = array();
            $query = "SELECT `id`, `email` FROM `user` WHERE `user`.`email` = '" . $email . "' AND `user`.`token_recovery_email` = '" . $token . "'";
            $this->connect();
            $this->query($query);
            $resp = $this->nextRecord();
            if ($resp) {
                $return['success'] = true;
                $return['result'] = $resp; 
                /**@todo*/ 
                $return['status'] = null;
            } else {
                $return['success'] = false;
                /**@todo*/ 
                $return['status'] = null;
            }
            return $return; 
        }
        
        //function hot(){}
        
        function getStream ($usr_id, $start, $amount) {
            $query = "SELECT * FROM `stream` WHERE `user_id` = $usr_id ORDER BY `id` DESC LIMIT " . $start . "," . $amount ;
            $this->connect();
            $this->query($query);
            return $this->getRecords();
        }
        
        
        function addPost ($text, $user_id, $date) {
            $return = array();
            $query = "INSERT INTO `stream` (`text`,`date`,`user_id`,`posted_by`) VALUES ('" . $text . "'," .$date . "," . $user_id . "," . $user_id . ")";
            $this->connect();
            $result = $this->query($query);
            if ($result) {
                $return = array(
                    "status"   => 1000,
                    "id"       => $this->lastInsertId(),
                    "success"  => true
                );
            } else {
                $return = array(
                    "status"    => 1008,
                    "success"   => false,
                    "id"        => false
                );
            }
            return $return;
        }
        
        function removePost ($id) {
            $return = array();
            $query = "DELETE FROM `stream` WHERE `id` =" . $id;
            $this->connect();
            $result = $this->query($query);
            if ($result) {
                $this->removeCommentsFromItem($id, 1);
                $return = array (                    
                    "status"   => 1000,
                    "success"  => true
                );
            } else {
                $return = array(
                    "status"    => 1009,
                    "success"   => false
                );
            }
            return $return;
        }
        
        function getUsers ($args = null) {
            $return = array();
            
            $query = 
            "SELECT                  
                 `id`, 
                 `name`,
                 `lastname`,
                 `password`, 
                 `email`,
                 `education`,
                 `occupation`,
                 `account_confirmed`,
                 `live_city_text`,
                 `born_city_text`,
                 `facebook`,
                 `twitter`,
                 `gplus`,
                 `flickr`,
                 `linkedin`,
                 `scribd`,
                 `tumblr`,
                 `youtube`,
                 `profile_pic_name`,
                 `abs_path_pic`,
                 `web_url_pic`
                 
            FROM  `user`";
            
            if ($args["current_id"]) {
                $query.= " WHERE id != " . $args["current_id"];  
            } 
            
            $this->connect();
            $result = $this->query($query);
            if ($result) {
                $result = $this->getRecords();
                $return = array (                    
                    "status"   => 1000,
                    "success"  => true,
                    "result"   => $result
                );
            } else {
                $return = array(
                    "status"    => 1010, //No se econtro ningun usuario
                    "success"   => false
                );
            }
            return $return;
        }
        
        function getLatestUsers() {
            $return = array();
            $query = 
            "SELECT                  
                 `id`, 
                 `name`,
                 `lastname`,
                 `web_url_pic`
            FROM  `user` 
            WHERE `web_url_pic` != '' ORDER BY `id` DESC LIMIT 1,20";
            
            $this->connect();
            $result = $this->query($query);
            if ($result) {
                $result = $this->getRecords();
                $return = array (                    
                    "status"   => 1000,
                    "success"  => true,
                    "result"   => $result
                );
            } else {
                $return = array(
                    "status"    => 1010, //No se econtro ningun usuario
                    "success"   => false
                );
            }
            return $return;
        }
        
        function updatePassword ($user_id, $password) {
            $return = array();
            $query = "
            UPDATE `user` 
            SET
                `user`.`password` = '" . $password . "'
            WHERE
                `user`.`id`=" . $user_id;
            $this->connect();
            $result = $this->query($query);
            if ($result) {
                $return['success'] = true;
            } else {
                $return['success'] = false;
            }
            return $return;
        }
        
        function getFriendship ($friend_id, $current_user_id) {
            $query = "
            SELECT 
                 `id`,
                  `a`,
                  `b`,
                  `requested_date`,
                  `accepted_date`,
                  `status`,
                  `requested_by`
             FROM 
                `friend`
             WHERE 
                 `a`=" . $friend_id . "
             AND
                 `b`=" . $current_user_id . "
             OR  
                 `a`=" . $current_user_id . "
             AND
                 `b`=" . $friend_id . ""; 
                 
            $this->connect();
            $result = $this->query($query);
            $result = $this->getRecords();
            if ($result) {
                $return = array (                    
                    "status"   => 1000,
                    "success"  => true,
                    "result"   => $result
                );
            } else {
                $return = array(
                    "status"    => 1011, //No se econtro ningun FRIENDSHIP
                    "success"   => false
                );
            }  
            return $return;     
        }
        
        function setProfilePic($args) {
            $return = array(
                "success" => false,
                "status" => 1012
            );    
            
            $user_id = $args["user_id"];
            $name = $args["profile_pic_name"];
            $abs_path = $args["abs_path_pic"];
            $web_url = $args["web_url_pic"];
            
            $query = "UPDATE `user` 
            SET
                `user`.`profile_pic_name` = '" . $name . "',
                `user`.`abs_path_pic` = '" . $abs_path . "',
                `user`.`web_url_pic` = '" . $web_url . "'
            WHERE
                `user`.`id`=" . $user_id;
            $result = $this->query($query);
            
            if ($result) {
               $return = array (                    
                    "status"   => 1000,
                    "success"  => true
                );
            } else {/*
                $return = array(
                    "status"    => 1012, //No se econtro ningun FRIENDSHIP
                    "success"   => false
                ); */
            }
            return $return;
        }
	}

?>