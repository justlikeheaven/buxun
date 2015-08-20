<?php
class controller_auto extends controller {
	protected $id;
	protected $form;
	protected $m;
	
	public function _init(){
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
		pager::init($page, 1, $total);

		$list = $this->m->limit(pager::$start, pager::$num)->getall();

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

		if($this->id){ //编辑
			if($this->m->where(array('id'=>$this->id))->update($data)){
				$msg = "提交成功";
			}else{
				$msg = "提交失败";
			}
		}else{//添加
			if($this->m->insert($data)){
				$msg = "提交成功";
			}else{
				$msg = "提交失败";
			}
		}
		$this->assign('msg', $msg);
		$this->assign('url', NFS::url());
		$this->display('msg');
	}
    
	public function add(){
		if($this->id){ //编辑
			$res = $this->m->where(array('id'=>$this->id))->get();
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
	
}