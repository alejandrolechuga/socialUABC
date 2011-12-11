<?php 
	class bootstrapController extends Controller{
		public $models = array ();
		public $routes = array ();

		function __construct () {	
        }
           
		function index ($parameters) {
		    if (isset ($parameters['statuscode'])) {
		        $this->checkStatusCode ($parameters['statuscode']); 
		    }
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