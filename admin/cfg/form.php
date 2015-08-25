<?php
/**
 * 自动表单配置，实现简单的增删查改
 */
return array(
	'banner'=>array(
		'desc'=>'轮播图',
		'fields'=>array(
			'href'=>array('type'=>'text', 'str'=>'链接'),
			'img'=>array('type'=>'file', 'str'=>'图片', 'hide'=>'list'),
			'desc'=>array('type'=>'text', 'str'=>'描述'),
		),
	),
	'seller'=>array(
		'desc'=>'商家',
		'fields'=>array(
			'name'=>array('type'=>'text', 'str'=>'名称'),
			'desc'=>array('type'=>'textarea', 'str'=>'描述'),
			'address'=>array('type'=>'textarea', 'str'=>'地址'),
			'tel'=>array('type'=>'text', 'str'=>'电话'),
			'img'=>array('type'=>'file', 'str'=>'logo', 'hide'=>'list'),
		),
	),
	
	'product_cate'=>array(
		'desc'=>'商品类别',
		'fields'=>array(
			'name'=>array('type'=>'text', 'str'=>'名称'),
			'desc'=>array('type'=>'textarea', 'str'=>'描述'),
			'img'=>array('type'=>'file', 'str'=>'logo', 'hide'=>'list'),
		),
	),
	
	'product'=>array(
		'desc'=>'商品',
		'fields'=>array(
			'cateid'=>array('type'=>'select', 'str'=>'分类'),
			'sellerid'=>array('type'=>'select', 'str'=>'商家'),
			'hot' => array('type'=>'select', 'str'=>'最热', 'hide'=>'list', 'desc'=>'最热商品将会推到首页显示'),
			'name'=>array('type'=>'text', 'str'=>'名称'),
			'price'=>array('type'=>'text', 'str'=>'价格'),
			'chengfen'=>array('type'=>'text', 'str'=>'成分', 'hide'=>'list'),
			'fukuan'=>array('type'=>'text', 'str'=>'幅宽', 'hide'=>'list'),
			'kezhong'=>array('type'=>'text', 'str'=>'克重', 'hide'=>'list'),
			'yongtu'=>array('type'=>'text', 'str'=>'用途', 'hide'=>'list'),
			'huohao'=>array('type'=>'text', 'str'=>'货号', 'hide'=>'list'),
			'img_model'=>array('type'=>'file', 'str'=>'模特效果图', 'hide'=>'list'),
			'img_product'=>array('type'=>'file', 'str'=>'布料高清图', 'hide'=>'list', 'desc'=>'非最热商品可不传'),
			'desc'=>array('type'=>'editor', 'str'=>'详情', 'hide'=>'list'),
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