<?php
function p($vars){
	$vars = func_get_args();
	if(count($vars)===1)	$vars = $vars[0];
	echo "<pre>";
	var_dump($vars);
	echo "<pre>";
}

class func{
	public static function each($arr, $callback){
		if(!is_array($arr) || empty($arr)) return null;
		foreach ($arr as $k=>$v){
			
		}
	}
	
	
}