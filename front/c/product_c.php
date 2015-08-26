<?php
class product_c extends controller{
	public function index(){
		$id = $this->req('id', 0, 'intval');
		if(!$id)	$this->redirect('index');
		
		$product = oo::m()->where(array('id'=>$id))->get();
		if(empty($product))	$this->redirect('index');
		$product_detail = oo::m('product_detail')->where(array('product_id'=>$id))->get();
		if(is_array($product_detail)){
			$product = array_merge($product, $product_detail);
		}
		$res['product'] = $product;
		$res['seller'] = oo::m('seller')->where(array('id'=>$product['sellerid']))->get();
		$this->assign('res', $res);
		
		$seller_products = oo::m()->where(array('sellerid'=>$product['sellerid']))->orderby('id desc')->limit(5)->getall();
		$this->assign('seller_products', $seller_products);
		
		$this->display('product');
	}
	
	
    
}