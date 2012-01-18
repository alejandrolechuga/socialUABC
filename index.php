<?php
	/**
	 * @site: socialuabc.com
	 * @date_issued: Wed, 30 March 2010
	 * @programmer: Ramon Lechuga
	 */
	
	//SECURITY Important hiding the server enviroment
	header('Server: ');
    header('X-Powered-By: ');
    //SECURITY Important hiding the server enviroment
    session_name('UABC');
	session_start();
	
    
	define('ROOT'		, dirname(__FILE__));
	define('DS'			, DIRECTORY_SEPARATOR); 
	define('FWK'		, ROOT . DS . 'framework');
	define('APP'		, ROOT . DS . 'app');
	define('MODEL_DIR'		, APP . DS . 'models');
	define('CONTROLLER_DIR'	, APP . DS . 'controllers');
	define('PLUGINS'	, ROOT . DS . 'plugins');
	define('TEMPLATES'	, APP . DS . 'templates');
	define('VIEWS' 		, APP . DS . 'views');
	define('ROUTERS'	, APP . DS . 'routers');
	define('CACHE'		, ROOT . DS . 'cache');
	define('CACHE_TEMPLATES', CACHE . DS . 'templates');
	define('WEB'		, ROOT . DS . 'web');
	
	//require_once(ROOT 	. DS . 'auth.php');
	require_once(ROOT 	. DS . 'config.php');
	require_once(FWK 	. DS . 'developer.php');
	require_once(FWK	. DS . 'regExp.lib.php');
	require_once(FWK 	. DS . 'common.php');
	require_once(FWK	. DS . 'db.php');
	require_once(FWK 	. DS . 'model.php');
	require_once(FWK 	. DS . 'router.php');
	
	require_once(PLUGINS .DS . 'twig/lib/Twig/Autoloader.php');Twig_Autoloader::register();
	require_once(FWK 	. DS . 'controller.php');
	
	
	require_once(FWK 	. DS . 'view.php');
	require_once(FWK 	. DS . 'dispatcher.php');
    
?>