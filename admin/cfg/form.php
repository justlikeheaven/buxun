<?php
return array(
	'seller'=>array(
		'desc'=>'商家管理',
		'fields'=>array('name'=>array('type'=>'text', 'str'=>'名称'), 'desc'=>array('type'=>'textarea', 'str'=>'描述'), 'img'=>array('type'=>'img', 'str'=>'logo')),
		'tpl'=>'form',//默认为form
	),
	
	'product'=>array(
		'fields'=>array('name'=>'text', 'desc'=>'textarea', 'img'=>'img'),
		'tpl'=>'form',//默认为form
	),
);