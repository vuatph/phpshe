DROP TABLE IF EXISTS `{dbpre}ad`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}ad` (
  `ad_id` int(10) unsigned NOT NULL auto_increment,
  `ad_logo` varchar(100) NOT NULL,
  `ad_url` varchar(100) NOT NULL,
  `ad_position` varchar(15) NOT NULL,
  `ad_state` tinyint(1) unsigned NOT NULL default '1' COMMENT '广告显示状态',
  `ad_order` int(10) unsigned NOT NULL default '0',
  `category_id` smallint(5) unsigned NOT NULL default '0' COMMENT '分类id',
  PRIMARY KEY  (`ad_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
INSERT INTO `{dbpre}ad` VALUES('1','data/attachment/2017-05/20170503153149o.jpg','','index_jdt','1','0','0'),
('2','data/attachment/2017-05/20170503153226h.jpg','','index_jdt','1','0','0');
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}admin`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}admin` (
  `admin_id` int(10) unsigned NOT NULL auto_increment COMMENT '管理id',
  `admin_name` varchar(20) NOT NULL COMMENT '管理名',
  `admin_pw` varchar(32) NOT NULL COMMENT '管理密码',
  `admin_atime` int(10) unsigned NOT NULL default '0' COMMENT '管理注册时间',
  `admin_ltime` int(10) unsigned NOT NULL default '0' COMMENT '管理上次登录时间',
  `adminlevel_id` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
INSERT INTO `{dbpre}admin` VALUES('1','admin','21232f297a57a5a743894a0e4a801fc3','1269059337','1505793824','1');
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}adminlevel`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}adminlevel` (
  `adminlevel_id` smallint(5) unsigned NOT NULL auto_increment COMMENT '管理等级id',
  `adminlevel_name` varchar(20) NOT NULL COMMENT '管理等级名称',
  `adminlevel_modact` text NOT NULL COMMENT '管理等级权限',
  PRIMARY KEY  (`adminlevel_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
INSERT INTO `{dbpre}adminlevel` VALUES('1','总管理员','');
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}article`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}article` (
  `article_id` int(10) unsigned NOT NULL auto_increment,
  `article_name` varchar(100) NOT NULL,
  `article_text` text NOT NULL,
  `article_atime` int(10) unsigned NOT NULL default '0',
  `article_clicknum` int(10) unsigned NOT NULL default '0',
  `class_id` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`article_id`),
  KEY `class_id` (`class_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
INSERT INTO `{dbpre}article` VALUES('1','关于简好网络','灵宝简好网络科技有限公司，优秀的互联网平台与服务提供商，八年网站设计与开发经验，专业从事互联网软件开发等网络技术服务。自公司成立以来，简好网络始终秉承“产品简单好用，用心服务客户”的核心经营理念，在自主研发的创新之路稳健前行。&nbsp;\r\n<p>\r\n	<br />\r\n严谨的程序开发人员、专业的美工设计、良好的服务让我们在竞争激烈的互联网行业中蓬勃发展。通过我们多年在上百个不同行业领域的项目历练，加之对\r\n各行业、各类型客户需求的理解，抛开炒作与虚夸，以一贯低调、踏实、诚信的风格为企、事业单位提供更好更实用的一站式网站建设服务！&nbsp;\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	简好网络坚信质量和信誉是我们存在的基石。我们注重客户提出的每个要求并充分考虑每一个细节，积极做好服务，不断地完善自己，通过不懈的努力，我们把每一\r\n位客户都做成了朋友，感谢你们对简好网络的信任与支持，这种信任与支持激励着我们提供更优质的服务。在所有新老客户面前，我们都很乐意朴实的跟您接触，深\r\n入的了解您的企业，每一次倾心的合作，都是一个全新的体会和挑战，我们随时与您同在。\r\n</p>\r\n<p>\r\n	<br />\r\n业务范围：网站建设、网页设计、网站制作、软件开发、网站维护、域名注册、虚拟主机、网站推广、网络广告、电子商务、企业管理信息化、行业信息化解决方案、网络技术服务等。\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	详情请访问：<a href=\"http://www.phpshe.com\" target=\"_blank\"><strong><span style=\"color:#E53333;\">简好网络官方网站</span></strong></a> \r\n</p>','1335834720','940','1'),
('2','PHPSHE B2C商城系统v1.5版发布','【PHPSHE基本资料】:<br />\r\n当前版本：<strong>PHPSHE B2C商城系统v1.5 </strong>(build 20170515 UTF8)<br />\r\n官方网站：<a target=\"_blank\" href=\"http://www.phpshe.com/phpshe\">http://www.phpshe.com/phpshe</a><br />\r\n演示网站：<a target=\"_blank\" href=\"http://www.phpshe.com/demo/phpshe\">http://www.phpshe.com/demo/phpshe</a><br />\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	【PHPSHE系统简介】:\r\n</p>\r\n<p>\r\n	<a target=\"_blank\" href=\"http://www.phpshe.com/phpshe\"><span style=\"color:#E53333;\"><strong>PHPSHE商城系统</strong></span></a>是将商品管理、品牌管理、规格管理、促销管理、优惠券管理、在线购物、订单管理、资金管理、提现管理、支付管理、文章管理、会员管理、权限管理、通知管理、评价管理、数据统计等功能相结合，并提供了简易的操作、实用的功能，快速让用户建立独立个性化的网上商店，为用户提供了一个低成本、高效率的网上商城建设方案。\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	【PHPSHE功能概述】:\r\n</p>\r\n<p>\r\n	软件适用于于各行业产品销售的商家，主要包括有以下功能：\r\n</p>\r\n（1）管理员发布、修改，删除商品信息，商品多级分类检索、多属性检索等；<br />\r\n（2）管理员可以对商品品牌名称，图片，描述等管理；<br />\r\n（3）管理员可以对商品规格管理，如：尺寸，颜色，套餐等；<br />\r\n（4）管理员对商品评价管理；<br />\r\n（5）管理员对商品活动管理，优惠券管理；<br />\r\n（6）订单流程清晰，可及时便捷查询，修改和处理订单信息；<br />\r\n（7）会员积分体系，有效增加客户回购率及粘性；<br />\r\n（8）详细统计功能，实时显示每日订单情况，访客流量，热销排行，消费排行；<br />\r\n（9）管理员对文章分类管理、文章管理、单页信息管理；<br />\r\n（10）管理员对会员信息管理，管理帐号管理，管理权限管理；<br />\r\n（11）管理员对网站整体基本信息的系统设置；<br />\r\n（12）集成支付宝、转帐汇款、货到付款、微信支付等接口方便用户支付；<br />\r\n（13）邮件/短信实时提醒，随时随地掌握网站下单，付款，发货等情况；<br />\r\n（14）便捷模板中心，一键轻松更换不同风格的模板；<br />\r\n（15）高效缓存处理，提高系统的运行效率；<br />\r\n（16）一键对网站进行备份恢复，保障数据安全；<br />\r\n（17）支持首页导航、友情链接、首页广告图管理；<br />\r\n（18）会员注册、登录、订单管理、充值提现、资金明细、积分明细、优惠券、评价及商品收藏等。\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	【PHPSHE安装说明】:\r\n</p>\r\n1&gt; 用FTP工具（如flashfxp）把程序上传到服务器；<br />\r\n2&gt; 给./data 目录及其子目录 777 权限（windows服务器可忽略此步）；<br />\r\n3&gt; 访问http://您的网址/install进行安装。<br />\r\n<p>\r\n	<br />\r\n</p>\r\n【PHPSHE升级说明】\r\n<p>\r\n	老版本升级至1.5版本，请先上传PHPSHE1.5程序中的 ./install目录，然后访问 http://您的网址/install/update 按教程进行升级。\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<strong>详情请访问：</strong><a href=\"http://www.phpshe.com/phpshe\" target=\"_blank\"><strong><span style=\"color:#E53333;\">PHPSHE商城系统简介</span></strong></a> \r\n</p>','1494832260','889','1'),
('3','PHPSHE商城系统商业版','<div align=\"center\">\r\n	<p>\r\n		<img src=\"http://www.phpshe.com/data/attachment/2017-05/phpshe1.5.jpg\" alt=\"\" /> \r\n	</p>\r\n</div>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<strong>详情请访问：</strong><a href=\"http://www.phpshe.com/phpshe#buy\" target=\"_blank\"><strong><span style=\"color:#E53333;\">PHPSHE商城系统商业授权</span></strong></a> \r\n</p>\r\n<p>\r\n	<br />\r\n</p>','1494832500','1055','1'),
('5','购物指南','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>','1406563800','52','4'),
('6','支付方式','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>','1406564160','52','4'),
('7','常见问题','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>','1406564160','38','4'),
('8','配送时间及运费','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>','1406564220','294','5'),
('9','验货与签收','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>','1406564220','180','5'),
('10','订单查询','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>','1406564280','33','5'),
('11','售后政策','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>','1406564280','54','6'),
('12','退货说明','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>','1406564400','4','6'),
('13','取消订单','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>','1406564460','11','6'),
('14','公司简介','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>','1406564520','77','7'),
('15','联系我们','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>','1406564520','8','7'),
('16','诚聘英才','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>','1406564580','50','7'),
('17','货到付款','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>','1490769480','2','12'),
('18','在线支付','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>','1490769540','18','12'),
('19','邮局汇款','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>','1490769540','9','12'),
('20','公司转账','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>','1490769540','3','12');
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}ask`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}ask` (
  `ask_id` int(10) unsigned NOT NULL auto_increment,
  `ask_text` text NOT NULL,
  `ask_atime` int(10) unsigned NOT NULL default '0',
  `ask_replytext` text NOT NULL,
  `ask_replytime` int(10) unsigned NOT NULL default '0',
  `ask_state` tinyint(1) unsigned NOT NULL default '0',
  `product_id` int(10) unsigned NOT NULL,
  `product_name` varchar(50) NOT NULL COMMENT '商品名称',
  `product_logo` varchar(100) NOT NULL COMMENT '商品logo',
  `user_id` int(10) unsigned NOT NULL default '0',
  `user_name` varchar(20) NOT NULL,
  `user_ip` char(15) NOT NULL default '0.0.0.0',
  PRIMARY KEY  (`ask_id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}brand`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}brand` (
  `brand_id` smallint(5) unsigned NOT NULL auto_increment,
  `brand_name` varchar(30) NOT NULL,
  `brand_logo` varchar(255) NOT NULL COMMENT '品牌图片',
  `brand_text` varchar(255) NOT NULL COMMENT '品牌介绍',
  `brand_word` char(1) NOT NULL COMMENT '品牌首字母',
  `brand_order` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`brand_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}cart`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}cart` (
  `cart_id` int(10) unsigned NOT NULL auto_increment,
  `cart_type` varchar(4) NOT NULL default 'cart' COMMENT '购买类型(cart加入购物车/buy立即购买)',
  `cart_atime` int(10) unsigned NOT NULL default '0',
  `product_guid` char(32) NOT NULL COMMENT '唯一id',
  `product_id` int(10) unsigned NOT NULL default '0',
  `product_num` smallint(5) unsigned NOT NULL default '1',
  `prorule_key` varchar(30) NOT NULL COMMENT '规格id组合',
  `user_id` varchar(32) NOT NULL,
  PRIMARY KEY  (`cart_id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}cashout`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}cashout` (
  `cashout_id` int(10) unsigned NOT NULL auto_increment,
  `cashout_money` decimal(10,1) unsigned NOT NULL default '0.0',
  `cashout_fee` decimal(5,1) unsigned NOT NULL default '0.0' COMMENT '提现手续费',
  `cashout_atime` int(10) unsigned NOT NULL default '0',
  `cashout_ptime` int(10) unsigned NOT NULL default '0' COMMENT '结算日期',
  `cashout_state` tinyint(1) unsigned NOT NULL default '0',
  `cashout_ip` char(15) NOT NULL COMMENT '用户ip',
  `cashout_bankname` varchar(20) NOT NULL,
  `cashout_banknum` varchar(50) NOT NULL,
  `cashout_banktname` varchar(10) NOT NULL,
  `cashout_bankaddress` varchar(50) NOT NULL,
  `user_id` int(10) unsigned NOT NULL default '0',
  `user_name` varchar(30) NOT NULL,
  PRIMARY KEY  (`cashout_id`),
  KEY `user_id` (`user_id`),
  KEY `cashout_state` (`cashout_state`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}category`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}category` (
  `category_id` smallint(5) unsigned NOT NULL auto_increment,
  `category_pid` smallint(5) unsigned NOT NULL default '0',
  `category_name` varchar(30) NOT NULL,
  `category_title` varchar(100) NOT NULL,
  `category_keys` varchar(255) NOT NULL,
  `category_desc` varchar(255) NOT NULL,
  `category_order` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}class`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}class` (
  `class_id` smallint(5) unsigned NOT NULL auto_increment,
  `class_name` varchar(30) NOT NULL,
  `class_type` varchar(10) NOT NULL default 'news' COMMENT '分类类型',
  `class_order` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`class_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
