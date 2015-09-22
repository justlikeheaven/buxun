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
		
		
		
		//根据点击量获取最热商品
		$hotid = cacheredis::init()->zrevrange(keys_m::product_clicknum($id), 0, 9);
		$product_hot = array();
		if(!$hotid){
			//$hotid = array(1,2);
		}
		if($hotid){
			$hotid_str = implode(', ', $hotid);
			$product_hot = oo::m('product')->where("id in ({$hotid_str})")->limit(12)->getall();
		}
		$this->assign('product_hot', $product_hot);
		
		//获取商家发布的最新商品
		$where = "sellerid={$id} ";
		$hotid_str && $where .= " and id not in({$hotid_str})";
		$product_new = oo::m('product')->where($where)->limit(12)->getall();
		$this->assign('product_new', $product_new);
		
		$this->display('seller');
	}
	
	
    
}