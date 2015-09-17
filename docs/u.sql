ALTER TABLE  `product_cate` CHANGE  `img`  `img` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT  '' COMMENT  '图片';

ALTER TABLE  `seller` ADD  `banner` VARCHAR( 50 ) NOT NULL DEFAULT  '' COMMENT  'banner' AFTER  `img`;
ALTER TABLE  `seller` ADD  `photo` VARCHAR( 500 ) NOT NULL DEFAULT  '' COMMENT  '商家介绍图' AFTER  `banner`;

