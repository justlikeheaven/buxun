<?php
class menu_c extends base_form_c {
	protected function after_get(&$res){
		$pids = oo::m('menu')->where(array('pid'=>0))->getall();
		foreach ($pids as $v){
			$menu[$v['id']] = $v['name'];
		}
		foreach ($res as &$v){
			$v['pid'] = $menu[$v['pid']];
		}
	}
	protected function before_save(&$res){
		//找到一级菜单
		$pids = oo::m('menu')->where(array('pid'=>0))->getall();
		$res['form']['pid']['list'][] = array('value'=>0, 'str'=>'无');
		foreach ($pids as $v){
			$res['form']['pid']['list'][] = array('value'=>$v['id'], 'str'=>$v['name']);
		}
		//var_dump($res);
	}
}