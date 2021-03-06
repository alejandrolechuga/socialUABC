<?php 
	class friendsModel extends Model{
	    /**
         *  id  int(11)         No      auto_increment                          
            a   int(11)         No                                  
            b   int(11)         No                                  
            requested_date  int(11)  No  0                               
            accepted_date   int(11)  No  0                               
            status  int(11)         No  0                               
            requested_by
         */
		function index(){
		    
		}
        
        
        function friendRequest($args) {
            $return = array(
                "status" => null,
                "success"=> false
            );
            //Friend request status -> 1
            $response = $this->getFriendship($args);
             
            if (!$response['success']) {
                $friend_id = $args['friend_id'];
                $current_id = $args['current_id'];
                $time = time();
                 
                $query = "
                INSERT INTO 
                    friend (a, b, requested_date, status, requested_by) 
                VALUES (".$current_id.",".$friend_id.",".$time.", 1, ".$current_id.")";
                
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
                        "status"   => 1000,
                        "success"  => false
                    );
                }

            } else {
                $return = array(
                    "status"   => 1000,
                    "success"  => false
                 ); 
            }
            return $return; 
        }
        
        function getFriendship ($args) {
            $return = array();
            $friend_id = $args['friend_id'];
            $current_id = $args['current_id'];
            $query = "
            SELECT * FROM 
                friend 
            WHERE 
                a=".$friend_id." 
            AND 
                b=".$current_id." 
            OR 
                b=".$friend_id." 
            AND 
                a=".$current_id."";
                
            $this->connect();
            $this->query($query);
            $record = $this->nextRecord();
            if ($record){
                $return['success'] = true;
                $return['status'] = 0;
                $return['result'] = $record; 
            } else {
                $return['success'] = false;
                $return['status'] = 0;
            }
            return $return;
        }
        
        function getFriendRequests($user_id) {
            $return = array();
            $query = "
            SELECT * FROM 
                `friend` 
            WHERE
                (`friend`.`a`=" . $user_id . " 
            OR 
                `friend`.`b`=" . $user_id . ") 
            AND 
                `friend`.`requested_by` !=" . $user_id;
            
            $this->query($query);
            $result = $this->getRecords();
            return $result;     
        }
        
        function getFriendInfo ($id) {
            $return = array(
                "status" => null,
                "success"=> false
            );
            
            $query = "
            SELECT 
                `user`.`id`,
                `user`.`name`,
                `user`.`lastname`,
                `user`.`email`,
                `user`.`profile_pic_name`,
                `user`.`abs_path_pic`,
                `user`.`web_url_pic`
            FROM 
                `user`
            WHERE 
                `user`.`id` = " . $id . "    
            ";
            
            $this->query($query);
            $result = $this->nextRecord();   
            if ($result) {
               $return = array (
                    "status"    => 1,
                    "success"   => true,
                    "result"    => $result 
               ); 
            }        
            return $return;   
        }
        function addPostToFriend ($text, $user_id, $posted_by, $date) {
            $return = array();
            $query = "INSERT INTO `stream` (`text`,`date`,`user_id`,`posted_by`) VALUES ('" . $text . "'," .$date . "," . $user_id . "," . $posted_by . ")";
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
        function acceptFriend($args) {
            $friend_id = $args["friend_id"];
            $current_id = $args["current_id"];
            $friendship_id = $args["friendship_id"];
            $accepted_date = $args["accepted_date"];
            $query = "
            UPDATE 
                `friend`
            SET 
                `friend`.`status` = 2 ,`friend`.`accepted_date` = " . $accepted_date . "
            WHERE 
                `friend`.`id` = " . $friendship_id . " ";
                
            $this->query($query);
            return $result;
        }

        function rejectFriend($args) {
            
            return $args;
        }
        
        function getFriends ($userId) {
            $return = array(
                "status" => null,
                "success"=> false
            );
            $query = "
            SELECT * FROM 
                `friend` 
            WHERE 
                (`friend`.`a`=" . $userId . " 
                OR 
                `friend`.`b`=" . $userId . ")
            AND 
                `friend`.`status`=2 ";
            $this->query($query);
            $results = $this->getRecords();
            if ($results) {
                $return['results'] = $results;
                $return['success'] = true;
                $return['status'] = 1000;
            }
            return $return;       
        }
	}
?>