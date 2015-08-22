<?php
class controller extends component{
	
	protected function display($file=''){
		$data = $this->vars;
		$nfs = array('c'=>NFS::$controller, 'a'=>NFS::$action);
		empty($file) && $file = NFS::$action;
		include VIEW_ROOT.$file.'.html';
	}
	
	protected function assign($name, $var){
		$this->vars[$name] = $var;
	}
	
	protected function req($name, $default=null, $callback=null, $type='REQUEST'){
		return request::param($name, $default, $callback, $type);//array(array($this, $callback))
	}

	protected function json($array){
    		return oo::base('request')->json($array, 'encode', 1);
    	}
}