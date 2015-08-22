<?php
class product_c extends controller_form  {
	protected function _init(){
		parent::_init();
		
	}
	
	protected function before_add(&$res){
		$res['form']['cateid']['list'] = oo::m('product_cate')->fields('id as value, name as str')->getall();
		$res['form']['sellerid']['list'] = oo::m('seller')->fields('id as value, name as str')->getall();
	}
	
	protected function after_get(&$list){
		foreach ($list as &$v){
			$v['ctime'] = date('Y-m-d H:i:s', $v['ctime']);
			$v['mtime'] = date('Y-m-d H:i:s', $v['mtime']);
			
			$cate = oo::m('product_cate')->fields('name')->where(array('id'=>$v['cateid']))->get();
			$v['cateid'] = $cate['name'];
			
			$seller = oo::m('seller')->fields('name')->where(array('id'=>$v['sellerid']))->get();
			$v['sellerid'] = $seller['name'];
		}
	}
	
	protected function before_post(&$data){
		foreach ($this->form['fields'] as $k=>$v){
			if($v['type']=='img'){
				if(empty($data[$k])){
					unset($data[$k]);
				}else{
					$data[$k] = trim($data[$k], ',');
				}
			}
		}
		
			 
	}
}


