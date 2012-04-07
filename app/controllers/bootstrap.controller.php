<?php 
	class bootstrapController extends Controller{
		public $models    = array ("user");
		public $routers   = array ("user");

		function __construct () {	
        }
           
		function index ($args) {
		    if (isset ($args['statuscode'])) {
		        $this->checkStatusCode ($args['statuscode']); 
		    }
            
            $lastestUsers = $this->models['user']->getLatestUsers();
            
            if ($lastestUsers['success']) {
                $lastestUsers = $lastestUsers['result'];
                
                $lastestUsers = array_chunk($lastestUsers, 2);
                //console($lastestUsers);
                $length = count($lastestUsers);
                $pos = 0;
                for ($i = 0 ; $i < $length; $i ++) {
                    $pos++;
                    $lastestUsers[$i]['pos'] = $pos;
                    if ($pos == 4) {
                        $pos = 0;
                    }
                }
                $this->assign("lastestUsers", $lastestUsers);
            }
		}	
        
        
        function activity ($args) {
            
        }
        

        //Most are Unsuccessful cases
        function actionCase ($status) {
                  
        }
        
        function checkStatusCode ($code) {
            
            switch ($code) {
                case 1001:
                case 1004:
                case 1005:
                case 1006:
                case 1010:
                case 1011:
                case 1012:
                    $details = $this->getStatusCodeDescription($code);
                    $this->assign("top_message", array (
                        "title"             => $details['title'],
                        "message"           => $details['message'],
                        "top_message_right" => true        
                    ), true);
                break;
                
               
            }
            global $statuscodes;
            
        }
	}
?>