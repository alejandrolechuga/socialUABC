<?php 
	define('REMOTE_ADDR'	,	$_SERVER['REMOTE_ADDR']);
	define('SERVER_NAME' 	, 	$_SERVER['SERVER_NAME']);
    
	#DATABASE
    define("PRODUCCION" , true);
	
	if (PRODUCCION) {
	define("DB_HOST" ,"host");
        define("DB_USER" ,"user") ;
        define("DB_PASSWORD" , "password");
        define("DB_DATABASE" , "database");  
	} else {
	define("DB_HOST" ,"host");
        define("DB_USER" ,"user") ;
        define("DB_PASSWORD" , "password");
        define("DB_DATABASE" , "database");
	}
	
    
	#MAILER
	define("MAIL_HOST", "mail.domain.com");
	define("MAILER_USER", "no-reply@domain.com");
	define("MAILER_PASSWORD" , "password");
	
	define('ACTION'			,	'action');
	define('SECTION'		,	'section');
	define('INDEX_TPL' 		, 	'index.tpl');
	define('LANG'			,	'es');
	define ('PROTOCOL'		, 	'http://');
	define('WEB_URL' 		, 	'http://'.SERVER_NAME);
	
	define('CONTROLLER_FILENAME_SUFFIX' , ".controller.php" );
	define('MODEL_FILENAME_SUFFIX' , ".model.php" );
	define('CONTROLLER_CLASS_SUFFIX', "Controller");
	define('MODEL_CLASS_SUFFIX', "Model");
	
	define('DEFAULT_SECTION'	,'bootstrap');
	define('DEFAULT_ACTION'	,'index');
	define('DEFAULT_SECTION_KEY', 's');
	define('DEFAULT_ACTION_KEY', 'a');
	define('SECTION_KEY' , "s");
	define('ACTION_KEY' , "a");
	
	define('WEB_CSS', WEB_URL . DS .  'web' . DS . 'css');
	define('WEB_JS', WEB_URL . DS .  'web' . DS . 'js');
	define('WEB_IMG', WEB_URL . DS .  'web' . DS . 'img'  . DS);
    
    //STORAGE WEB PATH'S
    define('PATH_WEB_STORAGE_USERS' , WEB_URL . DS . STORAGE . DS . 'users');
    define('PATH_WEB_STORAGE_USERS_PROFILE_PIC' , PATH_WEB_STORAGE_USERS . DS . 'profile_pic');
    define('PATH_WEB_STORAGE_USERS_GALLERIES',    PATH_WEB_STORAGE_USERS . DS . 'galleries');
	
	$rand = "?rand=" . time();
	$CSS_ARRAY = array();
	$CSS_ARRAY[] = WEB_CSS . DS . "layout.css" . $rand;
    $CSS_ARRAY[] = WEB_CSS . DS . "user.css" . $rand;
    $CSS_ARRAY[] = WEB_JS . DS . "jquery/css/ui-lightness/jquery-ui-1.8.16.custom.css" . $rand; 
	
	$JS_ARRAY = array();
	$JS_ARRAY[] = "http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js";
    $JS_ARRAY[] = "web/js/jquery/js/jquery-ui-1.8.16.custom.min.js";
	$JS_ARRAY[] = "web/js/jquery/development-bundle/ui/jquery.effects.core.js";
	$JS_ARRAY[] = "web/js/jquery/development-bundle/ui/jquery.effects.bounce.js";
	$JS_ARRAY[] = "web/js/jquery/development-bundle/ui/jquery.effects.scale.js";
    $JS_ARRAY[] = "web/js/jquery/js/jquery.tools.min.js";
    
	
	$JS_ARRAY[] =  WEB_JS . DS . "common.js";
    $JS_ARRAY[] =  WEB_JS . DS . "mustache.js";
    
	//$JS_ARRAY[] = WEB_JS . DS . "yui-min.js";
	$JS_BOTTOM_ARRAY = array();
?>
