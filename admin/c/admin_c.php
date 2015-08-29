<?php
class admin_c extends base_form_c {
	protected $password_default='buxun1234567890123';
	
	protected function before_insert(&$data){
		$data['salt'] = func::str_rand();
		$data['password'] = md5($this->password_default.$data['salt']);
	}
	
	protected function before_update(&$data){
		$data['salt'] = func::str_rand();
		$data['password'] = md5($data['password'].$data['salt']);
	}
	
	protected function before_edit(&$data){
		unset($data['password']);
	}
	
	protected function after_post(&$data){
		unset($_SESSION['username']);
		$this->redirect('login');
	}
}