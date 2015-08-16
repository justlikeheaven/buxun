<?php
class seller_c extends base_c {
	/*
	public function _init(){
		echo __METHOD__.'<br />';
	}
	*/
	
	public function _get(){
		$list = oo::m()->getall();
		$this->assign('list', $list);
		$this->display('seller_list');
	}
	
	public function _post(){
		$id = $this->req('id');
		$data = array(
			'name'=>$this->req('name'),
			'desc'=>$this->req('desc'),
		);
			
		if($id){ //编辑
			if(oo::m()->update(array('id'=>$id), $data)){
				$msg = "提交成功";
			}else{
				$msg = "提交失败";
			}
		}else{
			
			if(oo::m()->add($data)){
				$msg = "提交成功";
			}else{
				$msg = "提交失败";
			}
		}
		$this->assign('msg', $msg);
		$this->assign('url', NFS::url('seller'));
		$this->display('msg');
	}
    
	public function add(){
		$id = $this->req('id');
		if($id){ //编辑
			$seller = oo::m()->get(array('id'=>$id));
			$this->assign('seller', $seller);	
		}
		$this->display('seller_add');
	}
}


