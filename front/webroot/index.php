<?php
/**
 * 项目入口文件
 * 
 * 加载NFS初始化文件，加载配置、基类等等
 *
 */
header("charset=utf-8"); 
date_default_timezone_set('Asia/Shanghai');

if(false===strpos($_SERVER['SERVER_NAME'], 'local') && false===strpos($_SERVER['SERVER_NAME'], 'dev')){
	define('ENV', 'pro');
	error_reporting(0);
	ini_set('display_errors', 'Off');
}else{
	define('ENV', 'dev');
	define('APP_URL', 'http://localhost/buxun/front/webroot/index.php');
	error_reporting(E_ALL ^ E_NOTICE);
}

define('APP_DIR', 'front');
define('APP_ROOT', dirname(dirname(__DIR__)).'/');
require '../../nfs/framework/NFS.php';

oo::include_file(CONTROLLER_ROOT.'base_c.php');
NFS::run();


