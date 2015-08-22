<?php
class controller_form extends controller {
	protected $id;
	protected $form;
	protected $m;
	
	protected function _init(){
		$this->id = $this->req('id');
		if(!$this->form = oo::cfg('form.'.NFS::$controller, null, false)){
			echo 'no '.NFS::$controller.' cfg in form.php';
		}
		empty($this->form['tpl']) && $this->form['tpl'] = 'form';

		$this->assign('form', $this->form);
		$this->m = oo::m();
	}
	
	/*
	public function __call($name, $args){
		p($name, $args);
		$m = oo::m(NFS::$controller)->$name($args);
		p($m);
		//p($name, $args);
	}
	*/
	public function _get(){
		$total = $this->m->count();
		$page = $this->req('page');
		pager::init($page, $total);
		$list = $this->m->limit(pager::$start, pager::$num)->getall();
		method_exists($this, 'after_get') && $this->after_get($list);
		$this->assign('pager', pager::get());
		$this->assign('list', $list);
		$this->display("{$this->form['tpl']}_list");
	}
	
	public function _post(){
		foreach ($this->form['fields'] as $field=>$info){
			if($info['type']=='auto'){
				if($info['action']=='insert'){//如果只是在创建的时候写入自动值
					!$this->id && $data[$field] = $info['value'];
				}else{
					$data[$field] = $info['value'];
				}
			}else{
				$data[$field] = $this->req($field);
			}
		}
		$msg = "提交失败";
		method_exists($this, 'before_post') && $this->before_post($data);
		if($this->id){ //编辑
			if($this->m->where(array('id'=>$this->id))->update($data)){
				$msg = "提交成功";
			}
		}else{ //添加
			if($this->m->insert($data)){
				$msg = "提交成功";
			}
		}
		$this->assign('msg', $msg);
		$this->assign('url', NFS::url());
		$this->display('msg');
	}
    
	public function add(){
		if($this->id){ //编辑
			$res = $this->m->where(array('id'=>$this->id))->get();
			method_exists($this, 'before_add') && $this->before_add($res);
			$this->assign('res', $res);	
		}
		$this->display("{$this->form['tpl']}_save");
	}
	
	public function delete(){
		$msg = '删除失败';
		if($this->id){
			if(oo::m()->where(array('id'=>$this->id))->delete()){
				$msg = '删除成功';
			}
		}
		$this->assign('msg', $msg);
		$this->assign('url', NFS::url());
		$this->display('msg');
	}
	
	public function upload(){
		foreach ($this->form['fields'] as $k=>$v){
			if($v['type']=='img' && is_array($_FILES[$k])){
				$imgfield = $k;
				break;
			}
		}

		$upload = file::upload($imgfield, 'data/pics/');//上传图片
		if($upload['error']){
			echo -1;
		}else if($upload['success']){
			echo $upload['success'][0];
		}else{
			echo -1;
		}
	}
}