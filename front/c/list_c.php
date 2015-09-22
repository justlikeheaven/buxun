<?php
class list_c extends controller{
	public function index(){
		$cid = $this->req('cid', 0, 'intval');
		$where = array();
		$cid && $where = array('cateid'=>$cid);

		$total = oo::m('product')->where($where)->count();
		$page = $this->req('page');
		pager::settpl(oo::cfg('pager'));
		pager::init($page, $total, 18);
		$this->assign('pager', pager::get());
		$list = oo::m('product')->limit(pager::$start, pager::$num)->orderby('id desc')->where($where)->getall();
		$this->assign('list', $list);
		
		//推荐商家
		$seller = oo::m('seller')->limit(5)->getall();

		$this->assign('seller', $seller);
		
		$this->display('list');
	}
}