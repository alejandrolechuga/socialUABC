<?php

class Dispatcher {
	private $GET               = array();
	private $POST              = array();
	private $IS_AJAX           = false;
	private $INSTANCE          = NULL;
	public	$CURRENT_SECTION;
	public	$CURRENT_ACTION;
	
	function __construct ($params = array()) {
		if ($params['get']) {
			$this->GET = $params['get'];
		}
		if ($params['post']) {
			$this->POST = $params['post'];
		} 
		if ($this->GET['ajax']) {
			$this->IS_AJAX = true;
		}
	}
	
	function run () {
		$object = $this->getURLObject();
		$this->runController ($object);	
	}
	 
	function runController ($object) {
		$controllerClassName;
		$instance;
		$return;
		$parameters 	= array_merge($this->GET, $this->POST);
		$instanceVars 	= false;
		$models 		= false;
		
		#start MVC	
		if (!$this->loadController($object[DEFAULT_SECTION_KEY])) {
			$object = $this->getDefaultURLObject();
		}
		#TODO
		$controllerClassName = $this->getControllerClassName($object[DEFAULT_SECTION_KEY]);
		if (class_exists($controllerClassName)) {
			#instanced 
			$instance = new ${controllerClassName}();
			Controller::$section = $object[DEFAULT_SECTION_KEY];
			#get vars
			$instanceVars = $this->getInstanceVars($controllerClassName);
            
			$instanceVars['models'][] = $object[DEFAULT_SECTION_KEY];
			$models = $this->getModels($instanceVars['models']);
            
			$instance->models = $models;

			
			
			if (method_exists($instance, $object[DEFAULT_ACTION_KEY])) {
				$this->CURRENT_SECTION = $object[DEFAULT_SECTION_KEY];
				$this->CURRENT_ACTION =  $object[DEFAULT_ACTION_KEY];
				$router = $this->getRouter($this->CURRENT_SECTION,$this->CURRENT_ACTION);
				if ($router) {
					if (method_exists($router,$this->CURRENT_ACTION)) {
						$this->addRoutes($router->{$this->CURRENT_ACTION}());
					}
				}
                //Get Summoned Routers

                $routerVars = $instanceVars['routers'];
                $routers = $this->getRouters($routerVars);

               // $router[$this->CURRENT_ACTION] = $router;
                $instance->routers = $routers;

				$instance->router = $router;
				$return = $instance->{$object[DEFAULT_ACTION_KEY]}($parameters);
				
			} else if(method_exists($instance,DEFAULT_ACTION)){
				$this->CURRENT_SECTION = $object[DEFAULT_SECTION_KEY];
				$this->CURRENT_ACTION =  DEFAULT_ACTION;
				$router = $this->getRouter($this->CURRENT_SECTION,$this->CURRENT_ACTION);
				if ($router) {
					if (method_exists($router,$this->CURRENT_ACTION)) {
						$this->addRoutes($router->{$this->CURRENT_ACTION}());
					}
				}
                                //Get Summoned Routers

                $routerVars = $instanceVars['routers'];
                $routers = $this->getRouters($routerVars);

               // $router[$this->CURRENT_ACTION] = $router;
                $instance->routers = $routers;

                $instance->router = $router;
				$return = $instance->{DEFAULT_ACTION}($parameters);
				
			} else {
				#report this
			}
			
		} else {
			
			$this->loadController(DEFAULT_SECTION);
			$this->loadModel(DEFAULT_ACTION);
			$controllerClassName = $this->getControllerClassName(DEFAULT_SECTION);
			#instanced
			$instance = new ${controllerClassName}();
			Controller::$section = DEFAULT_SECTION;
			#getvars
			$instanceVars = $this->getInstanceVars($controllerClassName);
			$instanceVars['models'][] = DEFAULT_SECTION;
			$models = $this->getModels($instanceVars['models']);
			$instance->models = $models;
			
			$instance->routine();
			
			if (method_exists($instance,DEFAULT_ACTION)) {
				$this->CURRENT_SECTION = DEFAULT_SECTION;
				$this->CURRENT_ACTION =  DEFAULT_ACTION;
				$router = $this->getRouter($this->CURRENT_SECTION,$this->CURRENT_ACTION);
				if ($router) {
					if (method_exists($router,DEFAULT_ACTION)) {
						$this->addRoutes($router->{DEFAULT_ACTION}());
					}
				}
				//Get Summoned Routers

                $routerVars = $instanceVars['routers'];
                $routers = $this->getRouters($routerVars);

               // $router[$this->CURRENT_ACTION] = $router;
                $instance->routers = $routers;

                $instance->router = $router;
				$return = $instance->{DEFAULT_ACTION}($parameters);
			} else {
				#report this
			}
			
		}
        //Routine
        $instance->routine();
        
		$_SESSION['CURRENT'] = array(
		  "SECTION" => $this->CURRENT_SECTION,
		  "ACTION" => $this->CURRENT_ACTION
        );
        
        
		$this->loadView ($this->CURRENT_SECTION, $this->CURRENT_ACTION);
		$this->INSTANCE = $instance;
        // RESPONSE
        if (!$return) {
            $this->loadLayoutView ();
            $this->runLayout();
        } else if(is_array($return)) {
            header('Cache-Control: no-cache, must-revalidate');
            header('Content-type: application/json');
            echo json_encode($return);
            exit;  
        } else {
            echo $return; //raw output
            exit;
        }
		#run views
		#output
	}
	
