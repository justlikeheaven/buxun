<?php
class product_c extends controller{
	public function index(){
		$id = $this->req('id', 0, 'intval');
		if(!$id) $this->redirect('index');
		$res = oo::m()->where(array('id'=>$id))->get();
		$product_detail = oo::m('product_detail')->where(array('product_id'=>$id))->get();
		if(is_array($product_detail)){
			$res = array_merge($res, $product_detail);
		}
		$this->assign('res', $res);
		
		$seller_products = oo::m()->where(array('sellerid'=>$res['sellerid']))->orderby('id desc')->limit(5)->getall();
		$this->assign('seller_products', $seller_products);
		
		$this->display('product');
	}
	
	
    
}