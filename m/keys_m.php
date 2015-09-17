<?php
class keys_m {
	const SEP = '.';
	public static $index_hot='index_hot';
	public static $product_clicknum = 'product_clicknum';
	
	public static function product_clicknum($sellerid){
		return implode(self::SEP, array(self::$product_clicknum, $sellerid));
	}
}