<?php
class seller_c extends base_form_c {
	
	protected function before_edit(&$res){
		$res['hot'] = oo::m('seller_hot')->where(array('seller_id'=>$this->id, 'hot'=>1))->count() ? 1 : 0;
	}
	
	protected function before_post(&$data){
		$unset_fields = array('hot');
		foreach ($unset_fields as $v){
			unset($data[$v]);
		}
		
	}

	protected function after_post(&$data){
		$hot = intval($data['hot']) ? 1 : 0;
		if($this->id || (!$this->id && $hot)){
			$sql = "INSERT INTO #table (`seller_id`, `hot`) VALUES ({$this->id}, {$hot}) ON DUPLICATE KEY UPDATE `hot`={$hot}";
			oo::m('seller_hot')->execute($sql);
		}
		
		
		
		
	}
}