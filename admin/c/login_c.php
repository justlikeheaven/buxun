<?php
class login_c extends controller {
	
	public function index(){
		$this->display('login');
	}
	
	public function login(){
		$where['username'] = $this->req('username', '', 'trim');
		
		$password = $this->req('password', '', 'trim');
		$query = oo::m('admin')->where($where)->get();
		if(!$query){
			$this->msg('账号错误');
		}else if(md5($password.$query['salt']) == $query['password']){
			$this->redirect('index');
		}else{
			$this->msg('密码错误');
		}
	}
}