<?php 
	class userModel extends Model{
		function index(){}
		
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
					"status" => 1000,
					"id" => $this->lastInsertId(),
					"success" => false
				);
			} else {
				$return = array(
					"status" => 1001,
					"succes" => false,
					"id" => false
				);
			}
			return $return;
		}
		
		function emailAccountExists($email) {
			$return = array();
			$query = "SELECT `email` FROM `user` WHERE `email` = '" . $email . "';";
			$this->connect();
			$this->query($query);
			
			if ($this->nextRecord()){
				//The email account already exist
				$return["success"] = false;
				$return["status"] = 1000;
			} else{ 
				//Email doesn't exist
				$return["success"] = true;
				$return["status"] = 1004;
			} 
		}
		
		function confirmEmailAccount($email, $token){
			$id;
			$return = array();
			$query = "SELECT `id`,`email`,`account_confirmed` FROM `user` WHERE `email` = '" . $email . "' AND  `token_email_confirmation`='".$token."';";

			$this->connect();
			$this->query($query);
			$record = $this->nextRecord();
			if ($record){
				if ($record['account_confirmed'] != 1) {
					$id = $record['id'];
					$query = "UPDATE `user` SET `account_confirmed` = 1 WHERE id = " . $id . ";";
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
			
			$query = "SELECT `id`, `password`, `email`,`account_confirmed` FROM `user` WHERE `email` = '" . $email . "';";
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
	}

?>