INSERT INTO `{dbpre}class` VALUES('1','网站公告','news','0'),
('2','公司动态','news','1'),
('3','相关知识','news','2'),
('4','用户指南','help','1'),
('5','配送方式','help','2'),
('6','售后服务','help','4'),
('7','关于我们','help','5'),
('12','支付方式','help','3');
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}collect`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}collect` (
  `collect_id` int(10) unsigned NOT NULL auto_increment,
  `collect_atime` int(10) unsigned NOT NULL default '0',
  `product_id` int(10) unsigned NOT NULL default '0',
  `user_id` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`collect_id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}comment`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}comment` (
  `comment_id` int(10) unsigned NOT NULL auto_increment COMMENT '留言id',
  `comment_star` tinyint(1) unsigned NOT NULL default '5' COMMENT '评价星级',
  `comment_text` text NOT NULL COMMENT '留言内容',
  `comment_logo` text NOT NULL COMMENT '评价晒图',
  `comment_atime` int(10) NOT NULL default '0' COMMENT '留言时间',
  `product_id` int(10) unsigned NOT NULL,
  `product_name` varchar(50) NOT NULL COMMENT '商品名称',
  `product_logo` varchar(100) NOT NULL COMMENT '商品logo',
  `order_id` int(10) unsigned NOT NULL default '0',
  `user_id` int(10) unsigned NOT NULL COMMENT '接受方用户id',
  `user_name` varchar(20) NOT NULL,
  `user_logo` varchar(100) NOT NULL COMMENT '用户头像',
  `user_ip` char(15) NOT NULL default '0.0.0.0',
  PRIMARY KEY  (`comment_id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}express`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}express` (
  `express_id` smallint(5) unsigned NOT NULL auto_increment COMMENT '快递模板id',
  `express_name` varchar(30) NOT NULL COMMENT '快递模板名',
  `express_logo` varchar(100) NOT NULL COMMENT '快递模板logo',
  `express_tag` text NOT NULL COMMENT '快递模板信息',
  `express_width` int(10) unsigned NOT NULL,
  `express_height` int(10) unsigned NOT NULL,
  `express_width_px` int(10) unsigned NOT NULL default '0' COMMENT '像素宽',
  `express_height_px` int(10) unsigned NOT NULL default '0' COMMENT '像素高',
  `express_x` int(10) unsigned NOT NULL default '0' COMMENT 'x轴偏移量',
  `express_y` int(10) unsigned NOT NULL default '0' COMMENT 'y轴偏移量',
  `express_atime` int(10) unsigned NOT NULL default '0' COMMENT '添加时间',
  `express_state` tinyint(1) unsigned NOT NULL default '1' COMMENT '启用状态',
  `express_order` tinyint(3) unsigned NOT NULL default '255',
  PRIMARY KEY  (`express_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}getpw`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}getpw` (
  `getpw_id` int(10) unsigned NOT NULL auto_increment,
  `getpw_token` char(32) NOT NULL,
  `getpw_state` tinyint(1) unsigned NOT NULL default '0',
  `getpw_atime` int(10) unsigned NOT NULL default '0' COMMENT '绑定日期',
  `user_id` int(10) unsigned NOT NULL default '0',
  `user_name` varchar(20) NOT NULL,
  PRIMARY KEY  (`getpw_id`),
  KEY `getpw_token` (`getpw_token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}huodong`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}huodong` (
  `huodong_id` int(10) unsigned NOT NULL auto_increment COMMENT '活动自增id',
  `huodong_name` varchar(30) NOT NULL COMMENT '活动名称',
  `huodong_tag` varchar(10) NOT NULL COMMENT '活动价格标签',
  `huodong_atime` int(10) unsigned NOT NULL default '0' COMMENT '活动开始日期',
  `huodong_stime` int(10) unsigned NOT NULL default '0',
  `huodong_etime` int(10) unsigned NOT NULL default '0' COMMENT '活动结束日期',
  PRIMARY KEY  (`huodong_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}huodongdata`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}huodongdata` (
  `huodongdata_id` int(10) unsigned NOT NULL auto_increment,
  `huodong_id` int(10) unsigned NOT NULL default '0',
  `huodong_tag` varchar(10) NOT NULL,
  `huodong_stime` int(10) unsigned NOT NULL default '0',
  `huodong_etime` int(10) unsigned NOT NULL default '0',
  `huodong_zhe` float unsigned NOT NULL default '0' COMMENT '折扣率',
  `huodong_money` decimal(10,1) unsigned NOT NULL default '0.0',
  `product_id` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`huodongdata_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}iplog`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}iplog` (
  `iplog_id` int(10) unsigned NOT NULL auto_increment COMMENT 'ip记录id',
  `iplog_ip` char(15) NOT NULL COMMENT 'ip记录ip',
  `iplog_ipname` varchar(20) NOT NULL COMMENT '验证码上传省份',
  `iplog_atime` int(10) unsigned NOT NULL default '0' COMMENT 'ip记录时间',
  `iplog_adate` date NOT NULL COMMENT 'ip记录日期',
  PRIMARY KEY  (`iplog_id`),
  KEY `iplog_ip` (`iplog_ip`),
  KEY `iplog_adate` (`iplog_adate`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
INSERT INTO `{dbpre}iplog` VALUES('1','192.168.3.104','','1505794312','2017-09-19');
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}link`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}link` (
  `link_id` int(10) unsigned NOT NULL auto_increment COMMENT '友情链接id',
  `link_name` varchar(50) NOT NULL COMMENT '友情链接名称',
  `link_url` varchar(100) NOT NULL COMMENT '友情链接url',
  `link_order` int(10) unsigned NOT NULL default '0' COMMENT '友情链接排序',
  PRIMARY KEY  (`link_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
INSERT INTO `{dbpre}link` VALUES('1','简好网络官方网站','http://www.phpshe.com','1'),
('2','PHPSHE商城系统','http://www.phpshe.com/phpshe','2');
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}menu`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}menu` (
  `menu_id` smallint(5) unsigned NOT NULL auto_increment COMMENT '导航id',
  `menu_name` varchar(20) NOT NULL COMMENT '导航名称',
  `menu_type` char(3) NOT NULL default 'sys' COMMENT '导航类型',
  `menu_url` varchar(50) NOT NULL COMMENT '导航链接',
  `menu_target` tinyint(1) unsigned NOT NULL default '1' COMMENT '新标签打开',
  `menu_order` smallint(5) unsigned NOT NULL default '0' COMMENT '导航排序',
  PRIMARY KEY  (`menu_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
INSERT INTO `{dbpre}menu` VALUES('1','品牌专区','sys','brand-list','1','0'),
('2','简好网络','diy','http://www.phpshe.com','1','0'),
('3','商业授权','diy','http://www.phpshe.com/phpshe#buy','1','0');
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}moneylog`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}moneylog` (
  `moneylog_id` int(10) unsigned NOT NULL auto_increment,
  `moneylog_type` varchar(10) NOT NULL,
  `moneylog_in` decimal(10,1) unsigned NOT NULL default '0.0' COMMENT '收入',
  `moneylog_out` decimal(10,1) unsigned NOT NULL default '0.0' COMMENT '支出',
  `moneylog_now` decimal(10,1) unsigned NOT NULL default '0.0' COMMENT '当前结余',
  `moneylog_atime` int(10) unsigned NOT NULL default '0' COMMENT '时间',
  `moneylog_text` varchar(255) NOT NULL,
  `user_id` int(10) unsigned NOT NULL default '0' COMMENT '用户id',
  `user_name` varchar(20) NOT NULL COMMENT '用户名',
  PRIMARY KEY  (`moneylog_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}notice`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}notice` (
  `notice_id` int(10) unsigned NOT NULL auto_increment,
  `notice_name` varchar(20) NOT NULL COMMENT '通知名称',
  `notice_mark` varchar(20) NOT NULL COMMENT '通知标识',
  `notice_obj` varchar(5) NOT NULL COMMENT '通知对象',
  `notice_sms_text` varchar(255) NOT NULL,
  `notice_sms_state` tinyint(1) unsigned NOT NULL default '1',
  `notice_email_name` varchar(100) NOT NULL COMMENT '邮件标题',
  `notice_email_text` text NOT NULL COMMENT '邮件内容',
  `notice_email_state` tinyint(1) unsigned NOT NULL default '0' COMMENT '通知状态',
  PRIMARY KEY  (`notice_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
INSERT INTO `{dbpre}notice` VALUES('1','用户下单','order_add','user','下单通知：订单{order_id}提交成功，请及时付款！','1','下单通知：订单{order_id}提交成功，请及时付款！','<p>\r\n	订单金额：{order_money}元\r\n</p>\r\n<p>\r\n	收货姓名：{user_tname}\r\n</p>\r\n<p>\r\n	联系电话：{user_phone}\r\n</p>\r\n<p>\r\n	收货地址：{user_address}\r\n</p>\r\n<p>\r\n	<br />\r\n</p>','0'),
('2','订单付款','order_pay','user','付款通知：订单{order_id}付款成功，祝您生活愉快！','1','付款通知：订单{order_id}付款成功，祝您生活愉快！','<p>\r\n	订单金额：{order_money}元\r\n</p>\r\n<p>\r\n	收货姓名：{user_tname}\r\n</p>\r\n<p>\r\n	联系电话：{user_phone}\r\n</p>\r\n<p>\r\n	收货地址：{user_address}\r\n</p>\r\n<p>\r\n	<br />\r\n</p>','0'),
('3','订单发货','order_send','user','发货通知：订单{order_id}已发货，请注意接收！','1','发货通知：订单{order_id}已发货，请注意接收！','<p>\r\n	快递公司：{order_wl_name}，运单编号：{order_wl_id}<span class=\"tag_gray fl mar5 mab5\" style=\"line-height:20px;\"></span>，如有问题请及时联系！\r\n</p>','0'),
('4','订单关闭','order_close','user','关闭通知：订单{order_id}已关闭，原因：{order_closetext}','1','关闭通知：订单{order_id}已关闭，原因：{order_closetext}','订单金额：{order_money}元\r\n<p>\r\n	收货姓名：{user_tname}\r\n</p>\r\n<p>\r\n	联系电话：{user_phone}\r\n</p>\r\n<p>\r\n	收货地址：{user_address}\r\n</p>\r\n<p>\r\n	<br />\r\n</p>','0'),
('5','用户下单','order_add','admin','新订单通知：{order_id}，金额：{order_money}元，姓名：{user_tname}，电话：{user_phone}，请注意查看！','1','新订单通知：{order_id}，金额：{order_money}元，姓名：{user_tname}，电话：{user_phone}，请注意查看！','<p>\r\n	订单金额：{order_money}元\r\n</p>\r\n<p>\r\n	收货姓名：{user_tname}\r\n</p>\r\n<p>\r\n	联系电话：{user_phone}\r\n</p>\r\n<p>\r\n	收货地址：{user_address}\r\n</p>','0'),
('6','订单付款','order_pay','admin','付款通知：订单{order_id}付款成功，请及时安排发货！','1','付款通知：订单{order_id}付款成功，请及时安排发货！','<p>\r\n	订单金额：{order_money}元\r\n</p>\r\n<p>\r\n	收货姓名：{user_tname}\r\n</p>\r\n<p>\r\n	联系电话：{user_phone}\r\n</p>\r\n<p>\r\n	收货地址：{user_address}\r\n</p>','0');
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}noticelog`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}noticelog` (
  `noticelog_id` int(10) unsigned NOT NULL auto_increment COMMENT '通知记录id',
  `noticelog_type` varchar(5) NOT NULL default 'email',
  `noticelog_user` varchar(30) NOT NULL COMMENT '通知对象',
  `noticelog_name` varchar(100) NOT NULL COMMENT '通知名称',
  `noticelog_text` text NOT NULL COMMENT '通知内容',
  `noticelog_atime` int(10) unsigned NOT NULL default '0' COMMENT '录入时间',
  `noticelog_stime` int(10) unsigned NOT NULL default '0' COMMENT '通知时间',
  `noticelog_state` varchar(10) NOT NULL default 'new' COMMENT '通知状态',
  `noticelog_error` varchar(50) NOT NULL COMMENT '失败提醒',
  PRIMARY KEY  (`noticelog_id`),
  KEY `noticelog_state` (`noticelog_state`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}order`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}order` (
  `order_id` bigint(15) unsigned NOT NULL COMMENT '订单id',
  `order_outid` varchar(50) NOT NULL COMMENT '第三方支付订单号',
  `order_name` varchar(50) NOT NULL,
  `order_money` decimal(10,1) unsigned NOT NULL default '0.0' COMMENT '订单金额',
  `order_product_money` decimal(10,1) unsigned NOT NULL default '0.0',
  `order_quan_id` int(10) unsigned NOT NULL default '0',
  `order_quan_name` varchar(30) NOT NULL,
  `order_quan_money` int(10) unsigned NOT NULL default '0',
  `order_point_get` smallint(5) unsigned NOT NULL default '0',
  `order_point_use` smallint(5) unsigned NOT NULL default '0',
  `order_point_money` decimal(10,1) unsigned NOT NULL default '0.0',
  `order_wl_id` varchar(20) NOT NULL,
  `order_wl_name` varchar(20) NOT NULL,
  `order_wl_money` decimal(5,1) unsigned NOT NULL default '0.0',
  `order_atime` int(10) unsigned NOT NULL default '0' COMMENT '下单时间',
  `order_ptime` int(10) unsigned NOT NULL default '0' COMMENT '付款时间',
  `order_stime` int(10) unsigned NOT NULL default '0' COMMENT '发货时间',
  `order_ftime` int(10) unsigned NOT NULL default '0' COMMENT '完成时间',
  `order_payway` varchar(10) NOT NULL default 'alipay_js',
  `order_comment` tinyint(1) unsigned NOT NULL default '0',
  `order_state` varchar(10) NOT NULL default 'wpay',
  `order_pstate` tinyint(1) unsigned NOT NULL default '0' COMMENT '付款状态',
  `order_sstate` tinyint(1) unsigned NOT NULL default '0' COMMENT '发货状态',
  `order_text` varchar(255) NOT NULL COMMENT '订单留言',
  `order_closetext` varchar(255) NOT NULL COMMENT '订单关闭原因',
  `user_id` int(10) unsigned NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_tname` varchar(10) NOT NULL,
  `user_phone` char(11) NOT NULL COMMENT '用户手机',
  `user_tel` varchar(20) NOT NULL,
  `user_address` varchar(255) NOT NULL COMMENT '用户地址',
  KEY `order_id` (`order_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}order_pay`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}order_pay` (
  `order_id` varchar(25) NOT NULL COMMENT '订单id',
  `order_outid` varchar(50) NOT NULL,
  `order_name` varchar(50) NOT NULL,
  `order_money` decimal(10,1) unsigned NOT NULL default '0.0' COMMENT '订单金额',
  `order_state` varchar(10) NOT NULL default 'wpay',
  `order_payway` varchar(10) NOT NULL default 'alipay',
  `order_atime` int(10) unsigned NOT NULL default '0' COMMENT '下单时间',
  `order_ptime` int(10) unsigned NOT NULL default '0' COMMENT '付款时间',
  `order_pstate` tinyint(1) unsigned NOT NULL default '0' COMMENT '付款状态',
  `user_id` int(10) unsigned NOT NULL,
  `user_name` varchar(20) NOT NULL,
  KEY `order_id` (`order_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}orderdata`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}orderdata` (
  `orderdata_id` int(10) unsigned NOT NULL auto_increment COMMENT '订单数据id',
  `order_id` bigint(15) unsigned NOT NULL default '0' COMMENT '订单id',
  `product_guid` char(32) NOT NULL COMMENT '唯一id',
  `product_id` int(10) unsigned NOT NULL default '0' COMMENT '商品id',
  `product_name` varchar(50) NOT NULL COMMENT '订单名称',
  `product_logo` varchar(200) NOT NULL COMMENT '商品logo',
  `product_money` decimal(10,1) NOT NULL default '0.0',
  `product_money_yh` decimal(10,1) NOT NULL default '0.0',
  `product_num` smallint(5) unsigned NOT NULL,
  `prorule_key` varchar(30) NOT NULL COMMENT '规格id组合',
  `prorule_name` varchar(255) NOT NULL COMMENT '规格名称组合',
  PRIMARY KEY  (`orderdata_id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}payway`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}payway` (
  `payway_id` tinyint(3) unsigned NOT NULL auto_increment,
  `payway_name` varchar(10) NOT NULL,
  `payway_mark` varchar(15) NOT NULL,
  `payway_logo` varchar(100) NOT NULL,
  `payway_model` text NOT NULL,
  `payway_config` text NOT NULL,
  `payway_text` varchar(255) NOT NULL,
  `payway_order` tinyint(3) unsigned NOT NULL default '0',
  `payway_state` tinyint(1) unsigned NOT NULL default '1',
  PRIMARY KEY  (`payway_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
INSERT INTO `{dbpre}payway` VALUES('1','余额支付','balance','include/plugin/payway/balance/logo.gif','','','使用帐户余额支付，只有会员才能使用。','0','1'),
('2','支付宝','alipay','include/plugin/payway/alipay/logo.gif','a:3:{s:11:\"alipay_name\";a:2:{s:4:\"name\";s:15:\"支付宝账户\";s:9:\"form_type\";s:4:\"text\";}s:10:\"alipay_pid\";a:2:{s:4:\"name\";s:18:\"合作者身份Pid\";s:9:\"form_type\";s:4:\"text\";}s:10:\"alipay_key\";a:2:{s:4:\"name\";s:18:\"安全校验码Key\";s:9:\"form_type\";s:4:\"text\";}}','a:3:{s:11:\"alipay_name\";s:0:\"\";s:10:\"alipay_pid\";s:0:\"\";s:10:\"alipay_key\";s:0:\"\";}','即时到帐接口，买家交易金额直接转入卖家支付宝账户。','0','1'),
('3','微信支付','wechat','include/plugin/payway/wechat/logo.gif','a:4:{s:12:\"wechat_appid\";a:2:{s:4:\"name\";s:5:\"AppID\";s:9:\"form_type\";s:4:\"text\";}s:16:\"wechat_appsecret\";a:2:{s:4:\"name\";s:9:\"AppSecret\";s:9:\"form_type\";s:4:\"text\";}s:12:\"wechat_mchid\";a:2:{s:4:\"name\";s:9:\"商户号\";s:9:\"form_type\";s:4:\"text\";}s:10:\"wechat_key\";a:2:{s:4:\"name\";s:9:\"API密钥\";s:9:\"form_type\";s:4:\"text\";}}','a:4:{s:12:\"wechat_appid\";s:0:\"\";s:16:\"wechat_appsecret\";s:0:\"\";s:12:\"wechat_mchid\";s:0:\"\";s:10:\"wechat_key\";s:0:\"\";}','用户使用微信扫码支付','0','1'),
('4','云支付','passpay','include/plugin/payway/passpay/logo.gif','a:3:{s:12:\"passpay_name\";a:2:{s:4:\"name\";s:18:\"云通付商户号\";s:9:\"form_type\";s:4:\"text\";}s:11:\"passpay_pid\";a:2:{s:4:\"name\";s:12:\"云通付Pid\";s:9:\"form_type\";s:4:\"text\";}s:11:\"passpay_key\";a:2:{s:4:\"name\";s:12:\"云通付Key\";s:9:\"form_type\";s:4:\"text\";}}','a:3:{s:12:\"passpay_name\";s:0:\"\";s:11:\"passpay_pid\";s:0:\"\";s:11:\"passpay_key\";s:0:\"\";}','云通付（www.passpay.net）适合个人/团体快速接入支付功能，含支付宝/微信支付/网银等渠道','0','1'),
('5','转账汇款','bank','include/plugin/payway/bank/logo.gif','a:1:{s:9:\"bank_text\";a:2:{s:4:\"name\";s:12:\"收款信息\";s:9:\"form_type\";s:8:\"textarea\";}}','a:1:{s:9:\"bank_text\";s:168:\"请将款项汇款至以下账户：\r\n建设银行 621700254000005xxxx 刘某某\r\n工商银行 621700254000005xxxx 刘某某\r\n农业银行 621700254000005xxxx 刘某某\";}','通过线下汇款方式支付，汇款帐号：建设银行 621700254000005xxxx 刘某某','0','1'),
('6','货到付款','cod','include/plugin/payway/cod/logo.gif','','','送货上门后再收款，支持现金、POS机刷卡、支票支付','0','1');
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}pointlog`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}pointlog` (
  `pointlog_id` int(10) unsigned NOT NULL auto_increment,
  `pointlog_type` varchar(10) NOT NULL COMMENT '积分类型',
  `pointlog_in` smallint(5) unsigned NOT NULL default '0' COMMENT '积分收入',
  `pointlog_out` smallint(5) unsigned NOT NULL default '0' COMMENT '积分支出',
  `pointlog_now` smallint(5) unsigned NOT NULL default '0' COMMENT '当前结余',
  `pointlog_atime` int(10) unsigned NOT NULL default '0' COMMENT '时间',
  `pointlog_text` varchar(255) NOT NULL COMMENT '备注',
  `user_id` int(10) unsigned NOT NULL default '0' COMMENT '用户id',
  `user_name` varchar(20) NOT NULL COMMENT '用户名',
  PRIMARY KEY  (`pointlog_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}product`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}product` (
  `product_id` smallint(5) unsigned NOT NULL auto_increment COMMENT '商品id',
  `product_name` varchar(100) NOT NULL COMMENT '商品名称',
  `product_text` text NOT NULL COMMENT '商品描述',
  `product_keys` varchar(50) NOT NULL COMMENT '页面关键词',
  `product_desc` varchar(255) NOT NULL COMMENT '页面描述',
  `product_logo` varchar(100) NOT NULL COMMENT '商品logo',
  `product_album` text NOT NULL COMMENT '商品相册',
  `product_money` decimal(10,1) unsigned NOT NULL default '0.0' COMMENT '商品商城价（有活动即活动价）',
  `product_smoney` decimal(10,1) unsigned NOT NULL default '0.0' COMMENT '商品商城价',
  `product_mmoney` decimal(10,1) unsigned NOT NULL default '0.0' COMMENT '商品市场价',
  `product_wlmoney` decimal(5,1) unsigned NOT NULL default '0.0' COMMENT '商品物流价',
  `product_point` smallint(5) unsigned NOT NULL default '0' COMMENT '赠送积分',
  `product_mark` varchar(20) NOT NULL COMMENT '商品货号',
  `product_weight` decimal(7,2) NOT NULL COMMENT '商品尺寸',
  `product_state` tinyint(1) unsigned NOT NULL default '1' COMMENT '商品状态',
  `product_atime` int(10) unsigned NOT NULL default '0' COMMENT '商品发布时间',
  `product_order` smallint(5) unsigned NOT NULL default '10000' COMMENT '商品排序',
  `product_num` smallint(5) unsigned NOT NULL COMMENT '商品库存数',
  `product_sellnum` int(10) unsigned NOT NULL default '0' COMMENT '商品销售数',
  `product_clicknum` int(10) unsigned NOT NULL default '0' COMMENT '商品点击数',
  `product_collectnum` int(10) unsigned NOT NULL default '0' COMMENT '商品收藏数',
  `product_asknum` int(10) unsigned NOT NULL default '0' COMMENT '商品咨询数',
  `product_commentnum` int(10) unsigned NOT NULL default '0' COMMENT '商品评价数',
  `product_commentrate` varchar(10) NOT NULL COMMENT '商品评价比例',
  `product_commentstar` int(10) unsigned NOT NULL default '0' COMMENT '商品评价星级',
  `product_hd_tag` varchar(10) NOT NULL COMMENT '活动标签',
  `product_hd_stime` int(10) unsigned NOT NULL default '0' COMMENT '活动开始时间',
  `product_hd_etime` int(10) unsigned NOT NULL default '0' COMMENT '活动结束时间',
  `product_istuijian` tinyint(1) unsigned NOT NULL default '0',
  `product_rule` text NOT NULL COMMENT '规格数据集',
  `category_id` smallint(5) unsigned NOT NULL COMMENT '商品分类id',
  `brand_id` smallint(5) unsigned NOT NULL default '0' COMMENT '品牌id',
  `rule_id` varchar(30) NOT NULL COMMENT '商品规格id',
  PRIMARY KEY  (`product_id`),
  KEY `category_id` (`category_id`),
  KEY `brand_id` (`brand_id`),
  KEY `product_hd_etime` (`product_hd_etime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}prorule`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}prorule` (
  `prorule_id` int(10) unsigned NOT NULL auto_increment COMMENT '商品规格id',
  `prorule_key` varchar(30) NOT NULL COMMENT '规格id组合',
  `prorule_name` varchar(50) NOT NULL COMMENT '规格名组合',
  `product_money` decimal(10,1) unsigned NOT NULL default '0.0' COMMENT '商品商城价（有活动即活动价）',
  `product_smoney` decimal(10,1) unsigned NOT NULL default '0.0' COMMENT '商城价',
  `product_mmoney` decimal(10,1) unsigned NOT NULL default '0.0' COMMENT '规格市场价',
  `product_num` smallint(5) unsigned NOT NULL default '0' COMMENT '规格数量',
  `product_id` int(10) unsigned NOT NULL default '0' COMMENT '商品id',
  PRIMARY KEY  (`prorule_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}quan`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}quan` (
  `quan_id` int(10) unsigned NOT NULL auto_increment COMMENT '优惠券自增id',
  `quan_name` varchar(30) NOT NULL COMMENT '优惠券名称',
  `quan_type` varchar(10) NOT NULL default 'online' COMMENT '发放方式(online线上领取/offline线下发放)',
  `quan_money` int(10) unsigned NOT NULL default '0' COMMENT '优惠券面值',
  `quan_limit` smallint(5) unsigned NOT NULL default '0' COMMENT '优惠券限制条件',
  `quan_num` int(10) unsigned NOT NULL default '0' COMMENT '优惠券发行量',
  `quan_num_get` int(10) unsigned NOT NULL default '0',
  `quan_num_use` int(10) unsigned NOT NULL default '0',
  `quan_atime` int(10) unsigned NOT NULL default '0' COMMENT '优惠券增加日期',
  `quan_sdate` date NOT NULL COMMENT '优惠券开始日期',
  `quan_edate` date NOT NULL COMMENT '优惠券结束日期',
  `product_id` text NOT NULL COMMENT '商品id',
  PRIMARY KEY  (`quan_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}quanlog`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}quanlog` (
  `quanlog_id` int(10) unsigned NOT NULL auto_increment COMMENT '优惠券自增id',
  `quanlog_atime` int(10) unsigned NOT NULL default '0' COMMENT '领取时间',
  `quanlog_utime` int(10) unsigned NOT NULL default '0' COMMENT '使用日期',
  `quanlog_state` tinyint(1) unsigned NOT NULL default '0' COMMENT '0未使用,1已使用,2过期',
  `quan_id` int(10) unsigned NOT NULL default '0',
  `quan_key` char(10) NOT NULL,
  `quan_name` varchar(30) NOT NULL COMMENT '优惠券名称',
  `quan_money` int(10) unsigned NOT NULL default '0' COMMENT '优惠券面值',
  `quan_limit` smallint(5) unsigned NOT NULL default '0' COMMENT '优惠券限制条件',
  `quan_sdate` date NOT NULL COMMENT '优惠券开始日期',
  `quan_edate` date NOT NULL COMMENT '优惠券结束日期',
  `product_id` text NOT NULL COMMENT '商品id',
  `user_id` int(10) unsigned NOT NULL default '0',
  `user_name` varchar(20) NOT NULL,
  PRIMARY KEY  (`quanlog_id`),
  KEY `quanlog_state` (`quanlog_state`),
  KEY `quan_id` (`quan_id`),
  KEY `quan_key` (`quan_key`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}rule`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}rule` (
  `rule_id` smallint(5) unsigned NOT NULL auto_increment COMMENT '规格id',
  `rule_name` varchar(20) NOT NULL COMMENT '规格名称',
  `rule_memo` varchar(20) NOT NULL COMMENT '规格备注',
  PRIMARY KEY  (`rule_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}ruledata`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}ruledata` (
  `ruledata_id` smallint(5) unsigned NOT NULL auto_increment COMMENT '规格值id',
  `ruledata_name` varchar(20) NOT NULL COMMENT '规格值名',
  `ruledata_logo` varchar(100) NOT NULL COMMENT '规格值图',
  `ruledata_order` smallint(5) unsigned NOT NULL default '0' COMMENT '规格值排序',
  `rule_id` smallint(5) unsigned NOT NULL default '0' COMMENT '规格id',
  PRIMARY KEY  (`ruledata_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}setting`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}setting` (
  `setting_key` varchar(50) NOT NULL,
  `setting_value` text NOT NULL,
  KEY `setting_key` (`setting_key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
INSERT INTO `{dbpre}setting` VALUES('web_title','PHPSHE B2C商城系统演示站'),
('web_keywords','phpshe,php,shop,php商城系统,b2c商城系统,php商城源码,b2c商城源码,开源免费网上商城系统'),
('web_description','phpshe,php,shop,php商城系统,b2c商城系统,php商城源码,b2c商城源码,开源免费网上商城系统'),
('web_copyright',''),
('web_tpl','default'),
('web_logo','data/attachment/2017-05/20170215143741r.jpg'),
('web_qrcode','data/attachment/2017-05/20170503193748z.jpg'),
('web_phone',''),
('web_qq',''),
('web_icp',''),
('web_guestbuy','1'),
('web_hotword','PHPSHE,B2C商城系统,简好网络'),
('web_tongji',''),
('web_wlname','a:15:{i:0;s:12:\"顺丰快递\";i:1;s:12:\"申通快递\";i:2;s:12:\"圆通快递\";i:3;s:12:\"韵达快递\";i:4;s:12:\"中通快递\";i:5;s:12:\"天天快递\";i:6;s:9:\"宅急送\";i:7;s:9:\"EMS快递\";i:8;s:12:\"百事汇通\";i:9;s:12:\"全峰快递\";i:10;s:12:\"德邦物流\";i:11;s:0:\"\";i:12;s:0:\"\";i:13;s:0:\"\";i:14;s:0:\"\";}'),
('email_smtp','smtp.qq.com'),
('email_port',''),
('email_ssl','1'),
('email_name',''),
('email_pw',''),
('email_nname',''),
('email_admin',''),
('sms_key',''),
('sms_admin',''),
('sms_sign',''),
('point_state','0'),
('point_reg','10'),
('point_comment','50'),
('point_login','0'),
('point_money','100'),
('cashout_min','100');
/*#####################@ pe_cutsql @#####################*/
INSERT INTO `{dbpre}setting` VALUES('cashout_fee','0.01'),
('wechat_appid',''),
('wechat_appsecret',''),
('wechat_token','phpshe590d6a7331976'),
('wechat_rssadd','hellow'),
('wechat_access_token',''),
('wechat_menu','a:2:{i:1;a:3:{s:4:\"name\";s:12:\"商城系统\";s:3:\"url\";s:21:\"http://www.phpshe.com\";s:4:\"list\";a:2:{i:1;a:2:{s:4:\"name\";s:12:\"系统简介\";s:3:\"url\";s:28:\"http://www.phpshe.com/phpshe\";}i:2;a:2:{s:4:\"name\";s:12:\"系统演示\";s:3:\"url\";s:33:\"http://www.phpshe.com/demo/phpshe\";}}}i:2;a:2:{s:4:\"name\";s:12:\"网站建设\";s:3:\"url\";s:25:\"http://www.phpshe.com/web\";}}'),
('tg_state','0'),
('tg_fc1','0.05'),
('tg_fc2','0.03'),
('tg_fc3','0.02');
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}tguser`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}tguser` (
  `tg_id` int(10) unsigned NOT NULL auto_increment COMMENT '自增id',
  `tguser_id` int(10) unsigned NOT NULL default '0' COMMENT '推广用户id',
  `tguser_name` varchar(20) NOT NULL COMMENT '推广用户名',
  `tguser_level` tinyint(1) unsigned NOT NULL default '0' COMMENT '推广层级关系',
  `user_id` int(10) unsigned NOT NULL default '0' COMMENT '用户id',
  `user_name` varchar(20) NOT NULL COMMENT '用户名',
  `user_atime` int(10) unsigned NOT NULL default '0' COMMENT '注册时间',
  PRIMARY KEY  (`tg_id`),
  KEY `tguser_id` (`tguser_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}user`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}user` (
  `user_id` int(10) unsigned NOT NULL auto_increment COMMENT '用户id',
  `user_name` varchar(20) NOT NULL COMMENT '用户名',
  `user_pw` varchar(32) NOT NULL COMMENT '用户密码',
  `user_logo` varchar(100) NOT NULL,
  `user_money` decimal(10,1) unsigned NOT NULL default '0.0' COMMENT '账户余额',
  `user_money_cost` decimal(10,1) unsigned NOT NULL default '0.0' COMMENT '总消费额',
  `user_money_tg` decimal(10,1) unsigned NOT NULL default '0.0' COMMENT '推广总收益',
  `user_point` int(10) unsigned NOT NULL default '0' COMMENT '账户积分余额',
  `user_point_all` int(10) unsigned NOT NULL default '0' COMMENT '累计获得积分',
  `user_tname` varchar(10) NOT NULL COMMENT '用户姓名',
  `user_phone` char(11) NOT NULL COMMENT '用户手机',
  `user_tel` varchar(20) NOT NULL COMMENT '固定电话',
  `user_qq` varchar(10) NOT NULL COMMENT '用户QQ',
  `user_email` varchar(30) NOT NULL COMMENT '用户email',
  `user_atime` int(10) unsigned NOT NULL default '0' COMMENT '用户注册时间',
  `user_ltime` int(10) unsigned NOT NULL default '0' COMMENT '用户上次登录时间',
  `user_address` varchar(255) NOT NULL COMMENT '用户地址',
  `user_ordernum` int(10) unsigned NOT NULL default '0',
  `user_ip` char(15) NOT NULL COMMENT '用户注册ip',
  `user_wx_openid` varchar(50) NOT NULL,
  `userlevel_id` smallint(5) unsigned NOT NULL default '0' COMMENT '用户等级id',
  `tguser_id` int(10) unsigned NOT NULL default '0' COMMENT '推广用户id',
  `tguser_name` varchar(20) NOT NULL COMMENT '推广用户名',
  PRIMARY KEY  (`user_id`),
  KEY `user_name` (`user_name`),
  KEY `user_wx_openid` (`user_wx_openid`),
  KEY `tguser_id` (`tguser_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}useraddr`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}useraddr` (
  `address_id` int(10) unsigned NOT NULL auto_increment,
  `address_province` varchar(20) NOT NULL,
  `address_city` varchar(20) NOT NULL,
  `address_area` varchar(20) NOT NULL,
  `address_text` varchar(100) NOT NULL,
  `address_atime` int(10) unsigned NOT NULL default '0',
  `address_default` tinyint(1) unsigned NOT NULL default '0',
  `user_id` int(10) unsigned NOT NULL default '0',
  `user_name` varchar(20) NOT NULL,
  `user_tname` varchar(10) NOT NULL,
  `user_phone` char(11) NOT NULL,
  PRIMARY KEY  (`address_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}userbank`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}userbank` (
  `userbank_id` int(10) unsigned NOT NULL auto_increment,
  `userbank_name` varchar(20) NOT NULL,
  `userbank_num` varchar(50) NOT NULL,
  `userbank_type` varchar(10) NOT NULL COMMENT '银行标识',
  `userbank_tname` varchar(10) NOT NULL COMMENT '账户姓名',
  `userbank_address` varchar(50) NOT NULL,
  `userbank_atime` int(10) unsigned NOT NULL default '0' COMMENT '绑定日期',
  `user_id` int(10) unsigned NOT NULL default '0',
  `user_name` varchar(20) NOT NULL,
  PRIMARY KEY  (`userbank_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}userlevel`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}userlevel` (
  `userlevel_id` smallint(5) unsigned NOT NULL auto_increment COMMENT '自增id',
  `userlevel_name` varchar(10) NOT NULL COMMENT '用户组名',
  `userlevel_value` int(10) unsigned NOT NULL default '0' COMMENT '用户组最大值',
  `userlevel_logo` varchar(100) NOT NULL COMMENT '用户组图标',
  `userlevel_zhe` decimal(3,2) unsigned NOT NULL default '0.00' COMMENT '折扣率',
  `userlevel_up` tinyint(1) unsigned NOT NULL default '1' COMMENT '自动升级(0否/1是)',
  PRIMARY KEY  (`userlevel_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
INSERT INTO `{dbpre}userlevel` VALUES('1','注册用户','0','','1.00','1');
