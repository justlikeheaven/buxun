<?php
class product_c extends controller_form  {
	
	protected function before_add(&$res){
		$res['form']['cateid']['list'] = oo::m('product_cate')->fields('id as value, name as str')->getall();
		$res['form']['sellerid']['list'] = oo::m('seller')->fields('id as value, name as str')->getall();
		$res['form']['hot']['list'] = array(array('value'=>0,'str'=>'否'), array('value'=>1,'str'=>'是'));
		
	}
	
	protected function before_edit(&$res){
		$res['hot'] = oo::m('product_hot')->where(array('product_id'=>$this->id, 'hot'=>1))->count() ? 1 : 0;	
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
		$hot = intval($data['hot']) ? 1 : 0;
		$sql = "INSERT INTO #table (`product_id`, `hot`) VALUES ({$this->id}, {$hot}) ON DUPLICATE KEY UPDATE `hot`={$hot}";

		oo::m('product_hot')->execute($sql);

		unset($data['hot']);
	}
}


