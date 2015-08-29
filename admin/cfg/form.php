<?php
/**
 * 自动表单配置，实现简单的增删查改
 */
return array(
	'banner'=>array(
		'desc'=>'轮播图',
		'fields'=>array(
			'href'=>array('type'=>'text', 'str'=>'链接', 'default'=>''),
			'img'=>array('type'=>'file', 'str'=>'图片', 'hide'=>'list'),
			'desc'=>array('type'=>'text', 'str'=>'描述', 'default'=>''),
		),
	),
	'seller'=>array(
		'desc'=>'商家',
		'fields'=>array(
			'name'=>array('type'=>'text', 'str'=>'名称'),
			'desc'=>array('type'=>'textarea', 'str'=>'描述', 'hide'=>'list', 'default'=>''),
			'shop_address'=>array('type'=>'textarea', 'str'=>'门市地址'),
			'depot_address'=>array('type'=>'textarea', 'str'=>'仓库地址', 'hide'=>'list', 'default'=>''),
			'tel'=>array('type'=>'text', 'str'=>'门市电话'),
			'mobile'=>array('type'=>'text', 'str'=>'手机号码', 'default'=>''),
			'fax'=>array('type'=>'text', 'str'=>'传真', 'hide'=>'list', 'default'=>''),
			'img'=>array('type'=>'file', 'str'=>'logo', 'hide'=>'list', 'default'=>''),
		),
	),
	
	'product_cate'=>array(
		'desc'=>'商品类别',
		'fields'=>array(
			'name'=>array('type'=>'text', 'str'=>'名称'),
			'desc'=>array('type'=>'textarea', 'str'=>'描述', 'default'=>''),
			'img'=>array('type'=>'file', 'str'=>'logo', 'hide'=>'list', 'default'=>''),
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
			'chengfen'=>array('type'=>'text', 'str'=>'成分', 'hide'=>'list', 'default'=>''),
			'fukuan'=>array('type'=>'text', 'str'=>'幅宽', 'hide'=>'list', 'default'=>''),
			'kezhong'=>array('type'=>'text', 'str'=>'克重', 'hide'=>'list', 'default'=>''),
			'yongtu'=>array('type'=>'text', 'str'=>'用途', 'hide'=>'list', 'default'=>''),
			'huohao'=>array('type'=>'text', 'str'=>'货号', 'hide'=>'list', 'default'=>''),
			'img_model'=>array('type'=>'file', 'str'=>'模特效果图', 'hide'=>'list'),
			'img_product'=>array('type'=>'file', 'str'=>'布料高清图', 'hide'=>'list', 'desc'=>'用于首页最热商品底图，非最热商品可不传', 'default'=>''),
			'desc'=>array('type'=>'editor', 'str'=>'详情', 'hide'=>'list'),
			'ctime'=>array('type'=>'auto', 'action'=>'insert', 'value'=>time(), 'str'=>'创建时间'),
			'mtime'=>array('type'=>'auto', 'value'=>time(), 'str'=>'修改时间'),
		),
	),
	
	'menu'=>array(
		'desc'=>'菜单',
		'fields'=>array(
			'name'=>array('type'=>'text', 'str'=>'名称'),
			'route'=>array('type'=>'text', 'str'=>'路由', 'desc'=>'eg. product/get'),
		),
	),
	'admin_group'=>array(
		'desc'=>'权限',
		'fields'=>array(
			'name'=>array('type'=>'text', 'str'=>'组名'),
			'mod'=>array('type'=>'text', 'str'=>'权限'),
		),
	),
	'admin'=>array(
		'desc'=>'管理员',
		'fields'=>array(
			'username'=>array('type'=>'text', 'str'=>'账号'),
			'password'=>array('type'=>'text', 'str'=>'密码', 'hide'=>array('list', 'add')),
			//'salt'=>array('type'=>'auto', 'str'=>'盐值', 'value'=>func::rand_str(), 'hide'=>array('list', 'save')),
			//'group_id'=>array('type'=>'text', 'str'=>'密码'),
		),
	),
);

