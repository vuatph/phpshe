-- phpMyAdmin SQL Dump
-- version 3.3.7
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 07 月 26 日 05:52
-- 服务器版本: 5.0.90
-- PHP 版本: 5.2.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `pe_new`
--

-- --------------------------------------------------------

--
-- 表的结构 `ad`
--

CREATE TABLE IF NOT EXISTS `ad` (
  `ad_id` int(10) unsigned NOT NULL auto_increment,
  `ad_logo` varchar(100) NOT NULL,
  `ad_url` varchar(100) NOT NULL,
  `ad_order` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`ad_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `ad`
--


-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(10) unsigned NOT NULL auto_increment COMMENT '管理id',
  `admin_name` varchar(20) NOT NULL COMMENT '管理名',
  `admin_pw` varchar(32) NOT NULL COMMENT '管理密码',
  `admin_atime` int(10) unsigned NOT NULL default '0' COMMENT '管理注册时间',
  `admin_ltime` int(10) unsigned NOT NULL default '0' COMMENT '管理上次登录时间',
  PRIMARY KEY  (`admin_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_pw`, `admin_atime`, `admin_ltime`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1269059337, 1343280487);

-- --------------------------------------------------------

--
-- 表的结构 `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `article_id` int(10) unsigned NOT NULL auto_increment,
  `article_name` varchar(100) NOT NULL,
  `article_text` text NOT NULL,
  `article_atime` int(10) unsigned NOT NULL default '0',
  `article_clicknum` int(10) unsigned NOT NULL default '0',
  `category_id` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`article_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `article`
--


-- --------------------------------------------------------

--
-- 表的结构 `ask`
--

CREATE TABLE IF NOT EXISTS `ask` (
  `ask_id` int(10) unsigned NOT NULL auto_increment,
  `ask_text` text NOT NULL,
  `ask_atime` int(10) unsigned NOT NULL default '0',
  `ask_replytext` text NOT NULL,
  `ask_replytime` int(10) unsigned NOT NULL default '0',
  `ask_state` tinyint(1) unsigned NOT NULL default '0',
  `product_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL default '0',
  `user_name` varchar(30) NOT NULL,
  `user_ip` char(15) NOT NULL default '0.0.0.0',
  PRIMARY KEY  (`ask_id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `ask`
--


-- --------------------------------------------------------

--
-- 表的结构 `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int(10) unsigned NOT NULL auto_increment,
  `cart_atime` int(10) unsigned NOT NULL default '0',
  `product_id` int(10) unsigned NOT NULL default '0',
  `product_num` smallint(5) unsigned NOT NULL default '1',
  `user_id` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`cart_id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `cart`
--


-- --------------------------------------------------------

--
-- 表的结构 `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` smallint(5) unsigned NOT NULL auto_increment,
  `category_pid` smallint(5) unsigned NOT NULL default '0',
  `category_name` varchar(30) NOT NULL,
  `category_type` varchar(20) NOT NULL default 'product',
  `category_order` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `category`
--

INSERT INTO `category` (`category_id`, `category_pid`, `category_name`, `category_type`, `category_order`) VALUES
(1, 0, '网站公告', 'article', 0);

-- --------------------------------------------------------

--
-- 表的结构 `collect`
--

CREATE TABLE IF NOT EXISTS `collect` (
  `collect_id` int(10) unsigned NOT NULL auto_increment,
  `collect_atime` int(10) unsigned NOT NULL default '0',
  `product_id` int(10) unsigned NOT NULL default '0',
  `user_id` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`collect_id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `collect`
--


-- --------------------------------------------------------

--
-- 表的结构 `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` int(10) unsigned NOT NULL auto_increment COMMENT '留言id',
  `comment_text` text NOT NULL COMMENT '留言内容',
  `comment_atime` int(10) NOT NULL default '0' COMMENT '留言时间',
  `product_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL COMMENT '接受方用户id',
  `user_name` varchar(30) NOT NULL,
  `user_ip` char(15) NOT NULL default '0.0.0.0',
  PRIMARY KEY  (`comment_id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `comment`
--


-- --------------------------------------------------------

--
-- 表的结构 `link`
--

CREATE TABLE IF NOT EXISTS `link` (
  `link_id` int(10) unsigned NOT NULL auto_increment COMMENT '友情链接id',
  `link_name` varchar(50) NOT NULL COMMENT '友情链接名称',
  `link_url` varchar(100) NOT NULL COMMENT '友情链接url',
  `link_order` int(10) unsigned NOT NULL default '0' COMMENT '友情链接排序',
  PRIMARY KEY  (`link_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `link`
--

INSERT INTO `link` (`link_id`, `link_name`, `link_url`, `link_order`) VALUES
(1, '简好技术', 'http://www.phpshe.com', 0);

-- --------------------------------------------------------

--
-- 表的结构 `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `order_id` int(10) unsigned NOT NULL auto_increment COMMENT '订单id',
  `order_money` decimal(10,1) unsigned NOT NULL default '0.0' COMMENT '订单金额',
  `order_productmoney` decimal(10,1) unsigned NOT NULL default '0.0',
  `order_state` varchar(10) NOT NULL default 'notpay',
  `order_paytype` varchar(10) NOT NULL default 'alipay_js',
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
  `user_tname` varchar(20) NOT NULL,
  `user_phone` char(11) NOT NULL COMMENT '用户手机',
  `user_tel` varchar(20) NOT NULL,
  `user_address` varchar(255) NOT NULL COMMENT '用户地址',
  PRIMARY KEY  (`order_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `order`
--


-- --------------------------------------------------------

--
-- 表的结构 `orderdata`
--

CREATE TABLE IF NOT EXISTS `orderdata` (
  `orderdata_id` int(10) unsigned NOT NULL auto_increment COMMENT '订单数据id',
  `order_id` int(10) unsigned NOT NULL default '0' COMMENT '订单id',
  `product_id` int(10) unsigned NOT NULL default '0' COMMENT '商品id',
  `product_name` varchar(50) NOT NULL COMMENT '订单名称',
  `product_smoney` decimal(10,1) NOT NULL default '0.0',
  `product_num` smallint(5) unsigned NOT NULL,
  PRIMARY KEY  (`orderdata_id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `orderdata`
--


-- --------------------------------------------------------

--
-- 表的结构 `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `page_id` smallint(5) unsigned NOT NULL auto_increment,
  `page_name` varchar(20) NOT NULL,
  `page_text` text NOT NULL,
  PRIMARY KEY  (`page_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `page`
--

INSERT INTO `page` (`page_id`, `page_name`, `page_text`) VALUES
(1, '购物指南', '购物指南'),
(2, '支付方式', '支付方式'),
(3, '常见问题', '常见问题'),
(4, '配送时间及运费', '配送时间及运费'),
(5, '验货与签收', '验货与签收'),
(6, '订单查询', '订单查询'),
(7, '退换货流程', '退换货流程'),
(8, '退换货条款', '退换货条款'),
(9, '用户协议', '用户协议'),
(10, '公司简介', '公司简介'),
(11, '联系我们', '联系我们'),
(12, '诚聘英才', '诚聘英才');

-- --------------------------------------------------------

--
-- 表的结构 `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` smallint(5) unsigned NOT NULL auto_increment COMMENT '商品id',
  `product_name` varchar(50) NOT NULL COMMENT '商品名称',
  `product_text` text NOT NULL COMMENT '商品描述',
  `product_logo` varchar(200) NOT NULL COMMENT '商品logo',
  `product_mmoney` decimal(10,1) unsigned NOT NULL default '0.0' COMMENT '商品市场价',
  `product_smoney` decimal(10,1) unsigned NOT NULL default '0.0' COMMENT '商品商城价',
  `product_wlmoney` decimal(5,1) unsigned NOT NULL default '0.0' COMMENT '商品物流价',
  `product_mark` varchar(10) NOT NULL COMMENT '商品货号',
  `product_weight` decimal(7,2) NOT NULL COMMENT '商品尺寸',
  `product_state` tinyint(1) unsigned NOT NULL default '1' COMMENT '商品状态',
  `product_atime` int(10) unsigned NOT NULL default '0' COMMENT '商品发布时间',
  `product_num` smallint(5) unsigned NOT NULL COMMENT '商品库存数',
  `product_sellnum` int(10) unsigned NOT NULL default '0' COMMENT '商品销售数',
  `product_clicknum` int(10) unsigned NOT NULL default '0' COMMENT '商品点击数',
  `product_collectnum` int(10) unsigned NOT NULL default '0' COMMENT '商品收藏数',
  `product_asknum` int(10) unsigned NOT NULL default '0' COMMENT '商品咨询数',
  `product_commentnum` int(10) unsigned NOT NULL default '0' COMMENT '商品评价数',
  `category_id` smallint(5) unsigned NOT NULL COMMENT '商品分类id',
  PRIMARY KEY  (`product_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `product`
--


-- --------------------------------------------------------

--
-- 表的结构 `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `setting_key` varchar(50) NOT NULL,
  `setting_value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `setting`
--

INSERT INTO `setting` (`setting_key`, `setting_value`) VALUES
('web_tpl', 'default'),
('web_title', 'phpshe(PE)以良好的服务为小企业提供B2C电子商务解决方案'),
('web_keywords', 'phpshe,pe,php,mysql,shop,b2c,开源免费网上商城程序'),
('web_description', 'phpshe(PE)以良好的服务为小企业提供B2C电子商务解决方案'),
('web_copyright', '2008-2012 简好技术'),
('web_icp', ''),
('web_weibo', 'http://weibo.com/'),
('web_tongji', ''),
('alipay_name', ''),
('alipay_pid', ''),
('alipay_key', '');

-- --------------------------------------------------------

--
-- 表的结构 `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `tag_name` varchar(10) NOT NULL COMMENT '标签名称',
  `product_id` int(10) unsigned NOT NULL default '0' COMMENT '商品id',
  KEY `tag_name` (`tag_name`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tag`
--


-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) unsigned NOT NULL auto_increment COMMENT '用户id',
  `user_name` varchar(20) NOT NULL COMMENT '用户名',
  `user_pw` varchar(32) NOT NULL COMMENT '用户密码',
  `user_tname` varchar(10) NOT NULL COMMENT '用户姓名',
  `user_phone` char(11) NOT NULL COMMENT '用户手机',
  `user_qq` varchar(10) NOT NULL COMMENT '用户QQ',
  `user_email` varchar(30) NOT NULL COMMENT '用户email',
  `user_atime` int(10) unsigned NOT NULL default '0' COMMENT '用户注册时间',
  `user_ltime` int(10) unsigned NOT NULL default '0' COMMENT '用户上次登录时间',
  `user_address` varchar(255) NOT NULL COMMENT '用户地址',
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `user`
--

