DROP TABLE IF EXISTS `{dbpre}ad`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}ad` (
  `ad_id` int(10) unsigned NOT NULL auto_increment,
  `ad_logo` varchar(100) NOT NULL,
  `ad_url` varchar(100) NOT NULL,
  `ad_position` varchar(15) NOT NULL,
  `ad_state` tinyint(1) unsigned NOT NULL default '1' COMMENT '广告显示状态',
  `ad_order` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`ad_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
INSERT INTO `{dbpre}ad` VALUES('1','data/attachment/2015-03/20150317174225c.jpg','http://www.phpshe.com','index_jdt','1','1'),
('2','data/attachment/2015-03/20150317174252u.jpg','http://www.phpshe.com','index_jdt','1','3'),
('3','data/attachment/2015-03/20150317174237d.jpg','http://www.phpshe.com','index_jdt','1','2'),
('4','data/attachment/2015-04/20150413161316r.gif','http://www.phpshe.com','footer','1','0');
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
INSERT INTO `{dbpre}admin` VALUES('1','admin','21232f297a57a5a743894a0e4a801fc3','1269059337','1431530733','1');
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
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
INSERT INTO `{dbpre}article` VALUES('1','关于简好网络','<p>\r\n	<strong><span style=\"color:#E53333;font-size:16px;\">COMPANY PROFILE　公司简介</span></strong> \r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	灵宝简好网络科技有限公司，优秀的互联网平台与服务提供商，七年网站设计与开发经验，专业从事互联网软件开发等网络技术服务。自公司成立以来，简好网络始终秉承“产品简单好用，用心服务客户”的核心经营理念，在自主研发的创新之路稳健前行。\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	严谨的程序开发人员、专业的美工设计、良好的服务让我们在竞争激烈的互联网行业中蓬勃发展。通过我们多年在上百个不同行业领域的项目历练，加之对\r\n各行业、各类型客户需求的理解，抛开炒作与虚夸，以一贯低调、踏实、诚信的风格为企、事业单位提供更好更实用的一站式网站建设服务！\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	业务范围：网站建设、网页设计、网站制作、软件开发、网站维护、域名注册、虚拟主机、网站推广、网络广告、电子商务、企业管理信息化、行业信息化解决方案、网络技术服务等。\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<strong><span style=\"color:#E53333;font-size:16px;\">OUR ADVANTAGE　我们的优势</span></strong> \r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	灵宝市首家专业的互联网软件开发企业，专业的网站策划设计公司，灵宝市网站建设第一品牌。\r\n</p>\r\n<p>\r\n	7 年时间里服务超过 500 家客户。为客户开发了上百个项目，并建立了长期合作关系。\r\n</p>\r\n<p>\r\n	拥有多项自主研发网站管理系统，为客户提供不同行业的互联网解决方案。\r\n</p>\r\n<p>\r\n	公司专注于网站构架、设计、开发，七年如一日，我们只专注于WEB领域技术研究。\r\n</p>\r\n<p>\r\n	美工设计师/程序员/技术总监/项目协调人员都拥有多年的互联网行业从业经验。\r\n</p>\r\n<p>\r\n	我们同时提供 中文 和 英文 语言服务。\r\n</p>\r\n<p>\r\n	制作符合W3C标准的网站，兼容各个版本的浏览器，IE6,IE7,IE8,IE9,Safari,火狐,遨游,谷歌,360……兼容各个版本浏览器是我们对技术的执着追求虽然有些浏览器并不常用。\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<strong><span style=\"color:#E53333;font-size:16px;\">Enterprise culture　企业文化</span></strong> \r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<h4>\r\n	专业+经验+创意+服务\r\n</h4>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	简好网络坚信质量和信誉是我们存在的基石。我们注重客户提出的每个要求并充分考虑每一个细节，积极做好服务，不断地完善自己，通过不懈的努力，我\r\n们把每一位客户都做成了朋友，感谢你们对简好网络的信任与支持，这种信任与支持激励着我们提供更优质的服务。在所有新老客户面前，我们都很乐意朴实的跟您\r\n接触，深入的了解您的企业，每一次倾心的合作，都是一个全新的体会和挑战，我们随时与您同在。\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<h4>\r\n	我们的愿景：最受客户信任的互联网企业\r\n</h4>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	将以诚实守信的操守、共同发展的理念，长远的眼光建立公司的品牌\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<h4>\r\n	我们的使命：提升企业品牌形象获得最大的价值\r\n</h4>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	以高品质的服务 / 稳健的技术 / 向用户提供丰富 / 可靠的互联网产品\r\n</p>\r\n<p>\r\n	持续关注新的互联网走向 / 积极探索新的用户需求 / 不断为用户提供创新的业务\r\n</p>\r\n<p>\r\n	为企业搭建优秀的网络平台 / 捕捉有效的客户信息 / 促进企业经济的快速发展\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<h4>\r\n	我们的价值观：诚信、专注、尽责、创新\r\n</h4>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<strong>详情请访问：</strong><a href=\"http://www.phpshe.com/about\" target=\"_blank\"><strong><span style=\"color:#E53333;\">灵宝简好网络科技有限公司简介</span></strong></a> \r\n</p>','1335834720','980','1'),
('2','PHPSHE B2C商城系统v1.4版发布','【PHPSHE基本资料】:<br />\r\n当前版本：<strong>PHPSHE B2C商城系统v1.4</strong>(build 20150515 UTF8) <br />\r\n官方网站：<a target=\"_blank\" href=\"http://www.phpshe.com/phpshe\">http://www.phpshe.com/phpshe</a><br />\r\n演示网站：<a target=\"_blank\" href=\"http://www.phpshe.com/demo/phpshe\">http://www.phpshe.com/demo/phpshe</a><br />\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	【PHPSHE系统简介】:\r\n</p>\r\n<p>\r\n	<a target=\"_blank\" href=\"http://www.phpshe.com/phpshe\"><span style=\"color:#E53333;\"><strong>PHPSHE商城系统</strong></span></a>是将商品管理、品牌管理、规格管理、促销管理、优惠券管理、在线购物、订单管理、支付管理、文章管理、会员管理、权限管理、通知管理、咨询评价、数据统计等功能相结合，并提供了简易的操作、实用的功能，快速让用户建立独立个性化的网上商店，为用户提供了一个低成本、高效率的网上商城建设方案。\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	【PHPSHE功能概述】:\r\n</p>\r\n<p>\r\n	软件适用于于各行业产品销售的商家，主要包括有以下功能：\r\n</p>\r\n<p>\r\n	01. 管理员发布、修改，删除商品信息，商品多级分类检索、多属性检索等；<br />\r\n02. 管理员可以对商品品牌名称，图片，描述等管理；<br />\r\n03. 管理员可以对商品规格管理，如：尺寸，颜色，套餐等；<br />\r\n04. 管理员对商品咨询管理，商品评价管理；<br />\r\n05. 管理员对商品活动管理，优惠券管理；<br />\r\n06. 订单流程清晰，可及时便捷查询，修改和处理订单信息；<br />\r\n07. 会员积分体系，有效增加客户回购率及粘性；<br />\r\n08. 详细统计功能，实时显示每日订单情况，访客流量，热销排行，消费排行；<br />\r\n09. 管理员对文章分类管理、文章管理、单页信息管理；<br />\r\n10. 管理员对会员信息管理，管理帐号管理，管理权限管理；<br />\r\n11. 管理员对网站整体基本信息的系统设置；<br />\r\n12. 集成支付宝线、下转帐/汇款、货到付款、网银等接口方便用户支付；<br />\r\n13. 邮件实时提醒，随时随地掌握网站注册，下单，付款，发货等情况；<br />\r\n14. 便捷模板中心，一键轻松更换不同风格的模板；<br />\r\n15. 高效缓存处理，提高系统的运行效率；<br />\r\n16. 一键对网站进行备份恢复，保障数据安全；<br />\r\n17. 支持首页导航、友情链接、首页广告图管理；<br />\r\n18. 会员注册、登录，订单查询，积分明细，优惠券，咨询，评价及商品收藏等。\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	【PHPSHE技术规格】:\r\n</p>\r\n<p>\r\n	PHP + Mysql，前端URL伪静态\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	【PHPSHE安装说明】:\r\n</p>\r\n<p>\r\n	1.用FTP工具（如flashfxp）把程序上传到服务器；<br />\r\n2.给./config.php文件、./install目录、./data目录及其子目录，加 777 权限（windows服务器可忽略此步）；<br />\r\n3.访问http://您的网址/install进行安装。\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	【PHPSHE升级说明】:<br />\r\n老版本升级至1.4版本，请先上传PHPSHE1.4程序中的 ./install目录，然后访问 http://您的网址/install/update 按教程进行升级；\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n【PHPSHE1.4更新详情】\r\n<div style=\"border:1px solid #ccc;background:#fafafa;padding:10px;\">\r\n	<span style=\"color:#009900;\">[新增]</span>分类自定义标题，关键词及描述<br />\r\n<span style=\"color:#009900;\">[新增]</span>产品自定义关键词和描述<br />\r\n<span style=\"color:#009900;\">[新增]</span>订单按帐号，时间段筛选<br />\r\n<span style=\"color:#009900;\">[新增]</span>开启和关闭游客购买设置<br />\r\n<span style=\"color:#009900;\">[新增]</span>广告位显示隐藏<br />\r\n<span style=\"color:#009900;\">[新增]</span>订单邮件通知,邮件队列记录<br />\r\n<span style=\"color:#009900;\">[新增]</span>群发邮件通知<br />\r\n<span style=\"color:#009900;\">[新增]</span>积分功能，积分明细<br />\r\n<span style=\"color:#009900;\">[新增]</span>用户注册归属地<br />\r\n<span style=\"color:#009900;\">[新增]</span>特价活动，优惠券<br />\r\n<span style=\"color:#009900;\">[新增]</span>订单统计，销量排行，消费排行<br />\r\n<span style=\"color:#009900;\">[新增]</span>管理员权限<br />\r\n<span style=\"color:#009900;\">[新增]</span>热门搜索<br />\r\n<span style=\"color:#FF9900;\">[修正]</span>支付宝及网银支付sql注入<br />\r\n<span style=\"color:#FF9900;\">[修正]</span>后台及会员中心csrf漏洞<br />\r\n<span style=\"color:#FF9900;\">[修正]</span>用户名，邮箱服务器端检测<br />\r\n<span style=\"color:#FF9900;\">[修正]</span>缓存反斜杠出错<br />\r\n<span style=\"color:#FF9900;\">[修正]</span>后台登录权限bug<br />\r\n<span style=\"color:#FF9900;\">[修正]</span>广告修改位置bug<br />\r\n<span style=\"color:#FF9900;\">[修正]</span>个别PHP环境验证码不显示<br />\r\n<span style=\"color:#337FE5;\">[优化]</span>资讯中心和帮助中心<br />\r\n<span style=\"color:#337FE5;\">[优化]</span>订单流程及用户体验<br />\r\n<span style=\"color:#337FE5;\">[优化]</span>订单号升级到15位<br />\r\n<span style=\"color:#337FE5;\">[优化]</span>品牌相关功能<br />\r\n<span style=\"color:#337FE5;\">[优化]</span>商品添加规格流程<br />\r\n<span style=\"color:#337FE5;\">[优化]</span>管理后台操作界面及用户体验<br />\r\n<span style=\"color:#337FE5;\">[优化]</span>提升前台图片加载速度<br />\r\n<span style=\"color:#337FE5;\">[优化]</span>重写产品缩略图原理，高清不变形<br />\r\n<span style=\"color:#337FE5;\">[优化]</span>重新设计会员中心界面<br />\r\n<span style=\"color:#337FE5;\">[优化]</span>重新设计登录注册页面<br />\r\n<span style=\"color:#337FE5;\">[优化]</span>更新dialog版本<br />\r\n<span style=\"color:#337FE5;\">[优化]</span>更新编辑器版本<br />\r\n<span style=\"color:#337FE5;\">[优化]</span>评价2星变更为差评<br />\r\n<span style=\"color:#337FE5;\">[优化]</span>在线客服样式<br />\r\n<span style=\"color:#337FE5;\">[优化]</span>验证码类<br />\r\n<span style=\"color:#337FE5;\">[优化]</span>缓存模块<br />\r\n<span style=\"color:#337FE5;\">[优化]</span>数据备份<br />\r\n<span style=\"color:#888888;\">[移除]</span>微博设置\r\n</div>\r\n<p>\r\n	<strong><br />\r\n</strong> \r\n</p>\r\n<p>\r\n	<strong>详情请访问：</strong><a href=\"http://www.phpshe.com/phpshe\" target=\"_blank\"><strong><span style=\"color:#E53333;\">PHPSHE商城系统简介</span></strong></a> \r\n</p>','1335856260','928','1'),
('3','购买PHPSHE商城系统商业版','<div class=\"taocan\">\r\n\r\n	<table class=\"ke-zeroborder\" style=\"font-size:15px;\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n		<tbody>\r\n			<tr>\r\n				<td style=\"background:#C4D9EC;font-size:14px;\" align=\"center\" width=\"170\">\r\n					<strong>服务项目\\类型</strong> \r\n				</td>\r\n				<td style=\"background:#C4D9EC;font-size:14px;\" align=\"center\" width=\"170\">\r\n					<strong>免费版</strong> \r\n				</td>\r\n				<td style=\"background:#C4D9EC;font-size:14px;\" align=\"center\" width=\"170\">\r\n					<strong>基础版</strong> \r\n				</td>\r\n				<td style=\"background:#C4D9EC;font-size:14px;\" align=\"center\" width=\"170\">\r\n					<strong>标准版</strong> \r\n				</td>\r\n				<td style=\"background:#C4D9EC;font-size:14px;\" align=\"center\">\r\n					<strong>高级定制版</strong> \r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td class=\"tt1\" align=\"center\">\r\n					系统功能\r\n				</td>\r\n				<td align=\"center\">\r\n					有限制\r\n				</td>\r\n				<td align=\"center\">\r\n					无限制\r\n				</td>\r\n				<td align=\"center\">\r\n					无限制\r\n				</td>\r\n				<td align=\"center\">\r\n					无限制\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td class=\"tt1\" align=\"center\">\r\n					商业授权\r\n				</td>\r\n				<td align=\"center\">\r\n					×\r\n				</td>\r\n				<td align=\"center\">\r\n					终身\r\n				</td>\r\n				<td align=\"center\">\r\n					终身\r\n				</td>\r\n				<td align=\"center\">\r\n					终身\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td class=\"tt1\">\r\n					前台版权\r\n				</td>\r\n				<td align=\"center\">\r\n					必须保留\r\n				</td>\r\n				<td align=\"center\">\r\n					允许去除\r\n				</td>\r\n				<td align=\"center\">\r\n					允许去除\r\n				</td>\r\n				<td align=\"center\">\r\n					允许去除\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td class=\"tt1\" align=\"center\">\r\n					授权域名\r\n				</td>\r\n				<td align=\"center\">\r\n					×\r\n				</td>\r\n				<td align=\"center\">\r\n					1个\r\n				</td>\r\n				<td align=\"center\">\r\n					1个\r\n				</td>\r\n				<td align=\"center\">\r\n					1个\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td class=\"tt1\" align=\"center\">\r\n					购买咨询\r\n				</td>\r\n				<td align=\"center\">\r\n					×\r\n				</td>\r\n				<td align=\"center\">\r\n					<a target=\"_blank\" href=\"http://wpa.qq.com/msgrd?v=3&uin=76265959&site=qq&menu=yes\"><img src=\"http://www.phpshe.com/template/default/index/images/qq.png\" alt=\"咨询客服\" title=\"咨询客服\" border=\"0\" /></a> \r\n				</td>\r\n				<td align=\"center\">\r\n					<a target=\"_blank\" href=\"http://wpa.qq.com/msgrd?v=3&uin=76265959&site=qq&menu=yes\"><img src=\"http://www.phpshe.com/template/default/index/images/qq.png\" alt=\"咨询客服\" title=\"咨询客服\" border=\"0\" /></a> \r\n				</td>\r\n				<td align=\"center\">\r\n					<a target=\"_blank\" href=\"http://wpa.qq.com/msgrd?v=3&uin=76265959&site=qq&menu=yes\"><img src=\"http://www.phpshe.com/template/default/index/images/qq.png\" alt=\"咨询客服\" title=\"咨询客服\" border=\"0\" /></a> \r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<th colspan=\"5\" style=\"text-align:center;background:#eaeaea;color:#333;\">\r\n					服务方式\r\n				</th>\r\n			</tr>\r\n			<tr>\r\n				<td class=\"tt1\" align=\"center\">\r\n					服务期限\r\n				</td>\r\n				<td align=\"center\">\r\n					<br />\r\n				</td>\r\n				<td align=\"center\">\r\n					<br />\r\n				</td>\r\n				<td align=\"center\">\r\n					1年\r\n				</td>\r\n				<td align=\"center\">\r\n					1年\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td class=\"tt1\" width=\"170\">\r\n					电话技术支持\r\n				</td>\r\n				<td width=\"170\">\r\n					<br />\r\n				</td>\r\n				<td width=\"170\">\r\n					<br />\r\n				</td>\r\n				<td align=\"center\" width=\"170\">\r\n					<img src=\"http://www.phpshe.com/template/default/index/images/dui.png\" /> \r\n				</td>\r\n				<td align=\"center\">\r\n					<img src=\"http://www.phpshe.com/template/default/index/images/dui.png\" /> \r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td class=\"tt1\">\r\n					Email/QQ支持\r\n				</td>\r\n				<td align=\"center\">\r\n					<br />\r\n				</td>\r\n				<td align=\"center\">\r\n					<br />\r\n				</td>\r\n				<td align=\"center\">\r\n					<img src=\"http://www.phpshe.com/template/default/index/images/dui.png\" /> \r\n				</td>\r\n				<td align=\"center\">\r\n					<img src=\"http://www.phpshe.com/template/default/index/images/dui.png\" /> \r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<th colspan=\"5\" style=\"text-align:center;background:#eaeaea;color:#333;\">\r\n					服务项目\r\n				</th>\r\n			</tr>\r\n			<tr>\r\n				<td class=\"tt1\">\r\n					产品BUG反馈\r\n				</td>\r\n				<td align=\"center\">\r\n					<br />\r\n				</td>\r\n				<td align=\"center\">\r\n					<img src=\"http://www.phpshe.com/template/default/index/images/dui.png\" /> \r\n				</td>\r\n				<td align=\"center\">\r\n					<img src=\"http://www.phpshe.com/template/default/index/images/dui.png\" /> \r\n				</td>\r\n				<td align=\"center\">\r\n					<img src=\"http://www.phpshe.com/template/default/index/images/dui.png\" /> \r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td class=\"tt1\">\r\n					程序安装指导\r\n				</td>\r\n				<td align=\"center\">\r\n					<br />\r\n				</td>\r\n				<td align=\"center\">\r\n					首次安装\r\n				</td>\r\n				<td align=\"center\">\r\n					<img src=\"http://www.phpshe.com/template/default/index/images/dui.png\" /> \r\n				</td>\r\n				<td align=\"center\">\r\n					<img src=\"http://www.phpshe.com/template/default/index/images/dui.png\" /> \r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td class=\"tt1\">\r\n					程序使用指导\r\n				</td>\r\n				<td align=\"center\">\r\n					<br />\r\n				</td>\r\n				<td align=\"center\">\r\n					<br />\r\n				</td>\r\n				<td align=\"center\">\r\n					<img src=\"http://www.phpshe.com/template/default/index/images/dui.png\" /> \r\n				</td>\r\n				<td align=\"center\">\r\n					<img src=\"http://www.phpshe.com/template/default/index/images/dui.png\" /> \r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td class=\"tt1\">\r\n					程序升级指导\r\n				</td>\r\n				<td align=\"center\">\r\n					<br />\r\n				</td>\r\n				<td align=\"center\">\r\n					<br />\r\n				</td>\r\n				<td align=\"center\">\r\n					<img src=\"http://www.phpshe.com/template/default/index/images/dui.png\" /> \r\n				</td>\r\n				<td align=\"center\">\r\n					<img src=\"http://www.phpshe.com/template/default/index/images/dui.png\" /> \r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td class=\"tt1\">\r\n					站点迁移指导\r\n				</td>\r\n				<td align=\"center\">\r\n					<br />\r\n				</td>\r\n				<td align=\"center\">\r\n					<br />\r\n				</td>\r\n				<td align=\"center\">\r\n					<img src=\"http://www.phpshe.com/template/default/index/images/dui.png\" /> \r\n				</td>\r\n				<td align=\"center\">\r\n					<img src=\"http://www.phpshe.com/template/default/index/images/dui.png\" /> \r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td class=\"tt1\">\r\n					模板制作技术咨询\r\n				</td>\r\n				<td align=\"center\">\r\n					<br />\r\n				</td>\r\n				<td align=\"center\">\r\n					<br />\r\n				</td>\r\n				<td align=\"center\">\r\n					<img src=\"http://www.phpshe.com/template/default/index/images/dui.png\" /> \r\n				</td>\r\n				<td align=\"center\">\r\n					<img src=\"http://www.phpshe.com/template/default/index/images/dui.png\" /> \r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td class=\"tt1\">\r\n					二次开发咨询\r\n				</td>\r\n				<td align=\"center\">\r\n					<br />\r\n				</td>\r\n				<td align=\"center\">\r\n					<br />\r\n				</td>\r\n				<td align=\"center\">\r\n					<img src=\"http://www.phpshe.com/template/default/index/images/dui.png\" /> \r\n				</td>\r\n				<td align=\"center\">\r\n					<img src=\"http://www.phpshe.com/template/default/index/images/dui.png\" /> \r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td class=\"tt1\">\r\n					二次开发文档\r\n				</td>\r\n				<td align=\"center\">\r\n					<br />\r\n				</td>\r\n				<td align=\"center\">\r\n					<br />\r\n				</td>\r\n				<td align=\"center\">\r\n					<img src=\"http://www.phpshe.com/template/default/index/images/dui.png\" /> \r\n				</td>\r\n				<td align=\"center\">\r\n					<img src=\"http://www.phpshe.com/template/default/index/images/dui.png\" /> \r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<th colspan=\"5\" style=\"text-align:center;background:#eaeaea;color:#333;\">\r\n					<span class=\"cred\">注意：</span>简好网络未授权任何公司或个人代理销售! 请注意鉴别，以免上当。\r\n				</th>\r\n			</tr>\r\n<!--\r\n			<tr>\r\n				<td class=\"tt1\" align=\"center\">\r\n					<strong>价格</strong> \r\n				</td>\r\n				<td align=\"center\">\r\n				</td>\r\n				<td align=\"center\">\r\n					<a target=\"_blank\" href=\"http://wpa.qq.com/msgrd?v=3&uin=76265959&site=qq&menu=yes\"><img border=\"0\" src=\"http://www.phpshe.com/template/default/index/images/qq.png\" alt=\"咨询客服\" title=\"咨询客服\" /></a> \r\n				</td>\r\n				<td align=\"center\">\r\n					<a target=\"_blank\" href=\"http://wpa.qq.com/msgrd?v=3&uin=76265959&site=qq&menu=yes\"><img border=\"0\" src=\"http://www.phpshe.com/template/default/index/images/qq.png\" alt=\"咨询客服\" title=\"咨询客服\" /></a> \r\n				</td>\r\n				<td align=\"center\">\r\n					<a target=\"_blank\" href=\"http://wpa.qq.com/msgrd?v=3&uin=76265959&site=qq&menu=yes\"><img border=\"0\" src=\"http://www.phpshe.com/template/default/index/images/qq.png\" alt=\"咨询客服\" title=\"咨询客服\" /></a> \r\n				</td>\r\n			</tr>\r\n-->\r\n		</tbody>\r\n	</table>\r\n	<div class=\"mat10 font12\" style=\"font-family:宋体;\">\r\n		<p class=\"strong mat8\">\r\n			免费版说明：\r\n		</p>\r\n		<div style=\"background:#fff;border:1px #ddd solid;padding:10px;\">\r\n			1、phpshe免费使用用户，仅供从事学习研究之用，不具备商业运作的合法性；如果未获取phpshe官方授权而从事商业行为，phpshe保留对其使用系统停止升级、关闭、甚至对其商业运作行为起诉的权利；<br />\r\n2、免费版不可删除前台和后台phpshe版权信息，无论您对phpshe程序代码如何修改，都必须在明显和恰当的位置宣告版权声明(网站页面页脚处的 Powered by phpshe 名称的链接必须保留，而不能清除或修改)；<br />\r\n3、免费版不提供程序使用协助、技术咨询；<br />\r\n4、免费版无品牌、规格、促销、优惠券、数据统计等功能；\r\n		</div>\r\n		<p class=\"strong mat8\">\r\n			购买说明：\r\n		</p>\r\n		<div style=\"background:#fff;border:1px #ddd solid;padding:10px;\">\r\n			1、联系客服人员确认购买的版本类型或服务；<br />\r\n2、<a href=\"http://www.phpshe.com/phpshe/pay\" target=\"_blank\" class=\"cblue\">点击查看支付方式；</a><br />\r\n3、联系客服确认到账，并发放产品授权许可；<br />\r\n4、不接受议价，及预付方式，所有费用需一次性全额付款；\r\n		</div>\r\n		<p class=\"strong mat8\">\r\n			技术服务说明：以下情况不属于服务范围\r\n		</p>\r\n		<div style=\"background:#fff;border:1px #ddd solid;padding:10px;\">\r\n			1、自行修改或使用非原始PHPSHE商城系统程序代码产生的问题；<br />\r\n2、自行对PHPSHE商城系统数据库进行直接操作导致数据库出错或者崩溃；<br />\r\n3、非PHPSHE商城系统官方的模块/插件的安装以及由于安装模块/插件造成的故障；<br />\r\n4、服务器、虚拟主机原因造成的系统故障；<br />\r\n5、二次开发或定制及其它可能产生问题的情况。<br />\r\n		</div>\r\n	</div>\r\n</div>\r\n<p><br /></p>\r\n<p>\r\n	<strong>详情请访问：</strong><a href=\"http://www.phpshe.com/phpshe/buy\" target=\"_blank\"><strong><span style=\"color:#E53333;\">PHPSHE商城系统购买</span></strong></a> \r\n</p>\r\n<style>\r\n.taocan td,th{padding:7px 5px; border:1px #ddd solid; color:#555; font-size:12px; line-height:20px;}\r\n.taocan th{ background:#2D89AE; color:#fff;}\r\n.taocan td{color:#666; background:#fff;}\r\n.taocan .tt1{background:#f3f3f3; text-align:center;}\r\n.taocan .money{color:#FF0000; font-size:16px; font-weight:bold; font-family:Arial, Helvetica, sans-serif;}\r\n</style>','1335863100','1070','1'),
('5','用户注册','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>','1406563800','52','4'),
('6','购物流程','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>','1406564160','38','4'),
('7','常见问题','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>','1406564160','28','4'),
('8','配送时间及运费','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>','1406564220','180','5'),
('9','验货与签收','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>','1406564220','175','5'),
('10','订单查询','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>','1406564280','12','5'),
('11','售后政策','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>','1406564280','49','6'),
('12','退货说明','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>','1406564400','4','6'),
('13','取消订单','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>','1406564460','11','6'),
('14','公司简介','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>','1406564520','59','7'),
('15','联系我们','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>','1406564520','8','7'),
('16','诚聘英才','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>','1406564580','41','7'),
('17','在线支付','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>','1431398100','2','8'),
('18','货到付款','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>','1431398160','0','8'),
('19','转账汇款','<a target=\"_blank\" href=\"http://www.phpshe.com\">请在此填写相关内容</a>','1431398160','0','8');
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
  `cart_atime` int(10) unsigned NOT NULL default '0',
  `product_id` int(10) unsigned NOT NULL default '0',
  `product_num` smallint(5) unsigned NOT NULL default '1',
  `prorule_key` varchar(30) NOT NULL COMMENT '规格id组合',
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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
INSERT INTO `{dbpre}class` VALUES('1','网站公告','news','1'),
('2','公司动态','news','2'),
('4','购物指南','help','1'),
('5','配送方式','help','2'),
('6','售后服务','help','4'),
('7','关于我们','help','5'),
('8','支付方式','help','3');
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
  `comment_atime` int(10) NOT NULL default '0' COMMENT '留言时间',
  `product_id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned NOT NULL default '0',
  `user_id` int(10) unsigned NOT NULL COMMENT '接受方用户id',
  `user_name` varchar(20) NOT NULL,
  `user_ip` char(15) NOT NULL default '0.0.0.0',
  PRIMARY KEY  (`comment_id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
