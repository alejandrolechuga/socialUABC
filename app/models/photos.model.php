<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 6643337360 ri cae
 */

class photosModel extends Model {

    function index() {
        
    }

    function getPhotos($id_user, $id_gallery) {

        $id_user = $id_user;
        $id_gallery = $id_gallery;
        $return = array(
            "success" => false
        );

        $query = "
            SELECT * FROM
                `photos`
            WHERE
            `id_user` ='" . $id_user . "' AND `id_gallery` = '" . $id_gallery . "'";
        $this->connect();
        $this->query($query);
        $record = $this->getRecords();

        if ($record) {
            $return = array(
                "success" => true,
                "resultsPhotos" => $record
            );
        } else {
            $return ['success'] = false;
        }

        return $return;
    }

    function getGallery() {

        $id_user = $_SESSION['user']['id'];
        $return = array(
            "success" => false
        );

        $query = "
            SELECT * FROM
                `gallery`
            WHERE
            `id_user` = '" . $id_user . "'";
        $this->connect();
        $this->query($query);
        $record = $this->getRecords();

        if ($record) {
            $return = array(
                "success" => true,
                "resultsGalleries" => $record
            );
        } else {
            $return ['success'] = false;
        }

        return $return;
    }

    function setPhotos($args) {

        $user_id = $args["user_id"];
        $name = $args["photo_name"];
        $abs_path = $args["abs_path_pic"];
        $web_url = $args["web_url_pic"];
        $id_gallery = $args["id_gallery"];
        $description = $args["photo_description"];
        $upload_date = $args["upload_date"];

        $return = array();
        $query = "INSERT INTO `photos`(
						`description`,
						`web_url_photo`,
						`id_gallery`,
						`id_user`,
						`upload_date`
						
					) 
				VALUES (
				'" . $description . "',
				'" . $web_url . "',
				'" . $id_gallery . "',
				'" . $user_id . "',
				'" . $upload_date . "'
				
				
				
			);";
        $this->connect();
        $result = $this->query($query);
        if ($result) {
            $return = array(
                "status" => 1000,
                "id" => $this->lastInsertId(),
                "success" => true
            );
        } else {
            $return = array(
                "status" => 1008,
                "success" => false,
                "id" => false
            );
        }
        return $return;
    }

    function createGallery($name, $description, $date, $privacity, $user_id) {

        $return = array();

        $query = "INSERT INTO `gallery`(
						`name_gallery`,
						`description`,
						`create_date`,
						`private`,
						`id_user`
						
						
					) 
					VALUES (
				'" . $name . "',
				'" . $description . "',
				'" . $date . "',
				'" . $privacity . "',
				'" . $user_id . "'
				
			);";

        $this->connect();
        $result = $this->query($query);
        if ($result) {
            $return = array(
                "status" => 1000,
                "id" => $this->lastInsertId(),
                "success" => true
            );
        } else {
            $return = array(
                "status" => 1008,
                "success" => false,
                "id" => false
            );
        }
        return $return;
    }

    function setGallery($args) {
        $return = array(
            "success" => false,
            "status" => 1012
        );

        $user_id = $args["user_id"];
        $name = $args["profile_pic_name"];
        $abs_path = $args["abs_path_pic"];
        $web_url = $args["web_url_pic"];

        $query = "UPDATE `gallery` 
            SET
                `gallery`.`name_gallery` = '" . $name . "',
                `gallery`.`description` = '" . $abs_path . "',
                `gallery`.`private` = '" . $web_url . "'
            WHERE
                `gallery`.`id`=" . $user_id;
        $result = $this->query($query);

        if ($result) {
            $return = array(
                "status" => 1000,
                "success" => true
            );
        } else {/*
          $return = array(
          "status"    => 1012, //No se econtro ningun FRIENDSHIP
          "success"   => false
          ); */
        }
        return $return;
    }

    function updateGallery($args) {
        $return = array(
            "success" => false,
            "status" => 1012
        );

        $user_id = $args["user_id"];
        $name_gallery = $args["gallery_name"];
        $description = $args["gallery_description"];
        $id_gallery = $args["id_gallery"];
        //$id_gallery = $args["web_url_pic"];  `gallery`.`id_gallery`='".$id_gallery."' AND `gallery`.`id_user`='".$user_id."'" ;

        $query = "UPDATE `gallery` 
            SET
            
                `name_gallery` = '". $name_gallery . "',
                `description` = '" . $description . "'
                
            WHERE 
                `id_gallery`= '".$id_gallery."' AND  `id_user`='".$user_id."'   " ;
        
        //print_r($query);
        $this->connect();
        $result = $this->query($query);

        if ($result) {
            $return = array(
                "status" => 1000,
                "success" => true
            );
        } else {/*
          $return = array(
          "status"    => 1012, //No se econtro ningun FRIENDSHIP
          "success"   => false
          ); */
        }
        return $return;
    }

    function createDefaultAlbums () {
        $query = "INSERT INTO "         
    }
}

?>