	function addRoutes ($routes) {
		if ($routes)
		foreach ($routes as $k => $v) {
			Controller::assign($k,$v,true);
		}
	}
	function getRouter ($section, $action = false) {
		$filename = $section . ".router.php";
		$filepath = ROUTERS . DS . $filename;
		if(__autoload($filepath)) {
			$className = $section . "Router";
			return new ${className}();
		} else return false;
	}
    
    function getRouters ($routers) {
        $return = array();
        foreach ($routers as $router) {
           $return[$router] =  $this->getRouter($router);
        }
        return $return;
    }
	
	function runLayout () {
		global $JS_ARRAY;
        global $JS_BOTTOM_ARRAY;
		global $CSS_ARRAY;
		
		$loader = new Twig_Loader_Filesystem(TEMPLATES);
		$twig = new Twig_Environment($loader);
		/*$twig = new Twig_Environment($loader, array(
  			'cache' => CACHE_TEMPLATES,
		));*/
		
		$template = $twig->loadTemplate('index.tpl');
		$language = "es-MX";
		$action_template = $this->getActionTemplateName($this->CURRENT_SECTION, $this->CURRENT_ACTION);
		
		if (!$this->checkIfTemplateExists($action_template)) {
			#report this
		}   
		$index = array(
			'LANGUAGE'           => $language,
			'js_array'           => $JS_ARRAY,
			'js_bottom_array'    => $JS_BOTTOM_ARRAY,   
			'css_array'          => $CSS_ARRAY,
			'img_path'           => WEB_IMG,
			//'action_template'=> $action_template
			'content_array'      => Controller::$boxes
		);
        
		$arrayToInject = array_merge ($index, _::$global);
        
        //console($arrayToInject);
		$template->display($arrayToInject);
	}
    
	function loadLayoutView () {
	    $path =  VIEWS . DS . "layout.php";
        return __autoload($path);
	}
    
	function loadView ($section,$action) {
		$viewName = $section . "_" . $action . ".php";
		$filepath = VIEWS . DS . $viewName;
		if (file_exists($filepath)) {
			__autoload($filepath);	
			return true;	
		} else return false;
	}
	