INSERT INTO `{dbpre}iplog` VALUES('1','127.0.0.1','','1431532115','2015-05-13'),
('2','127.0.0.1','','1431532868','2015-05-14');
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
  `menu_order` smallint(5) unsigned NOT NULL default '0' COMMENT '导航排序',
  PRIMARY KEY  (`menu_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
INSERT INTO `{dbpre}menu` VALUES('1','简好网络','diy','http://www.phpshe.com','0'),
('2','网站公告','sys','article-list-1','0'),
('3','品牌街','sys','brand-list','0');
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}notice`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}notice` (
  `notice_id` int(10) unsigned NOT NULL auto_increment,
  `notice_name` varchar(20) NOT NULL COMMENT '通知名称',
  `notice_mark` varchar(20) NOT NULL COMMENT '通知标识',
  `notice_obj` varchar(5) NOT NULL COMMENT '通知对象',
  `notice_emailname` varchar(100) NOT NULL COMMENT '邮件标题',
  `notice_emailtext` text NOT NULL COMMENT '邮件内容',
  `notice_state` tinyint(1) unsigned NOT NULL default '0' COMMENT '通知状态',
  PRIMARY KEY  (`notice_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
INSERT INTO `{dbpre}notice` VALUES('1','用户注册','reg','user','【注册通知】恭喜您成功注册PHPSHE商城','<p>\r\n	尊敬的用户：\r\n</p>\r\n<p>\r\n	您好！欢迎您使用PHPSHE商城系统，您的用户名是：{user_name}。\r\n</p>','1'),
('2','用户下单','order_add','user','【下单通知】您的订单：{order_id}提交成功，请及时付款！','订单金额：{order_money}\r\n<p>\r\n	收货姓名：{user_tname}\r\n</p>\r\n<p>\r\n	联系电话：{user_phone}\r\n</p>\r\n<p>\r\n	收货地址：{user_address}\r\n</p>\r\n<p>\r\n	<br />\r\n</p>','1'),
('3','订单付款','order_pay','user','【付款通知】您的订单：{order_id}已付款，感谢您的购买！','<p>\r\n	付款金额：{order_money}\r\n</p>\r\n<p>\r\n	收货姓名：{user_tname}\r\n</p>\r\n<p>\r\n	联系电话：{user_phone}\r\n</p>\r\n<p>\r\n	收货地址：{user_address}\r\n</p>\r\n<p>\r\n	<br />\r\n</p>','1'),
('4','订单发货','order_send','user','【发货通知】您的订单：{order_id}已发货','您的订单：{order_id}已发货，快递公司：{order_wl_name}，运单编号：{order_wl_id}<span class=\"tag_gray fl mar5 mab5\" style=\"line-height:20px;\"></span>，如有问题请及时联系！','1'),
('5','订单关闭','order_close','user','【订单关闭】您的订单：{order_id}已关闭','订单金额：{order_money}\r\n<p>\r\n	收货姓名：{user_tname}\r\n</p>\r\n<p>\r\n	联系电话：{user_phone}\r\n</p>\r\n<p>\r\n	收货地址：{user_address}\r\n</p>\r\n<p>\r\n	<br />\r\n</p>','1'),
('6','用户下单','order_add','admin','【下单通知】网店有新订单：{order_id}','订单金额：{order_money}\r\n<p>\r\n	收货姓名：{user_tname}\r\n</p>\r\n<p>\r\n	联系电话：{user_phone}\r\n</p>\r\n<p>\r\n	收货地址：{user_address}\r\n</p>\r\n<p>\r\n	<br />\r\n</p>','1'),
('7','订单付款','order_pay','admin','【付款通知】网店订单：{order_id}已付款','<p>\r\n	付款金额：{order_money}\r\n</p>\r\n<p>\r\n	收货姓名：{user_tname}\r\n</p>\r\n<p>\r\n	联系电话：{user_phone}\r\n</p>\r\n<p>\r\n	收货地址：{user_address}\r\n</p>\r\n<p>\r\n	请及时安排发货！\r\n</p>','1'),
('8','订单关闭','order_close','admin','【订单关闭】网店订单：{order_id}已关闭','订单金额：{order_money}\r\n<p>\r\n	收货姓名：{user_tname}\r\n</p>\r\n<p>\r\n	联系电话：{user_phone}\r\n</p>\r\n<p>\r\n	收货地址：{user_address}\r\n</p>\r\n<p>\r\n	<br />\r\n</p>','1');
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}noticelog`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}noticelog` (
  `noticelog_id` int(10) unsigned NOT NULL auto_increment COMMENT '通知记录id',
  `noticelog_user` varchar(30) NOT NULL COMMENT '通知对象',
  `noticelog_name` varchar(100) NOT NULL COMMENT '通知名称',
  `noticelog_text` text NOT NULL COMMENT '通知内容',
  `noticelog_atime` int(10) unsigned NOT NULL default '0' COMMENT '加入时间',
  `noticelog_stime` int(10) unsigned NOT NULL default '0' COMMENT '通知时间',
  `noticelog_state` tinyint(1) unsigned NOT NULL default '0' COMMENT '通知状态',
  PRIMARY KEY  (`noticelog_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}order`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}order` (
  `order_id` bigint(15) unsigned NOT NULL COMMENT '订单id',
  `order_outid` bigint(15) unsigned NOT NULL default '0',
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
  `order_state` varchar(10) NOT NULL default 'notpay',
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
DROP TABLE IF EXISTS `{dbpre}orderdata`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}orderdata` (
  `orderdata_id` int(10) unsigned NOT NULL auto_increment COMMENT '订单数据id',
  `order_id` bigint(15) unsigned NOT NULL default '0' COMMENT '订单id',
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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*#####################@ pe_cutsql @#####################*/
INSERT INTO `{dbpre}payway` VALUES('1','支付宝','alipay','include/plugin/payway/alipay/logo.gif','a:4:{s:12:\"alipay_class\";a:3:{s:4:\"name\";s:15:\"支付宝接口\";s:9:\"form_type\";s:6:\"select\";s:10:\"form_value\";a:3:{s:9:\"alipay_js\";s:18:\"即时到账收款\";s:9:\"alipay_db\";s:18:\"担保交易收款\";s:10:\"alipay_sgn\";s:15:\"双功能收款\";}}s:11:\"alipay_name\";a:2:{s:4:\"name\";s:15:\"支付宝账户\";s:9:\"form_type\";s:4:\"text\";}s:10:\"alipay_pid\";a:2:{s:4:\"name\";s:18:\"合作者身份Pid\";s:9:\"form_type\";s:4:\"text\";}s:10:\"alipay_key\";a:2:{s:4:\"name\";s:18:\"安全校验码Key\";s:9:\"form_type\";s:4:\"text\";}}','a:4:{s:12:\"alipay_class\";s:9:\"alipay_js\";s:11:\"alipay_name\";s:0:\"\";s:10:\"alipay_pid\";s:0:\"\";s:10:\"alipay_key\";s:0:\"\";}','国内领先的第三方支付平台，为电子商务提供“简单、安全、快速”的在线支付解决方案。','0','1'),
('2','线下转账/汇款','bank','include/plugin/payway/bank/logo.gif','a:1:{s:9:\"bank_text\";a:2:{s:4:\"name\";s:12:\"收款信息\";s:9:\"form_type\";s:8:\"textarea\";}}','a:1:{s:9:\"bank_text\";s:177:\"请将款项汇款至以下账户：\r\n建设银行 621700254000005xxxx 简好网络\r\n工商银行 621700254000005xxxx 简好网络\r\n农业银行 621700254000005xxxx 简好网络\";}','通过线下汇款方式支付，汇款帐号：建设银行 621700254000005xxxx 简好网络','0','1'),
('3','货到付款','cod','include/plugin/payway/cod/logo.gif','','','送货上门后再收款，支持现金、POS机刷卡、支票支付','0','1'),
('4','网银在线','ebank','','a:2:{s:8:\"ebank_id\";a:2:{s:4:\"name\";s:9:\"商户号\";s:9:\"form_type\";s:4:\"text\";}s:9:\"ebank_md5\";a:2:{s:4:\"name\";s:9:\"MD5私钥\";s:9:\"form_type\";s:4:\"text\";}}','a:2:{s:8:\"ebank_id\";s:0:\"\";s:9:\"ebank_md5\";s:0:\"\";}','网银在线（www.chinabank.com.cn）全面支持全国19家银行的信用卡及借记卡实现网上支付。','0','1');
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
  `product_name` varchar(50) NOT NULL COMMENT '商品名称',
  `product_text` text NOT NULL COMMENT '商品描述',
  `product_keys` varchar(50) NOT NULL COMMENT '页面关键词',
  `product_desc` varchar(255) NOT NULL COMMENT '页面描述',
  `product_logo` varchar(100) NOT NULL COMMENT '商品logo',
  `product_money` decimal(10,1) unsigned NOT NULL default '0.0' COMMENT '商品商城价（有活动即活动价）',
  `product_smoney` decimal(10,1) unsigned NOT NULL default '0.0' COMMENT '商品商城价',
  `product_mmoney` decimal(10,1) unsigned NOT NULL default '0.0' COMMENT '商品市场价',
  `product_wlmoney` decimal(5,1) unsigned NOT NULL default '0.0' COMMENT '商品物流价',
  `product_point` smallint(5) unsigned NOT NULL default '0' COMMENT '赠送积分',
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
  `product_commentrate` varchar(10) NOT NULL COMMENT '商品评价比例',
  `product_commentstar` int(10) unsigned NOT NULL default '0' COMMENT '商品评价星级',
  `product_hd_tag` varchar(10) NOT NULL COMMENT '活动标签',
  `product_hd_stime` int(10) unsigned NOT NULL default '0' COMMENT '活动开始时间',
  `product_hd_etime` int(10) unsigned NOT NULL default '0' COMMENT '活动结束时间',
  `product_istuijian` tinyint(1) unsigned NOT NULL default '0',
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
  `product_money` decimal(10,1) unsigned NOT NULL default '0.0' COMMENT '规格商城价',
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
  `quan_key` char(10) NOT NULL,
  `quan_name` varchar(30) NOT NULL COMMENT '优惠券名称',
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
  `quanlog_utime` int(10) unsigned NOT NULL default '0' COMMENT '使用时间',
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
  PRIMARY KEY  (`quanlog_id`)
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
('web_copyright','2008-2015 简好网络'),
('web_tpl','default'),
('web_logo','data/attachment/2015-04/20150407113130k.jpg'),
('web_phone','15839823500'),
('web_qq','76265959'),
('web_icp','豫ICP备 13014394号-2'),
('web_guestbuy','1'),
('web_hotword','PHPSHE,B2C商城系统,简好网络'),
('web_tongji',''),
('web_wlname','a:15:{i:0;s:12:\"顺丰快递\";i:1;s:12:\"申通快递\";i:2;s:12:\"圆通快递\";i:3;s:12:\"韵达快递\";i:4;s:12:\"中通快递\";i:5;s:12:\"天天快递\";i:6;s:9:\"宅急送\";i:7;s:9:\"EMS快递\";i:8;s:12:\"百事汇通\";i:9;s:12:\"全峰快递\";i:10;s:12:\"德邦物流\";i:11;s:0:\"\";i:12;s:0:\"\";i:13;s:0:\"\";i:14;s:0:\"\";}'),
('email_smtp',''),
('email_port',''),
('email_name',''),
('email_pw',''),
('email_nname',''),
('email_admin',''),
('point_state','1'),
('point_reg','10'),
('point_comment','50'),
('point_login','2'),
('point_money','100');
/*#####################@ pe_cutsql @#####################*/
DROP TABLE IF EXISTS `{dbpre}user`;
/*#####################@ pe_cutsql @#####################*/
CREATE TABLE `{dbpre}user` (
  `user_id` int(10) unsigned NOT NULL auto_increment COMMENT '用户id',
  `user_name` varchar(20) NOT NULL COMMENT '用户名',
  `user_pw` varchar(32) NOT NULL COMMENT '用户密码',
  `user_money` decimal(10,1) unsigned NOT NULL default '0.0' COMMENT '账户余额',
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
  `user_ip` char(15) NOT NULL COMMENT '用户注册ip',
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
