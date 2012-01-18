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
        $data = array ();
        $data["friend_id"] = $args['id']; 
        $data["current_id"] = $_SESSION['user']['id'];
        $show_friend_profile = false;
        $id = $args['id'];
        
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
            }
        }
    }
    
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
}
?>