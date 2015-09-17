<?php
class seller_c extends controller{
	
	public function index(){
		
		$id = $this->req('id', 0, 'intval');
		if(!$id)	$this->redirect('index');
		
		//获取商家详情
		$seller = oo::m()->where(array('id'=>$id))->get();
		if(empty($seller))	$this->redirect('index');
		
		if(!empty($seller['photo'])){
			$seller['photo'] = explode(',', $seller['photo']);
		}
		$this->assign('seller', $seller);
		
		//获取商家发布的最新商品
		$product_new = oo::m('product')->where(array('sellerid'=>$id))->limit(12)->getall();
		$this->assign('product_new', $product_new);
		
		$this->display('seller');
	}
	
	
    
}