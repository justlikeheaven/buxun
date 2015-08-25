<?php
class request extends component {
	protected function __init(){
		
	}
	
	/**
	 * 获取$_GET,$_POST,$_REQUEST
	 * @param unknown $name
	 * @param string $default
	 * @param string $callback
	 * @param string $type
	 * @return string
	 */
	public static function param($name, $default=null, $callback=null, $type='REQUEST'){
		eval("\$res = \$_{$type}[{$name}];");
		$callback && $res = call_user_func($callback, $res);
		if($res){
			return $res;
		}else if($default){
			return $default;
		}
	}
	
	public static function json($array, $type='encode', $echo=0){
		$type=='encode' && $res = json_encode($array);
		$type=='decode' && $res = json_decode($array);
		if($echo){
			echo $res;
			exit;
		}else{
			return $res;
		}
	}
}