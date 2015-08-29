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
	define('IMG_URL', 'http://123.57.92.9:81/');
	error_reporting(0);
	ini_set('display_errors', 'Off');
}else{
	define('ENV', 'dev');
	define('IMG_URL', 'http://local.admin.buxun.com/');
	error_reporting(E_ALL ^ E_NOTICE);
}

define('APP_DIR', 'admin');
define('APP_ROOT', dirname(dirname(__DIR__)).'/');
require '../../nfs/framework/NFS.php';

file::import(CONTROLLER_ROOT.'base_c.php');
NFS::run();


