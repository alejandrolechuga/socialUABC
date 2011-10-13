<?php 
	define('REMOTE_ADDR'	,	$_SERVER['REMOTE_ADDR']);
	define('SERVER_NAME' 	, 	$_SERVER['SERVER_NAME']);
	#DATABASE
	define("DB_HOST" ,"internal-db.s69250.gridserver.com");
	define("DB_USER" ,"db69250_uabc") ;
	define("DB_PASSWORD" , "chailatte");
	define("DB_DATABASE" , "db69250_socialuabc");
	#MAILER
	define("MAIL_HOST", "s69250.gridserver.com");
	define("MAILER_USER", "no-reply@socialuabc.com");
	define("MAILER_PASSWORD" , "supermailer");
	
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
	
	$rand = "?rand=" . time();
	$CSS_ARRAY = array();
	$CSS_ARRAY[] = WEB_CSS . DS . "layout.css" . $rand;
	
	$JS_ARRAY = array();
	$JS_ARRAY[] = "http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js";
	$JS_ARRAY[] = "web/js/jquery/development-bundle/ui/jquery.effects.core.js";
	$JS_ARRAY[] = "web/js/jquery/development-bundle/ui/jquery.effects.bounce.js";
	$JS_ARRAY[] = "web/js/jquery/development-bundle/ui/jquery.effects.scale.js";
	
	$JS_ARRAY[] =  WEB_JS . DS . "common.js";
	//$JS_ARRAY[] = WEB_JS . DS . "yui-min.js";
	
?>