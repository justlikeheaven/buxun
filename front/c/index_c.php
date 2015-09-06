<?php
class index_c extends controller{
	protected function __init(){
		
	}

	public function index(){
		//banner
		$banner = oo::m('banner')->getall();
		$this->assign('banner', $banner);

		//获取最热
		if(!$hot = cacheredis::init()->get(keys_m::$index_hot)){
			$hot = db::getall("SELECT * FROM `product_hot` AS ph, `product` AS p WHERE ph.product_id=p.id AND ph.hot=1");
			cacheredis::init()->set(keys_m::$index_hot, json_encode($hot));
		}else{
			$hot = json_decode($hot, true);
		}
		
		$this->assign('hot', $hot);
		
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
		$catearr['zz']['id'] && $list['zz']['list'] = oo::m('product')->where(array('cateid'=>$catearr['zz']['id']))->limit(8)->orderby('ctime desc')->getall();//最新针织
		
		$list['sz']['img'] = $catearr['sz']['img'];
		$catearr['sz']['id'] && $list['sz']['list'] = oo::m('product')->where(array('cateid'=>$catearr['sz']['id']))->limit(8)->orderby('ctime desc')->getall();//最新梭织
		$this->assign('list', $list);
		$this->display();
	}
	
	
    
}