	function checkIfTemplateExists($templatename){
		$templatename = TEMPLATES . DS . $templatename;
		return file_exists($templatename);
	}
	function getActionTemplateName($section,$action) {
		return $section . "_" . $action . ".tpl";
	}
	
	
	function getModels ($modelArray) {
		$class;
		$className;
		$length = count($modelArray);
		$newArray = array();
		for ($i = 0;$i < $length;$i++) {
			$model = $modelArray[$i];
			$this->loadModel($model);
			$className = $this->getModelClassName($model);
			if (class_exists($className)) {
				$newArray[$model] = new ${className}();
			} else {
				#report this 
			}
		}
       
		return $newArray;
	}
	
	function addModel($modelName, $instance){

	}
	
	function getInstanceVars ($instance) {
		$newArray = array();
		$newArray["models"] = array();
		$newArray["routers"] = array();
		$varArray = get_class_vars($instance);
		if (isset($varArray["models"])) {
			$newArray["models"] = $varArray["models"];
		}
		if (isset($varArray["routers"])) {
			$newArray["routers"] = $varArray["routers"];
		}
		return $newArray;
	}
	
	function getControllerClassName ($name) {
		return $name . CONTROLLER_CLASS_SUFFIX;
	}
	
	function getModelClassName ($name) {
		return $name . MODEL_CLASS_SUFFIX;
	}
	
	function loadController($controllerName) {
		$isController = false;
		if ($this->isSafeName($controllerName)) {
			$isController = $this->loadControllerFile($controllerName);
		} 
		if (!$isController) {
			$this->loadControllerFile(DEFAULT_SECTION);
		} else return true;
		
		return false;
	}
	function loadControllerFile($name) {
		$filename = $this->getControllerFilename($name);
		$filePath = $this->getControllerPath($filename);
		return __autoload($filePath);
	}
	
	function getControllerFilename($name) {
		return $name . CONTROLLER_FILENAME_SUFFIX;
	}
	
	function getControllerPath($filename) {
		return CONTROLLER_DIR . DS . $filename; 
	}
	
	function loadModel($modelName) {
		$isModel = false;
		if ($this->isSafeName($modelName)) {
			$isModel = $this->loadModelFile($modelName);
		} 
		if (!$isModel) {
			$this->loadModelFile(DEFAULT_SECTION);
		} else return true;
		return false;
	}
	
	function loadModelFile($modelName) {
		$filename = $this->getModelFilename($modelName);
		$filePath = $this->getModelPath($filename);
		return __autoload($filePath);
	}
	
	function getModelFilename($name) {
		return $name . MODEL_FILENAME_SUFFIX;
	}
	
	function getModelPath($filename) {
		return MODEL_DIR . DS . $filename; 
	}
	
	function getView($viewName) {
	
	}
	
	function isSafeName($string) {
		global $PATTERN_LIB;
		
		if (preg_match($PATTERN_LIB['VARIABLE_PATTERN'],$name)) 
			return true;
		else return false;
	}
	
	function getURLObject() {
		$urlObject = array();
		$urlObject[DEFAULT_SECTION_KEY] = $this->getCurrentSection();
		$urlObject[DEFAULT_ACTION_KEY] = $this->getCurrentAction();
		return $urlObject;
	}
	
	function getDefaultURLObject() {
		$urlObject = array();
		$urlObject[DEFAULT_SECTION_KEY] = DEFAULT_SECTION;
		$urlObject[DEFAULT_ACTION_KEY] = DEFAULT_ACTION;
		return $urlObject;
	}	
	
	function getCurrentSection () {
		if ($this->GET[DEFAULT_SECTION_KEY]) {
			return $this->GET[DEFAULT_SECTION_KEY];
		} else return DEAULT_SECTION;
	}
	
	function getCurrentAction () {
		if ($this->GET[DEFAULT_ACTION_KEY]) {
			return $this->GET[DEFAULT_ACTION_KEY];		
		} else return DEAULT_ACTION;
	} 
	
}

$dispatcher = new Dispatcher(array('get'=>$_GET,'post'=>$_POST));
$dispatcher->run();
  
?>
