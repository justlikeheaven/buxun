<?php
class base_form_c extends controller_form {
	protected $result = array('result'=>0, 'msg'=>'error'); 
	public static $err = array(
		-1 => '非法请求',
	);
	
	public function __construct(){
		parent::__construct();
		$menuquery = oo::m('menu')->getall();
		foreach ($menuquery as $v){
			if($v['pid'])	$menu[$v['pid']]['children'][$v['route']] = $v['name'];
			else $menu[$v['id']]['name'] = $v['name'];
		}
		$this->assign('menu', $menu);
		$this->_login();
	}
	
	protected function _login(){
		if(!$_SESSION['username']){
			$this->redirect('login.index');
		}
	}
	
	function json($res=null, $msg=null){
		if(is_null($res)){
			$res = $this->result;
		}else if(is_array($res) && !empty($res)){
			$res =  array_merge($this->result, array('result'=>$res));
		}else{
			$res['result'] = $res;
		}
		if(is_null($msg))	$res['msg'] = 'ok';
		
		return parent::json($res);
	}
	
	
	
}