<?php 
class friendsController extends Controller {
    public $models    = array ("user");
    public $routers   = array ("user");
    
	function __construct(){}
    
	function index(){
	}
    
	function add() {
	    
	}
	function get() {
	    
	}
    
    function friendProfile ($args) {
        $id = $args['id'];
        $data = array ();
        $data["friend_id"] =  $id;
        $data["current_id"] = $_SESSION['user']['id'];
        $show_friend_profile = false;
        
        
        /**
         * 
         * Array
            (
                [successful] => 1
                [status] => 0
                [result] => Array
                    (
                        [id] => 1
                        [a] => 1
                        [b] => 4
                        [requested_date] => 1325964718
                        [accepted_date] => 0
                        [status] => 1
                        [requested_by] => 1
                    )
            
            )
         * 
         */
        $response = $this->models['friends']->getFriendship($data);
        // status --> 0 mostrar add friend
        // status --> 1 mostrar already sended 
        // status --> 2 friends 
        // status --> 3 rejected  
        //$response['']

        if ($response['success']) {
            $result = $response['result']; 
            if ($result['status'] == 0) {
                $url = $this->router->getURL("sendFriendRequest",array ( "id" => $id));
                $this->assign("send_friend_request_url", $url);
                $this->assign("friendship_status", 0);
            }
             
            if ($result['status'] == 1) {
                $this->assign("friendship_status", 1);
            }
            
            if ($result['status'] == 2) {
                $this->assign("friendship_status", 2);
                ///Change for friendid
                $user = $this->models['user']->get($id);
                $friend_data = array();
                $friend_data['name'] = $user['name'];
                $friend_data['lastname'] = $user['lastname'];
                $friend_data['id'] = $user['id'];
                $friend_data['web_url_pic'] = $user['web_url_pic'];
                
                $networks = false;
                if (isset($user['facebook'])) {
                    $networks = array();
                    
                    if ($user['facebook'] != "-1") {
                        $networks['facebook'] = $user['facebook'];
                    }   
                
                    if ($user['twitter'] != "-1") {
                        $networks['twitter'] = $user['twitter'];
                    }
    
                    if ($user['gplus'] != "-1") {
                        $networks['gplus'] = $user['gplus'];
                    }
                
                    if ($user['flickr'] != "-1") {
                        $networks['flickr'] = $user['flickr'];
                    }
                
                    if ($user['linkedin'] != "-1") {
                        $networks['linkedin'] = $user['linkedin'];
                    } 
                
                    if ($user['scribd'] != "-1") {
                        $networks['scribd'] = $user['scribd'];
                    } 
                
                    if ($user['tumblr'] != "-1") {
                        $networks['tumblr'] = $user['tumblr'];
                    }
                    if ($user['youtube'] != "-1") {
                        $networks['youtube'] = $user['youtube'];
                    }
                 }
                 $friend_data['networks'] = $networks;
                //Stream
                //Entrybox input action
               $entry_box_url = $this->router->getURL("entry_box_action", array (
                   "id" => $_SESSSION['user']['id']
                ));
                
                $this->assign("entry_box_action", $entry_box_url);
                //Stream feed
                $stream = array(); 
                $streamData = $this->getStream ($id);
                
                if ($streamData) {
                     //console($streamData);
                     $items = $streamData['items'];
                     $itemsLength = count($items);
                     for ($i = 0; $i < $itemsLength; $i++) {
                        $item = $items[$i]; 
                        //console($item);
                        $posted_by = $item['posted_by'];
                        if ($posted_by == $id || $posted_by == 0 ) {
                            //echo
                            //$items[$i]['posted_by']['id'] = $id;
                            $items[$i]['posted_by']  = $_SESSION['user'];
                        } else {
                            $friend = $this->models["friends"]->getFriendInfo($posted_by); 
                            $items[$i]['posted_by']  = $friend['result'];
                            $friendProfile_url = $this->router->getURL("friendProfile",array("id"=>$posted_by));
                            $items[$i]['posted_by']['profile_url'] = $friendProfile_url;
                        }
                        //exit;
                        //$this->   
                     }
                     $streamData['items'] = $items;
                 }
                
                $stream['items'] = $streamData['items'];
                $stream['start'] = $streamData['start'];
                $stream['amount'] = $streamData['amount'];
                  
                $this->assign ("stream", $stream);
                $this->assign ("show_more_posts" , false);
                $this->assign ("friend_data", $friend_data);
            }
        }
    }

    /***
     * @TODO Return format JSON data  
     * @TODO Return success in a packet 
     * 
     * @method  sendFriendRequest
     * @param $args
     */
    function sendFriendRequest ($args) {
        $data = array ();
        $data["friend_id"] = $args['id']; 
        $data["current_id"] = $_SESSION['user']['id'];
        $this->models['friends']->friendRequest($data);
        return array (1,2);
    }
    
    function newUsers($args) {
        $usersSet = $this->models['user']->getUsers();
        if ($usersSet['success']) {
            $users = $usersSet['result'];
            $length = count($users);
            for ($i = 0 ; $i < $length; $i ++) {
                $url = $this->routers['user']->getURL("friendProfile",array ( "id" => $users[$i]['id']));
                $users[$i]['profile_url'] = $url; 
            }
            $this->assign("users_set", $users);
        } else {
            $this->assign("users_set", false);
        }
    }
    
    function addFriend ($args) {
        if ($_SESSION['user']['logged']) {
            $friend_id = $args['friend_id'];
            $current_user = $_SESSION['user']['id'];
            $friendship_id = $args['friendship_id'];
            $this->models['friends']->acceptFriend(array(
                "friend_id" => $friend_id,
                "current_user" => $current_user,
                "friendship_id" => $friendship_id,
                "accepted_date" => time()
            ));
        }
        return array("success" => "hello world from addUser ajax", "array" => $args);                       
    }
    
    function rejectFriend ($args) {
        if ($_SESSION['user']['logged']) {
            $friend_id = $args['friend_id'];
            $current_user = $_SESSION['user']['id'];
            $friendship_id = $args['friendship_id'];
            $this->models['friends']->rejectFriend(array(
                "friend_id" => $friend_id,
                "current_user" => $current_user,
                "friendship_id" => $friendship_id
            ));
        }
        return array("success" => "hello world from rejectUser ajax", "array" => $args); 
    }
    
    function addPostToFriend($args) {
        $output = array('success'=> false);
        #[ ] santizate the input
        $friendProfile = $args['friend_profile_id'];
        $input = $args['post'];
        $time   = time();
        $user_id = $_SESSION['user']['id'];
        $response = $this->models['friends']->addPostToFriend($input, $friendProfile, $_SESSION['user']['id'], $time);
        
        if ($response['success']) {
           $output['success'] = true; 
           $output['time'] = $time;
           $output['text'] = $input;
           $output['id'] = $response['id'];
        } 
        return $output;
    }
}
?>