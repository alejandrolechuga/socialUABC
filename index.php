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
	
    //Storage 
    
    
    define('STORAGE' , 'storage');
    
    define('PATH_ABS_STORAGE'       , ROOT . DS . STORAGE);
    define('PATH_ABS_STORAGE_USERS' , PATH_ABS_STORAGE . DS . 'users');
    define('PATH_ABS_STORAGE_USERS_PROFILE_PIC' , PATH_ABS_STORAGE_USERS . DS . 'profile_pic');
    define('PATH_ABS_STORAGE_USERS_GALLERIES', PATH_ABS_STORAGE_USERS . DS . 'galleries');
   
    
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