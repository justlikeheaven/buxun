<?php
class index_c extends controller{
	protected function __init(){
		
	}

	public function index(){
		//banner
		$banner = oo::m('banner')->getall();
		$this->assign('banner', $banner);

		//获取最热
		//if(!$hot = cacheredis::init()->get(keys_m::$index_hot)){
			$product_hot = db::getall("SELECT p.* FROM `product_hot` AS ph, `product` AS p WHERE ph.product_id=p.id AND ph.hot=1 order by p.id desc limit 12");
			//cacheredis::init()->set(keys_m::$index_hot, json_encode($hot));
		//}else{
			//$hot = json_decode($hot, true);
		//}
		
		$this->assign('product_hot', $product_hot);
		
		$except_hot = '';
		if(is_array($hot) && !empty($hot)){
			foreach ($hot as $v){
				$hotid[] = $v['id'];
			}
			$except_hot = ' and id not in ('.implode(', ', $hotid).')';
		}
		//获取分类下的最新
		$cate = oo::m('product_cate')->getall();

		foreach ($cate as $v){
			$value = array('img'=>$v['img'], 'id'=>intval($v['id']));
			if($v['name']=='针织'){
				$catename = 'zz';
			}else if($v['name']=='梭织'){
				$catename = 'sz';
			}
			$catearr[$catename] = array('img'=>$v['img'], 'id'=>$v['id']);
		}
		$list['zz']['img'] = $catearr['zz']['img'];
		$catearr['zz']['id'] && $list['zz']['list'] = oo::m('product')->where("cateid={$catearr['zz']['id']} {$except_hot}")->limit(8)->orderby('id desc')->getall();//最新针织
		
		$list['sz']['img'] = $catearr['sz']['img'];
		$catearr['sz']['id'] && $list['sz']['list'] = oo::m('product')->where("cateid={$catearr['sz']['id']} {$except_hot}")->limit(8)->orderby('id desc')->getall();//最新梭织
		$this->assign('list', $list);
		
		//获取推荐商家
		$seller_hot = db::getall("SELECT s.id, s.name, s.img FROM `seller_hot` AS sh, `seller` AS s 
		WHERE sh.seller_id=s.id AND sh.hot=1 order by s.id desc limit 6");
		
		$this->assign('seller_hot', $seller_hot);
		
		$this->display();
	}
	
	
    
}