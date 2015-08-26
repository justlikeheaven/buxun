<?php
class list_c extends controller{
	public function index(){
		$cid = $this->req('cid', 1, 'intval');
		$total = oo::m('product')->where(array('cateid'=>$cid))->count();
		$page = $this->req('page');
		pager::init($page, $total);
		$list = oo::m('product')->limit(pager::$start, pager::$num)->orderby('id desc')->where(array('cateid'=>$cid))->getall();
		$this->assign('list', $list);
		
		//推荐商家
		$seller = oo::m('seller')->limit(5)->getall();

		$this->assign('seller', $seller);
		
		$this->display('list');
	}
}