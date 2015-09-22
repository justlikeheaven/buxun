ALTER TABLE  `seller` ADD  `banner` VARCHAR( 50 ) NOT NULL DEFAULT  '' COMMENT  'banner' AFTER  `img`;
ALTER TABLE  `seller` ADD  `photo` VARCHAR( 500 ) NOT NULL DEFAULT  '' COMMENT  '商家介绍图' AFTER  `banner`;
CREATE TABLE `seller_hot` (
 `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
 `seller_id` int(10) unsigned NOT NULL COMMENT '商家id',
 `hot` tinyint(1) unsigned NOT NULL COMMENT '是否最热，0-否，1-是',
 PRIMARY KEY (`id`),
 UNIQUE KEY `product_id` (`seller_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='最热商家'
