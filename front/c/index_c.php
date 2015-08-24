<?php
class index_c extends controller{
	protected function __init(){
		
	}

	public function index(){
		//获取最热
		$hot = db::getall("SELECT * FROM `product_hot` AS ph, `product` AS p WHERE ph.product_id=p.id AND ph.hot=1");
		$this->assign('hot', $hot);
		
		//获取分类下的最新
		$cate = oo::m('product_cate')->getall();
		$list['zz']['img'] = $cate[0]['img'];
		$list['zz']['list'] = oo::m('product')->where(array('cateid'=>1))->limit(8)->orderby('ctime desc')->getall();//最新针织
		
		$list['sz']['img'] = $cate[1]['img'];
		$list['sz']['list'] = oo::m('product')->where(array('cateid'=>2))->limit(8)->orderby('ctime desc')->getall();//最新梭织
		$this->assign('list', $list);
		$this->display();
	}
	
	
    
}