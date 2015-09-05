<?php
class cfg_c extends base_c {
	public function index(){
		//列出cfg下的文件配置清单
		$files = file::listdir(CONFIG_ROOT);
		$this->assign('files', $files);
		$this->display('cfg_list');
	}
	
	public function save(){
		$id = $this->req('id', '', 'trim');
		if(!empty($id)){
			$res = file::import(CONFIG_ROOT.$id);
			$this->assign('res', $res);
		
		}else{
			
		}
		$this->display('cfg_save');
	}
}