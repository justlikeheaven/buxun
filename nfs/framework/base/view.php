<?php
class view extends component {
	public static function display($file='', $ext='.html'){
		empty($file) && $file = NFS::$action;
		include VIEW_ROOT.$file.$ext;
	}
	
}
