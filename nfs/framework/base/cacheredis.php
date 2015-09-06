<?php
class cacheredis {
	protected static $_obj = null;
	
	public function __construct(){
		if(!extension_loaded('redis')){
			die('Redis Extension Not Found');
		}
	}
	
	public static function connect($cfg){
		$key = "{$cfg['host']}:{$cfg['port']}";
		if(!is_object(self::$_obj[$key])){
			$redis = new Redis();
			empty($cfg['port']) && $cfg['port'] = 6379;
			empty($cfg['timeout']) && $cfg['timeout'] = 2;
			
			$connect = $redis->connect($cfg['host'], $cfg['port'], $cfg['timeout']);
			$cfg['password'] && $redis->auth($cfg['password']);
			self::$_obj[$key] = $redis;
		}
		return self::$_obj[$key];
	}
	
	public static function init($key='default'){
		$cfg = oo::cfg('cache.redis');
		if(isset($cfg['host'])){ //一维数组配置
			$thiscfg = $cfg;
		}else{ //二维数组配置
			$thiscfg = $cfg[$key];
		}
		return self::connect($thiscfg);
	}
}