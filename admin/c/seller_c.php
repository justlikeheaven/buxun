<?php
class seller_c extends base_c {
	/*
	public function _init(){
		echo __METHOD__.'<br />';
	}
	*/
	
	public function get(){
		$list = oo::m('seller')->getall();
		
		$this->display($list, 'seller_list');
	}
	
	
    
}


