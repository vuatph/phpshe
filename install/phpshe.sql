DROP TABLE IF EXISTS `{dbpre}ad`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}ad` (
  `ad_id` int(10) unsigned NOT NULL auto_increment,
  `ad_logo` varchar(100) NOT NULL,
  `ad_url` varchar(100) NOT NULL,
  `ad_position` varchar(15) NOT NULL,
  `ad_order` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`ad_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
INSERT INTO `{dbpre}ad` VALUES('1','data/attachment/2012-11/jdt1.jpg','','index_jdt','0'),
('2','data/attachment/2012-11/jdt2.jpg','','index_jdt','0'),
('3','data/attachment/2012-11/ad1.jpg','','header','0'),
('4','data/attachment/2012-11/ad2.jpg','','footer','0');
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}admin`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}admin` (
  `admin_id` int(10) unsigned NOT NULL auto_increment COMMENT '管理id',
  `admin_name` varchar(20) NOT NULL COMMENT '管理名',
  `admin_pw` varchar(32) NOT NULL COMMENT '管理密码',
  `admin_atime` int(10) unsigned NOT NULL default '0' COMMENT '管理注册时间',
  `admin_ltime` int(10) unsigned NOT NULL default '0' COMMENT '管理上次登录时间',
  PRIMARY KEY  (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
INSERT INTO `{dbpre}admin` VALUES('1','admin','21232f297a57a5a743894a0e4a801fc3','1269059337','1357002345');
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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
INSERT INTO `{dbpre}article` VALUES('1','关于简好科技','<p>\r\n	灵宝简好网络科技有限公司，优秀的互联网平台与服务提供商，六年网站设计与开发经验，专业从事互联网软件开发等网络技术服务。自公司成立以来，简好科技始终秉承“产品简单好用，用心服务客户”的核心经营理念，在自主研发的创新之路稳健前行。&nbsp;\r\n</p>\r\n<p>\r\n	<br />\r\n严谨的程序开发人员、专业的美工设计、良好的服务让我们在竞争激烈的互联网行业中蓬勃发展。通过我们多年在上百个不同行业领域的项目历练，加之对\r\n各行业、各类型客户需求的理解，抛开炒作与虚夸，以一贯低调、踏实、诚信的风格为企、事业单位提供更好更实用的一站式网站建设服务！\r\n</p>\r\n<p>\r\n	<br />\r\n简好科技坚信质量和信誉是我们存在的基石。我们注重客户提出的每个要求并充分考虑每一个细节，积极做好服务，不断地完善自己，通过不懈的努力，我们把每一\r\n位客户都做成了朋友，感谢你们对简好科技的信任与支持，这种信任与支持激励着我们提供更优质的服务。在所有新老客户面前，我们都很乐意朴实的跟您接触，深\r\n入的了解您的企业，每一次倾心的合作，都是一个全新的体会和挑战，我们随时与您同在。\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	详情请访问：<a href=\"http://www.phpshe.com\" target=\"_blank\"><strong><span style=\"color:#E53333;\">简好科技官方网站</span></strong></a> \r\n</p>','1335834720','916','1'),
('2','PHPSHE B2C商城系统v1.2版发布','【PHPSHE基本资料】:<br />\r\n当前版本：<strong>PHPSHE B2C商城系统v1.2</strong>(build 20140519 UTF8) <br />\r\n官方网站：<a target=\"_blank\" href=\"http://www.phpshe.com/phpshe\">http://www.phpshe.com/phpshe</a><br />\r\n演示网站：<a target=\"_blank\" href=\"http://www.phpshe.com/demo/phpshe\">http://www.phpshe.com/demo/phpshe</a><br />\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	【PHPSHE系统简介】:\r\n</p>\r\n<p>\r\n	<a target=\"_blank\" href=\"http://www.phpshe.com/phpshe\"><span style=\"color:#E53333;\"><strong>PHPSHE商城系统</strong></span></a>是将商品管理、在线购物、订单管理、支付管理、文章管理、会员管理、客户咨询反馈、数据统计等功能相结合，并提供了简易的操作、实用的功能，快速让用户建立独立个性化的网上商店，为用户提供了一个低成本、高效率的网上商城建设方案。操作简单好用，会上网者就可以操作。\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	【PHPSHE功能概述】:\r\n</p>\r\n<p>\r\n	软件适用于于各行业产品销售的商家，主要包括有以下功能：\r\n</p>\r\n<p>\r\n	（1）管理员发布、修改，删除商品信息，商品多级分类检索、关键词模糊搜索等；\r\n</p>\r\n<p>\r\n	（2）管理员可以对商品规格管理，如：尺寸，颜色，套餐等；\r\n</p>\r\n（3）管理员对商品咨询管理，商品评价管理；<br />\r\n（4）订单流程清晰，可及时便捷查询和修改订单信息；<br />\r\n（5）管理员对文章分类管理、文章管理、单页信息管理；<br />\r\n（6）管理员对会员信息管理，管理帐号管理；<br />\r\n（7）管理员对网站整体基本信息的系统设置；<br />\r\n（8）订单支付方式集成支付宝即时到帐，担保交易，双功能收款，银行转帐/汇款，货到付款等接口方便用户支付；<br />\r\n（9）详细的统计功能，管理员可以实时看到每日订单，网站访客流量情况，提高订单转化率；<br />\r\n（10）数据缓存处理，提高系统的运行效率；<br />\r\n（11）一键对网站进行备份恢复，保障数据安全；<br />\r\n（12）支持友情链接、首页广告图管理；<br />\r\n（13）会员注册、登录，查询历史订单，咨询，评价以及商品收藏等。\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	【PHPSHE安装说明】:\r\n</p>\r\n1.用FTP工具（如flashfxp）把程序上传到服务器；<br />\r\n2.给./data 目录及其子目录 777 权限（windows服务器可忽略此步）；<br />\r\n3.访问http://您的网址/install进行安装。<br />\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<fieldset style=\"border:1px solid #ccc;background:#fafafa;padding:5px 10px 20px;\">\r\n	<legend class=\"cgreen\">【PHPSHE1.1 ===升级至===&gt; PHPSHE1.2】教程说明</legend>\r\n	<p>\r\n		1&gt; 请务必先备份整站程序和数据库到本地，防止升级失败造成数据丢失；(数据库备份可参考：<a class=\"cblue\" href=\"http://jingyan.baidu.com/article/27fa7326da2bbc46f9271f6e.html\" target=\"_blank\">如何备份mysql数据库</a>)\r\n	</p>\r\n	<p class=\"mat5\">\r\n		2&gt; 删除FTP中除 <span class=\"cred\">./data目录</span>和 <span class=\"cred\">./config.php文件</span>之外的其他目录和文件；\r\n	</p>\r\n	<p class=\"mat5\">\r\n		3&gt; 上传PHPSHE1.2程序中除 <span class=\"cred\">./data目录</span>和 <span class=\"cred\">./config.php文件</span>之外的其他目录和文件；\r\n	</p>\r\n	<p class=\"mat5\">\r\n		4&gt; 访问http://您的网址/install/update/update1.1_1.2.php，数据库更新完成后删除 ./install目录；\r\n	</p>\r\n</fieldset>\r\n<p>\r\n	<br />\r\n</p>\r\n<p style=\"margin-top:20px;\">\r\n	<strong>详情请访问：</strong><a href=\"http://www.phpshe.com/phpshe\" title=\"PHPSHE商城系统简介\" target=\"_blank\"><strong><span style=\"color:#E53333;\">PHPSHE商城系统简介</span></strong></a> \r\n</p>','1335856260','727','1'),
('3','购买PHPSHE商城系统商业版','<style>\r\n.taocan td,th{padding:7px 5px; border:1px #ddd solid; color:#555; font-size:12px; line-height:18px;}\r\n.taocan th{ background:#2D89AE; color:#fff; font-weight:normal;}\r\n.taocan .tt1{background:#f3f3f3;}\r\n.taocan .money{color:#cb2529;}\r\n</style>\r\n<div class=\"taocan\">\r\n	<table class=\"ke-zeroborder\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n		<tbody>\r\n			<tr>\r\n				<th colspan=\"2\" style=\"text-align:left;\">\r\n					<strong>商业版说明</strong><br />\r\n				</th>\r\n			</tr>\r\n			<tr>\r\n				<td class=\"tt1\" align=\"center\" width=\"200\">\r\n					<strong>系统功能<br />\r\n</strong> \r\n				</td>\r\n				<td align=\"center\">\r\n					无限制\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td class=\"tt1\" align=\"center\" width=\"200\">\r\n					<strong>商业授权<br />\r\n</strong> \r\n				</td>\r\n				<td align=\"center\">\r\n					终身授权\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td class=\"tt1\" align=\"center\" width=\"200\">\r\n					<strong>技术支持<br />\r\n</strong> \r\n				</td>\r\n				<td align=\"center\">\r\n					1年\r\n				</td>\r\n			</tr>\r\n		</tbody>\r\n	</table>\r\n	<table class=\"mat10 ke-zeroborder\" style=\"text-align:center;\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n		<tbody>\r\n			<tr>\r\n				<th colspan=\"2\" style=\"text-align:left;\">\r\n					<strong>技术支持范围</strong> \r\n				</th>\r\n			</tr>\r\n			<tr>\r\n				<td class=\"tt1\" width=\"200\">\r\n					<strong>网站数量</strong> \r\n				</td>\r\n				<td>\r\n					1个\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td class=\"tt1\">\r\n					<strong>电话支持</strong> \r\n				</td>\r\n				<td>\r\n					5X8小时\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td class=\"tt1\">\r\n					<strong>Email/QQ支持</strong> \r\n				</td>\r\n				<td>\r\n					<span style=\"color:#E53333;\">√</span> \r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td class=\"tt1\">\r\n					<strong>在线帮助文档</strong> \r\n				</td>\r\n				<td>\r\n					<span style=\"color:#E53333;\">√</span> \r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td class=\"tt1\">\r\n					<strong>软件安装指导</strong> \r\n				</td>\r\n				<td>\r\n					<span style=\"color:#E53333;\">√</span> \r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td class=\"tt1\">\r\n					<strong>软件使用指导</strong> \r\n				</td>\r\n				<td>\r\n					<span style=\"color:#E53333;\">√</span> \r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td class=\"tt1\">\r\n					<strong>软件升级指导</strong> \r\n				</td>\r\n				<td>\r\n					<span style=\"color:#E53333;\">√</span> \r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td class=\"tt1\">\r\n					<strong>站点迁移指导</strong> \r\n				</td>\r\n				<td>\r\n					<span style=\"color:#E53333;\">√</span> \r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td class=\"tt1\">\r\n					<strong>二次开发咨询</strong> \r\n				</td>\r\n				<td>\r\n					<span style=\"color:#E53333;\">√</span> \r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td class=\"tt1\">\r\n					<strong>版权信息去除</strong> \r\n				</td>\r\n				<td>\r\n					<span style=\"color:#E53333;\">√</span> \r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td class=\"tt1\">\r\n					<strong>其他</strong> \r\n				</td>\r\n				<td style=\"text-align:left;\">\r\n					如网站打不开、出现乱码、页面显示不正确、黑客入侵、程序出错等，都会及时给予维护服务，对于软件操作不明白的，也可负责培训。\r\n				</td>\r\n			</tr>\r\n		</tbody>\r\n	</table>\r\n	<div class=\"mat10 font12\">\r\n		<p>\r\n			<span class=\"cred\">注意：</span>简好科技未授权任何公司或个人代理销售! 请注意鉴别，以免上当。\r\n		</p>\r\n		<p class=\"mat5\">\r\n			<span class=\"cred\">说明：</span> \r\n		</p>\r\n		<p>\r\n			①商业授权\r\n		</p>\r\n1、企业、政府单位、教育机构、协会团体、厂矿、工作室等所有以营利为目的的用户必须购买软件授权后方可使用。\r\n		<p>\r\n			②以下情况不属于服务范围\r\n		</p>\r\n1、自行修改或使用非原始PHPSHE商城系统程序代码产生的问题；<br />\r\n2、自行对PHPSHE商城系统数据库进行直接操作导致数据库出错或者崩溃；<br />\r\n3、非PHPSHE商城系统官方的模块/插件的安装以及由于安装模块/插件造成的故障；<br />\r\n4、服务器、虚拟主机原因造成的系统故障；<br />\r\n5、二次开发或定制及其它可能产生问题的情况。<br />\r\n	</div>\r\n</div>\r\n<p style=\"margin-top:20px;\">\r\n	<strong>详情请访问：</strong><a href=\"http://www.phpshe.com/phpshe\" title=\"PHPSHE商城系统购买\" target=\"_blank\"><strong><span style=\"color:#E53333;\">PHPSHE商城系统购买</span></strong></a> \r\n</p>','1335863100','734','1');
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
  `user_id` int(10) unsigned NOT NULL default '0',
  `user_name` varchar(20) NOT NULL,
  `user_ip` char(15) NOT NULL default '0.0.0.0',
  PRIMARY KEY  (`ask_id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}cart`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}cart` (
  `cart_id` int(10) unsigned NOT NULL auto_increment,
  `cart_atime` int(10) unsigned NOT NULL default '0',
  `product_id` int(10) unsigned NOT NULL default '0',
  `product_num` smallint(5) unsigned NOT NULL default '1',
  `prorule_id` varchar(30) NOT NULL COMMENT '规格id组合',
  `user_id` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`cart_id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}category`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}category` (
  `category_id` smallint(5) unsigned NOT NULL auto_increment,
  `category_pid` smallint(5) unsigned NOT NULL default '0',
  `category_name` varchar(30) NOT NULL,
  `category_order` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}class`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}class` (
  `class_id` smallint(5) unsigned NOT NULL auto_increment,
  `class_name` varchar(30) NOT NULL,
  `class_order` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`class_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
INSERT INTO `{dbpre}class` VALUES('1','网站公告','0');
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
  `comment_text` text NOT NULL COMMENT '留言内容',
  `comment_atime` int(10) NOT NULL default '0' COMMENT '留言时间',
  `product_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL COMMENT '接受方用户id',
  `user_name` varchar(20) NOT NULL,
  `user_ip` char(15) NOT NULL default '0.0.0.0',
  PRIMARY KEY  (`comment_id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
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
  PRIMARY KEY  (`iplog_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
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
INSERT INTO `{dbpre}link` VALUES('1','简好科技官方网站','http://www.phpshe.com','1'),
('2','PHPSHE商城系统','http://www.phpshe.com/phpshe','2');
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}order`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}order` (
  `order_id` int(10) unsigned NOT NULL auto_increment COMMENT '订单id',
  `order_money` decimal(10,1) unsigned NOT NULL default '0.0' COMMENT '订单金额',
  `order_productmoney` decimal(10,1) unsigned NOT NULL default '0.0',
  `order_state` varchar(10) NOT NULL default 'notpay',
  `order_payway` varchar(10) NOT NULL default 'alipay_js',
  `order_text` varchar(255) NOT NULL COMMENT '订单留言',
  `order_atime` int(10) unsigned NOT NULL default '0' COMMENT '下单时间',
  `order_ptime` int(10) unsigned NOT NULL default '0' COMMENT '付款时间',
  `order_stime` int(10) unsigned NOT NULL default '0' COMMENT '发货时间',
  `order_wlname` varchar(20) NOT NULL,
  `order_wlid` varchar(20) NOT NULL,
  `order_wlmoney` decimal(5,1) NOT NULL,
  `order_outid` bigint(15) unsigned NOT NULL default '0',
  `user_id` int(10) unsigned NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_tname` varchar(10) NOT NULL,
  `user_phone` char(11) NOT NULL COMMENT '用户手机',
  `user_tel` varchar(20) NOT NULL,
  `user_address` varchar(255) NOT NULL COMMENT '用户地址',
  PRIMARY KEY  (`order_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}orderdata`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}orderdata` (
  `orderdata_id` int(10) unsigned NOT NULL auto_increment COMMENT '订单数据id',
  `order_id` int(10) unsigned NOT NULL default '0' COMMENT '订单id',
  `product_id` int(10) unsigned NOT NULL default '0' COMMENT '商品id',
  `product_name` varchar(50) NOT NULL COMMENT '订单名称',
  `product_logo` varchar(200) NOT NULL COMMENT '商品logo',
  `product_money` decimal(10,1) NOT NULL default '0.0',
  `product_num` smallint(5) unsigned NOT NULL,
  `prorule_id` varchar(30) NOT NULL COMMENT '规格id组合',
  `prorule_name` varchar(255) NOT NULL COMMENT '规格名称组合',
  PRIMARY KEY  (`orderdata_id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}page`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}page` (
  `page_id` smallint(5) unsigned NOT NULL auto_increment,
  `page_name` varchar(20) NOT NULL,
  `page_text` text NOT NULL,
  PRIMARY KEY  (`page_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
INSERT INTO `{dbpre}page` VALUES('1','购物指南','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>'),
('2','支付方式','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>'),
('3','常见问题','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>'),
('4','配送时间及运费','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>'),
('5','验货与签收','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>'),
('6','订单查询','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>'),
('7','退换货流程','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>'),
('8','退换货条款','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>'),
('9','用户协议','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>'),
('10','公司简介','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>'),
('11','联系我们','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>'),
('12','诚聘英才','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>');
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
INSERT INTO `{dbpre}payway` VALUES('1','支付宝','alipay','include/plugin/payway/alipay/logo.gif','a:4:{s:12:\"alipay_class\";a:3:{s:4:\"name\";s:15:\"支付宝接口\";s:9:\"form_type\";s:6:\"select\";s:10:\"form_value\";a:3:{s:9:\"alipay_js\";s:18:\"即时到账收款\";s:9:\"alipay_db\";s:18:\"担保交易收款\";s:10:\"alipay_sgn\";s:15:\"双功能收款\";}}s:11:\"alipay_name\";a:2:{s:4:\"name\";s:15:\"支付宝账户\";s:9:\"form_type\";s:4:\"text\";}s:10:\"alipay_pid\";a:2:{s:4:\"name\";s:18:\"合作者身份Pid\";s:9:\"form_type\";s:4:\"text\";}s:10:\"alipay_key\";a:2:{s:4:\"name\";s:18:\"安全校验码Key\";s:9:\"form_type\";s:4:\"text\";}}','a:4:{s:12:\"alipay_class\";s:10:\"alipay_sgn\";s:11:\"alipay_name\";s:16:\"koyshe@gmail.com\";s:10:\"alipay_pid\";s:16:\"2088102457797916\";s:10:\"alipay_key\";s:32:\"esfsclzgahxncgzi3bbe7giwa2ywxyv3\";}','国内领先的第三方支付平台，为电子商务提供“简单、安全、快速”的在线支付解决方案。','0','1'),
('2','银行转账/汇款','bank','include/plugin/payway/bank/logo.gif','a:1:{s:9:\"bank_text\";a:2:{s:4:\"name\";s:12:\"收款信息\";s:9:\"form_type\";s:8:\"textarea\";}}','a:1:{s:9:\"bank_text\";s:168:\"请将款项汇款至以下账户：\r\n建设银行 621700254000005xxxx 刘某某\r\n工商银行 621700254000005xxxx 刘某某\r\n农业银行 621700254000005xxxx 刘某某\";}','通过线下汇款方式支付，汇款帐号：建设银行 621700254000005xxxx 刘某某','0','1'),
('3','货到付款','cod','include/plugin/payway/cod/logo.gif','','','送货上门后再收款，支持现金、POS机刷卡、支票支付','0','1');
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}product`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}product` (
  `product_id` smallint(5) unsigned NOT NULL auto_increment COMMENT '商品id',
  `product_name` varchar(50) NOT NULL COMMENT '商品名称',
  `product_text` text NOT NULL COMMENT '商品描述',
  `product_logo` varchar(200) NOT NULL COMMENT '商品logo',
  `product_money` decimal(10,1) unsigned NOT NULL default '0.0' COMMENT '商品商城价',
  `product_smoney` decimal(10,1) unsigned NOT NULL default '0.0' COMMENT '商品市场价',
  `product_wlmoney` decimal(5,1) unsigned NOT NULL default '0.0' COMMENT '商品物流价',
  `product_mark` varchar(20) NOT NULL COMMENT '商品货号',
  `product_weight` decimal(7,2) NOT NULL COMMENT '商品尺寸',
  `product_state` tinyint(1) unsigned NOT NULL default '1' COMMENT '商品状态',
  `product_atime` int(10) unsigned NOT NULL default '0' COMMENT '商品发布时间',
  `product_num` smallint(5) unsigned NOT NULL COMMENT '商品库存数',
  `product_sellnum` int(10) unsigned NOT NULL default '0' COMMENT '商品销售数',
  `product_clicknum` int(10) unsigned NOT NULL default '0' COMMENT '商品点击数',
  `product_collectnum` int(10) unsigned NOT NULL default '0' COMMENT '商品收藏数',
  `product_asknum` int(10) unsigned NOT NULL default '0' COMMENT '商品咨询数',
  `product_commentnum` int(10) unsigned NOT NULL default '0' COMMENT '商品评价数',
  `product_istuijian` tinyint(1) unsigned NOT NULL default '0',
  `category_id` smallint(5) unsigned NOT NULL COMMENT '商品分类id',
  `rule_id` varchar(30) NOT NULL COMMENT '商品规格id',
  PRIMARY KEY  (`product_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}prorule`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}prorule` (
  `prorule_id` varchar(30) NOT NULL COMMENT '规格id组合',
  `product_money` decimal(10,1) unsigned NOT NULL default '0.0' COMMENT '规格价格',
  `product_num` smallint(5) unsigned NOT NULL default '0' COMMENT '规格数量',
  `product_id` int(10) unsigned NOT NULL default '0' COMMENT '商品id',
  KEY `product_id` (`product_id`)
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
INSERT INTO `{dbpre}setting` VALUES('web_title','欢迎使用PHPSHE商城系统'),
('web_keywords','phpshe,php,shop,php商城系统,b2c商城系统,php商城源码,b2c商城源码,开源免费网上商城系统'),
('web_description','phpshe,php,shop,php商城系统,b2c商城系统,php商城源码,b2c商城源码,开源免费网上商城系统'),
('web_copyright','2008-2014 简好科技'),
('web_tpl','default'),
('web_phone','15839823500'),
('web_icp',''),
('web_weibo',''),
('web_tongji',''),
('web_logo','data/attachment/2012-11/20121231231911x.gif'),
('web_qq','1318321,1517735');
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}user`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}user` (
  `user_id` int(10) unsigned NOT NULL auto_increment COMMENT '用户id',
  `user_name` varchar(20) NOT NULL COMMENT '用户名',
  `user_pw` varchar(32) NOT NULL COMMENT '用户密码',
  `user_tname` varchar(10) NOT NULL COMMENT '用户姓名',
  `user_phone` char(11) NOT NULL COMMENT '用户手机',
  `user_tel` varchar(20) NOT NULL COMMENT '固定电话',
  `user_qq` varchar(10) NOT NULL COMMENT '用户QQ',
  `user_email` varchar(30) NOT NULL COMMENT '用户email',
  `user_atime` int(10) unsigned NOT NULL default '0' COMMENT '用户注册时间',
  `user_ltime` int(10) unsigned NOT NULL default '0' COMMENT '用户上次登录时间',
  `user_address` varchar(255) NOT NULL COMMENT '用户地址',
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
