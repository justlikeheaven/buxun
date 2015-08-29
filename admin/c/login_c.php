<?php
class login_c extends controller {
	
	public function index(){
		$this->display('login');
	}
	
	//登录验证
	public function login(){
		$where['username'] = $this->req('username', '', 'trim');
		
		$password = $this->req('password', '', 'trim');
		$query = oo::m('admin')->where($where)->get();
		if(!$query){
			$this->msg('账号错误');
		}else if(md5($password.$query['salt']) == $query['password']){
			$_SESSION['username'] = $query['username'];
			$this->redirect('index');
		}else{
			$this->msg('密码错误');
		}
	}
	
	//退出系统
	public function out(){
		session_unset();
		session_destroy();
		$this->redirect('login');
	}
}