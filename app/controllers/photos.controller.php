<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class photosController extends Controller {

    public $models = array("user");
    public $routers = array("user");
    function index() {
        
    }

    function uploadNewImage() {

        __autoload(COMMON . DS . 'ImgTransformer.php');
        $imgTmr = new ImgTransformer();
        $imgTmr->resizeAll(TEMP_IMG . DS . 'apple.jpg', PATH_ABS_STORAGE_USERS_GALLERIES);
    }

    function gallery($args) {
        $user_id = $_SESSION['user']['id'];
        $return = array();
        $return_gallery = array();
        $return_user_name = array();


        if ($args['id'] != "") {



            $resp_gallery = $this->models['photos']->getGallery();
            if ($resp_gallery['success']) {
                $lenght = count($resp_gallery["resultsGalleries"]);
                for ($i = 0; $i < $lenght; $i++) {
                    if ($resp_gallery["resultsGalleries"][$i]['id_gallery'] == $args['id']) {
                        $return_gallery[$i] = $resp_gallery["resultsGalleries"][$i];
                    }
                }

                $gallery_information = $return_gallery;
                $this->assign("gallery_info", $gallery_information);
            }

            $resp_user = $this->models['user']->getUsers();
            if ($resp_user['success']) {
                $lenght = count($resp_user["result"]);
                for ($i = 0; $i < $lenght; $i++) {
                    if ($resp_user["result"][$i]['id'] == $user_id) {
                        $return_user_name[$i] = $resp_user["result"][$i];
                    }
                }
                $user_name = $return_user_name;
                $this->assign("user_name", $user_name);
            }

            $resp = $this->models['photos']->getPhotos($user_id, $args['id']);


            if ($resp['success']) {
                $lenght = count($resp['resultsPhotos']);

                for ($i = 0; $i < $lenght; $i++) {
                    $return[$i] = $resp['resultsPhotos'][$i]['web_url_photo'];
                }

                $list_photo = $return;
                $this->assign("list_photos", $list_photo);
            }
            
            //UPDATE INFORMATION GALLERY
            
            
        }
    }

    function showGallery() {
        $resp = $this->models['photos']->getGallery();

        if ($resp['success']) {
            $gallery = $resp['resultsGalleries'];
            $lenght = count($gallery);
            for ($i = 0; $i < $lenght; $i++) {
                $url = $gallery_url = $this->router->getURL("new_Gallery", array("id" => $gallery[$i]['id_gallery']));
                $gallery[$i]['gallery_url'] = $url;
            }

            $this->assign("gallery", $gallery);
        } else {
            
        }
    }

    function showPhotos() {
        $return = array();
        $resp = $this->models['photos']->getPhotos();

        if ($resp['success']) {
            $lenght = count($resp['resultsPhotos']);

            for ($i = 0; $i < $lenght; $i++) {
                $return[$i] = $resp['resultsPhotos'][$i]['web_url_photo'];
            }

            $list_photo = $return;
            $this->assign("list_photos", $list_photo);
        }
    }

    function setPhotos($params) {
        $output = array('success' => false);
        #[ ] santizate the input
        $user_id = $_SESSION['user']['id'];
        $response = $this->models['photos']->setPhotos($params["photo2"]);

        if ($response['success']) {
            $output['success'] = true;
            $output['time'] = time();
            $output['text'] = $input;
            $output['id'] = $response['id'];
        }

        return $output;
    }

    function uploadNewImg($args) {
        /*
         * 
         * 
          @TODO
          [] validate size
          @TODO
          [] validate file type
          @TODO
          [] validate file extension
         * 
          @TODO
          [] Get the last one and delete it
         */
        //console($_FILES); 
        $id = $_SESSION['user']['id'];
        $type = $_FILES['uploadedFile']['type'];
        $extension = "";
        switch ($type) {
            case "image/jpeg":
                $extension = "jpg";
                break;
            case "image/png":
                $extension = "png";
                break;
        }

        //$basename = basename($_FILES['uploadedFile']['name']);
        $name = "user_gallery_photo" . $id . "_" . time() . $extension;
        $targetPath = PATH_ABS_STORAGE_USERS_PHOTO . DS . $name;
        $webURL = PATH_WEB_STORAGE_USERS_GALLERY . DS . $name;

        if (move_uploaded_file($_FILES['uploadedFile']['tmp_name'], $targetPath)) {
            
            $this->models['photos']->setPhotos(array(
                "photo_name" => $name,
                "abs_path_pic" => $targetPath,
                "web_url_pic" => $webURL,
                "user_id" => $id,
                "photo_description" => $args['gallery_description'],
                "id_gallery" => $args['id_gallery'],
                "upload_date" => time()
            ));

            //Redirect to showGallery
            $showGallery_url = $this->router->getURL("upload_Img");
            $this->redirect($showGallery_url);
        } else {
            //Not uploaded successfully
        }
    }

    function createGallery($params) {

        $output = array('success' => false);
        $time = time();
        $user_id = $_SESSION['user']['id'];

        if ($_SESSION['user']['logged']) {

            if ($params["gallery_pcy"] == "publico") {
                $params["gallery_pcy"] = "1";
            } else {
                $params["gallery_pcy"] = "0";
            }

            $response = $this->models['photos']->createGallery($params["gallery_name"], $params["gallery_description"], $time, $params["gallery_pcy"], $user_id);

            if ($response['success']) {

                $output['success'] = true;
                $output['time'] = $time;
                $output['id'] = $response['id'];
                $id = $output['id'];
                $url = $gallery_url = $this->router->getURL("new_Gallery", array("id" => $id));
                $this->redirect($url);

                return $output;
            }
        }
    }

    
    
    //[ ] vaidar los datos
    
    function editGallery($params) {
        
        //console.log($params);
        $user_id = $_SESSION['user']['id'];
        $output = array('success'=> false);
        //$user_id = $_SESSION['user']['id'];
       
        //$response = $this->models['photos']->updateGallery($params["gallery_name"],$params["gallery_description"]);
        
        $response = $this->models['photos']->updateGallery(array(
                "gallery_name" => $params["gallery_name"],  
                "gallery_description" => $params["gallery_description"],
                "user_id" => $user_id,
                "id_gallery" => $params["gallery_id"]
            ));
      
        if($response['success']){
      
            $output['gallery_name'] = $params["gallery_name"]; 
            $output['user_id'] = $user_id;
            $output['id_gallery'] = $params["gallery_id"];
            

            return $output;
        }
        
        //print_r($params);
    }
}

?>
