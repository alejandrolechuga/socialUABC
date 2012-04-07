<?php

    class cronActions extends DbMySQL{
        
        function __construct(){
            
        }   
        
        function run () {
             $this->checkImageUploads();
        }
        
        /**
         * @todo Query to bring images that aren't processed 
         * @todo Convert them 
         * @todo Update table 
         */        
        function checkImageUploads () {
            $record = $this->getUploadedImages();
            //print_r($record);
            if ($record) {
                //Set processing to 1
                $id = $record['id']; 
                $this->setProcessingImage($id);
                    
            }
        }
        
        function getUploadedImages () {
            $query ="SELECT * FROM  `photos` WHERE `photos`.`processed`=0 ORDER BY `photos`.`upload_date` DESC";
            $this->connect();
            $this->query($query);
            $record = $this->nextRecord();
            return $record;
        }
        
        function setProcessingImage($id) {
            $response = array("success" => false);
            $query = "UPDATE `photos` SET `photos`.`processed` = 1 WHERE `id` = " . $id ;
            $this->connect();
            $resp = $this->query($query);
            if ($resp) {
                $response["success"] = true;
            }
            return $response;
        }
        
    }
?>