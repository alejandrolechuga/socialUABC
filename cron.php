<?php 
    
    
    define('ROOT'       , dirname(__FILE__));
    define('DS'         , DIRECTORY_SEPARATOR); 
    define('FWK'        , ROOT . DS . 'framework');
    define('APP'        , ROOT . DS . 'app');
    define('STORAGE' , 'storage');
    define('PATH_ABS_STORAGE'       , ROOT . DS . STORAGE);
    define('PATH_ABS_STORAGE_USERS' , PATH_ABS_STORAGE . DS . 'users');
    define('PATH_ABS_STORAGE_USERS_PROFILE_PIC' , PATH_ABS_STORAGE_USERS . DS . 'profile_pic');
    define('PATH_ABS_STORAGE_USERS_GALLERIES', PATH_ABS_STORAGE_USERS . DS . 'galleries');

    define("DB_HOST" ,"internal-db.s69250.gridserver.com");
    define("DB_USER" ,"db69250_uabc") ;
    define("DB_PASSWORD" , "chailatte");
    define("DB_DATABASE" , "db69250_socialuabc");
    
    require_once(FWK    . DS . 'db.php');
    require_once(FWK    . DS . 'cron.actions.php');
    require_once(FWK    . DS . 'imgTool.php');

    $cron = new cronActions();
    $cron->run();
    
?>
