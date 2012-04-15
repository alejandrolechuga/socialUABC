<?php 

    class Model extends DbMySQL {
        
        function addComment($args) {
            $return = array();
            $text = $args["text"];
            $user_id = $args["user_id"];
            $item_id = $args["item_id"];
            $type = $args["type"];
            $date = $args["date"];
            $query = "INSERT INTO comment (text, user_id, item_id, type, date) VALUES (
                '" . $text . "',
                " . $user_id . ",
                " . $item_id . ",
                " . $type . " ,
                " . $date . "
            )";
            
            $this->connect();
            if ($this->query($query)) {
                $return['success'] = true;
                $return['status'] = 1000;
                $return['id'] = $this->lastInsertId();
            } else {
                $return['success'] = false;
                $return['status'] = 3001; 
            }
            return $return;
        }
        
        function removeComment ($args) {
            $return = array();
            $comment_id = $args['comment_id'];
            $query = "DELETE FROM comment WHERE id = " . $comment_id;
            $this->connect();
            $this->query($query);
            
            if ($this->query($query)) {
                $return['success'] = true;
                $return['status'] = 1000;
            } else {
                $return['success'] = false;
                $return['status'] = 3001; 
            }          
            return $return; 
        }
        
        function getComment() {
            $return = array();
            return $return;
        }
        
        function getCommentsByItem ($item, $type) {
            $return = array();
            $query = "SELECT * FROM comment WHERE item_id = " . $item . " AND type = " .$type;
            $this->connect();
            $this->query($query);
            $records = $this->getRecords();
            if ($records) {
                $return['success'] = true;
                $return['status'] = 1000;
                $return['results'] = $records;
            } else {
                $return['success'] = false;
                $return['status'] = 3001; 
            }
            return $return;
        }
        
        function removeCommentsFromItem ($item_id, $type) {
            $return = array();
            $comment_id = $args['comment_id'];
            $query = "DELETE FROM comment WHERE item_id = " . $item_id . " AND type = " . $type;
            $this->connect();
            $this->query($query);
            if ($this->query($query)) {
                $return['success'] = true;
                $return['status'] = 1000;
            } else {
                $return['success'] = false;
                $return['status'] = 3001; 
            }          
            return $return; 
        } 
    }

?>