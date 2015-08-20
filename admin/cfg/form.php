<?php
return array(
	'seller'=>array(
		'desc'=>'商家',
		'fields'=>array(
			'name'=>array('type'=>'text', 'str'=>'名称'),
			'desc'=>array('type'=>'textarea', 'str'=>'描述'),
			'img'=>array('type'=>'img', 'str'=>'logo'),
		),
		'tpl'=>'form',//默认为form
	),
	
	'product_cate'=>array(
		'desc'=>'商品类别',
		'fields'=>array(
			'name'=>array('type'=>'text', 'str'=>'名称'),
			'desc'=>array('type'=>'textarea', 'str'=>'描述'),
			'img'=>array('type'=>'img', 'str'=>'logo'),
		),
	),
	
	'product'=>array(
		'desc'=>'商品',
		'fields'=>array(
			'cateid'=>array('type'=>'hidden', 'str'=>'商品分类id', 'list'=>'hidden'),
			'sellerid'=>array('type'=>'hidden', 'str'=>'卖家id', 'list'=>'hidden'),
			'name'=>array('type'=>'text', 'str'=>'名称'),
			'price'=>array('type'=>'text', 'str'=>'价格'),
			'img'=>array('type'=>'img', 'str'=>'图片'),
			'ctime'=>array('type'=>'auto', 'action'=>'insert', 'value'=>time(), 'str'=>'创建时间'),
			'mtime'=>array('type'=>'auto', 'value'=>time(), 'str'=>'修改时间'),
		),
	),
	
	'user'=>array(
		'desc'=>'用户',
		'fields'=>array(
			'username'=>array('type'=>'text', 'str'=>'名称'),
			
		),
	),
);