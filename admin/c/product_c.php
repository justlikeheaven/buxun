<?php
class product_c extends base_form_c {
	
	protected function before_add(&$res){
		$res['form']['cateid']['list'] = oo::m('product_cate')->fields('id as value, name as str')->getall();
		$res['form']['sellerid']['list'] = oo::m('seller')->fields('id as value, name as str')->getall();
		$res['form']['hot']['list'] = array(array('value'=>0,'str'=>'否'), array('value'=>1,'str'=>'是'));
		
	}
	
	protected function before_edit(&$res){
		$res['hot'] = oo::m('product_hot')->where(array('product_id'=>$this->id, 'hot'=>1))->count() ? 1 : 0;
		$product_detail = oo::m('product_detail')->where(array('product_id'=>$this->id))->get();
		is_array($product_detail) && $res = array_merge($res, $product_detail)	;
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
			if($v['type']=='uploadify'){
				if(empty($data[$k])){
					unset($data[$k]);
				}else{
					$data[$k] = trim($data[$k], ',');
				}
			}
		}
		
		$unset_fields = array('hot', 'chengfen', 'fukuan', 'kezhong', 'yongtu', 'huohao');
		foreach ($unset_fields as $v){
			unset($data[$v]);
		}
		
	}

	protected function after_post(&$data){
		$hot = intval($data['hot']) ? 1 : 0;
		$sql = "INSERT INTO #table (`product_id`, `hot`) VALUES ({$this->id}, {$hot}) ON DUPLICATE KEY UPDATE `hot`={$hot}";
		oo::m('product_hot')->execute($sql);
		
		
		$sql = "INSERT INTO #table (`product_id`, `chengfen`, `fukuan`, `kezhong`, `yongtu`, `huohao`) VALUES 
		({$this->id}, '{$data['chengfen']}', '{$data['fukuan']}', '{$data['kezhong']}', '{$data['yongtu']}', '{$data['huohao']}') 
		ON DUPLICATE KEY UPDATE `chengfen`='{$data['chengfen']}', `fukuan`='{$data['fukuan']}',
		`kezhong`='{$data['kezhong']}', `yongtu`='{$data['yongtu']}',`huohao`='{$data['huohao']}'";
		oo::m('product_detail')->execute($sql);
	}
}


