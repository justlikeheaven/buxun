<?php
class seller_c extends base_c {
	protected $id;
	
	public function _init(){
		$this->id = $this->req('id');
	}
	
	
	public function _get(){
		$total = oo::m()->count();
		
		$page = $this->req('page');
		pager::init($page, 1, $total);

		$list = oo::m()->limit(pager::$start, pager::$num)->getall();

		$this->assign('pager', pager::get());
		$this->assign('list', $list);
		$this->display('seller_list');
	}
	
	public function _post(){
		$data = array(
			'name'=>$this->req('name'),
			'desc'=>$this->req('desc'),
		);
	
		if($this->id){ //编辑
			if(oo::m()->where(array('id'=>$id))->update($data)){
				$msg = "提交成功";
			}else{
				$msg = "提交失败";
			}
		}else{//添加
			if(oo::m()->insert($data)){
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
		
		if($this->id){ //编辑
			$seller = oo::m()->where(array('id'=>$id))->get();
			$this->assign('seller', $seller);	
		}
		$this->display('seller_add');
	}
	
	public function delete(){
		$msg = '删除失败';
		if($this->id){
			if(oo::m()->where(array('id'=>$this->id))->delete()){
				$msg = '删除成功';
			}
		}
		$this->assign('msg', $msg);
		$this->assign('url', NFS::url('seller'));
		$this->display('msg');
	}
}


