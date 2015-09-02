<?php
class base_c extends controller {
	protected $result = array('result'=>0, 'msg'=>'error'); 
	public static $err = array(
		-1 => '非法请求',
	);
	
	protected function _init(){
		$menuquery = oo::m('menu')->getall();
		/*
		'base'=>array(
		'desc'=>'网站设置',
		'children'=>array(
			'banner'=>'轮播图',
			'seller'=>'商家',
			'product_cate'=>'商品类别',
			'product'=>'商品',
		)
	),
	*/
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