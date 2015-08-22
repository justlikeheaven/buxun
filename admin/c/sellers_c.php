<?php
class seller_c extends controller_form {
	protected function before_post(&$data){
		if(empty($data['img'])){
			unset($data['img']);
		}else{
			$data['img'] = trim($data['img'], ',');
		}
			 
	}
}