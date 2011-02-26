-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 01, 2011 at 12:08 AM
-- Server version: 5.1.44
-- PHP Version: 5.2.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `drushmake_gen`
--

-- --------------------------------------------------------

--
-- Table structure for table `makefiles`
--

CREATE TABLE `makefiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `version` varchar(255) NOT NULL,
  `core` text,
  `modules` text,
  `themes` text,
  `libs` text,
  `opts` text,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) DEFAULT NULL,
  `unique` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `package` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `dependencies` text,
  `version` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=108 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` VALUES(1, 'core', 'drupal', 'Drupal core', '', '', NULL, '6', 1);
INSERT INTO `projects` VALUES(2, 'module', 'views', 'Views', 'Views', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(3, 'module', 'cck', 'Content Construction Kit (CCK)', 'CCK', '', 'a:1:{i:0;s:8:"field_ui";}', '7', 1);
INSERT INTO `projects` VALUES(4, 'module', 'token', 'Token', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(5, 'module', 'pathauto', 'Pathauto', 'Other', '', 'a:2:{i:0;s:4:"path";i:1;s:5:"token";}', '6', 1);
INSERT INTO `projects` VALUES(6, 'module', 'filefield', 'FileField', 'CCK', '', 'a:1:{i:0;s:7:"content";}', '6', 1);
INSERT INTO `projects` VALUES(7, 'module', 'imageapi', 'ImageAPI', 'ImageCache', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(8, 'module', 'admin_menu', 'Administration menu', 'Administration', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(9, 'module', 'imagefield', 'ImageField', 'CCK', '', 'a:2:{i:0;s:7:"content";i:1;s:9:"filefield";}', '6', 1);
INSERT INTO `projects` VALUES(10, 'module', 'imagecache', 'ImageCache', 'ImageCache', '', 'a:2:{i:0;s:8:"imageapi";i:1;s:15:"transliteration";}', '6', 1);
INSERT INTO `projects` VALUES(11, 'core', 'pressflow', 'Pressflow', '', 'http://files.pressflow.org/pressflow-6-current.tar.gz', NULL, '6', 1);
INSERT INTO `projects` VALUES(12, 'module', 'panels', 'Panels', 'Panels', '', 'a:1:{i:0;s:6:"ctools";}', '6', 1);
INSERT INTO `projects` VALUES(13, 'module', 'ctools', 'Chaos tool suite', 'Chaos tool suite', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(14, 'module', 'admin', 'Admin', 'Administration', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(15, 'module', 'date', 'Date', 'Other', '', NULL, '6', 1);
INSERT INTO `projects` VALUES(16, 'module', 'imce', 'IMCE', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(17, 'module', 'google_analytics', 'Google Analytics', 'Other', '', NULL, '6', 1);
INSERT INTO `projects` VALUES(18, 'module', 'wysiwyg', 'Wysiwyg', 'User interface', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(19, 'module', 'webform', 'Webform', 'Webform', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(20, 'module', 'captcha', 'CAPTCHA', 'Spam control', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(21, 'module', 'image', 'Image', 'Image', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(22, 'module', 'advanced_help', 'Advanced help', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(23, 'module', 'poormanscron', 'Poormanscron', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(24, 'module', 'jquery_ui', 'jQuery UI', 'User interface', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(25, 'module', 'lightbox2', 'Lightbox2', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(26, 'module', 'link', 'Link', 'CCK', '', 'a:1:{i:0;s:7:"content";}', '6', 1);
INSERT INTO `projects` VALUES(27, 'module', 'nodewords', 'Nodewords', 'Meta tags', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(28, 'module', 'backup_migrate', 'Backup and Migrate', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(29, 'module', 'jquery_update', 'jQuery Update', 'User Interface', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(30, 'module', 'fckeditor', 'FCKeditor - WYSIWYG HTML editor', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(31, 'module', 'xmlsitemap', 'XML sitemap', 'XML sitemap', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(32, 'module', 'devel', 'Devel', 'Development', '', 'a:1:{i:0;s:4:"menu";}', '6', 1);
INSERT INTO `projects` VALUES(33, 'module', 'calendar', 'Calendar', 'Date/Time', '', 'a:3:{i:0;s:5:"views";i:1;s:8:"date_api";i:2;s:13:"date_timezone";}', '6', 1);
INSERT INTO `projects` VALUES(34, 'module', 'globalredirect', 'Global Redirect', 'Other', '', 'a:1:{i:0;s:4:"path";}', '6', 1);
INSERT INTO `projects` VALUES(35, 'module', 'transliteration', 'Transliteration', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(36, 'module', 'page_title', 'Page Title', 'Other', '', 'a:1:{i:0;s:5:"token";}', '6', 1);
INSERT INTO `projects` VALUES(37, 'module', 'imce_wysiwyg', 'IMCE Wysiwyg bridge', 'User interface', '', 'a:2:{i:0;s:4:"imce";i:1;s:7:"wysiwyg";}', '6', 1);
INSERT INTO `projects` VALUES(38, 'theme', 'zen', 'Zen', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(39, 'module', 'votingapi', 'Voting API', 'Voting', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(40, 'module', 'ckeditor', 'CKEditor - WYSIWYG HTML editor', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(41, 'module', 'views_slideshow', 'Views Slideshow', 'Views', '', 'a:1:{i:0;s:5:"views";}', '6', 1);
INSERT INTO `projects` VALUES(42, 'module', 'nice_menus', 'Nice Menus', 'Other', '', 'a:1:{i:0;s:4:"menu";}', '6', 1);
INSERT INTO `projects` VALUES(43, 'module', 'email', 'Email Field', 'CCK', '', 'a:1:{i:0;s:7:"content";}', '6', 1);
INSERT INTO `projects` VALUES(44, 'module', 'print', 'Printer, e-mail and PDF versions', 'Printer, e-mail and PDF versions', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(45, 'module', 'rules', 'Rules', 'Other', '', NULL, '6', 1);
INSERT INTO `projects` VALUES(46, 'module', 'contemplate', 'Content Templates (Contemplate)', 'CCK', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(47, 'module', 'tagadelic', 'Tagadelic', 'Taxonomy', '', 'a:1:{i:0;s:8:"taxonomy";}', '6', 1);
INSERT INTO `projects` VALUES(48, 'module', 'path_redirect', 'Path redirect', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(49, 'module', 'site_map', 'Site map', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(50, 'module', 'emfield', 'Embedded Media Field', 'Media', '', 'a:1:{i:0;s:7:"content";}', '6', 1);
INSERT INTO `projects` VALUES(51, 'module', 'logintoboggan', 'LoginToboggan', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(52, 'module', 'mimemail', 'Mime Mail', 'Mail', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(53, 'module', 'i18n', 'Internationalization', 'Multilanguage', '', 'a:2:{i:0;s:6:"locale";i:1;s:11:"translation";}', '6', 1);
INSERT INTO `projects` VALUES(54, 'module', 'better_formats', 'Better Formats', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(55, 'module', 'views_bulk_operations', 'Views Bulk Operations (VBO)', 'Views', '', 'a:1:{i:0;s:5:"views";}', '6', 1);
INSERT INTO `projects` VALUES(56, 'module', 'ubercart', 'Ubercart', 'Other', '', NULL, '6', 1);
INSERT INTO `projects` VALUES(57, 'module', 'auto_nodetitle', 'Automatic Nodetitles', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(58, 'module', 'simplenews', 'Simplenews', 'Mail', '', 'a:1:{i:0;s:8:"taxonomy";}', '6', 1);
INSERT INTO `projects` VALUES(59, 'module', 'content_profile', 'Content Profile', 'Content Profile', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(60, 'module', 'admin', 'Admin', 'Administration', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(61, 'module', 'fivestar', 'Fivestar', 'Voting', '', 'a:1:{i:0;s:9:"votingapi";}', '6', 1);
INSERT INTO `projects` VALUES(62, 'module', 'location', 'Location', 'Location', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(63, 'module', 'vertical_tabs', 'Vertical Tabs', 'User interface', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(64, 'module', 'menu_block', 'Menu block', 'Other', '', 'a:2:{i:0;s:5:"block";i:1;s:4:"menu";}', '6', 1);
INSERT INTO `projects` VALUES(65, 'module', 'extlink', 'External Links', 'User interface', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(66, 'module', 'gmap', 'GMap Module', 'Location', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(67, 'module', 'mollom', 'Mollom', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(68, 'module', 'dhtml_menu', 'DHTML Menu', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(69, 'module', 'swftools', 'SWF Tools', 'SWF Tools', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(70, 'module', 'getid3', 'getID3()', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(71, 'module', 'content_taxonomy', 'Content Taxonomy', 'CCK', '', 'a:2:{i:0;s:8:"content ";i:1;s:8:"taxonomy";}', '6', 1);
INSERT INTO `projects` VALUES(72, 'module', 'thickbox', 'Thickbox', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(73, 'module', 'skinr', 'Skinr', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(74, 'module', 'content_access', 'Content Access', 'Access control', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(75, 'module', 'img_assist', 'Image Assist', 'Image', '', 'a:2:{i:0;s:5:"image";i:1;s:5:"views";}', '6', 1);
INSERT INTO `projects` VALUES(76, 'module', 'taxonomy_manager', 'Taxonomy Manager', 'Other', '', 'a:1:{i:0;s:8:"taxonomy";}', '6', 1);
INSERT INTO `projects` VALUES(77, 'module', 'adminrole', 'Admin role', 'Administration', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(78, 'module', 'jquery_plugin', 'jQuery plugins', 'User interface', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(79, 'module', 'author_pane', 'Author Pane', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(80, 'module', 'imagecache_actions', 'ImageCache Actions', 'Other', '', NULL, '6', 1);
INSERT INTO `projects` VALUES(81, 'module', 'taxonomy_menu', 'Taxonomy Menu', 'Taxonomy Menu', '', 'a:1:{i:0;s:8:"taxonomy";}', '6', 1);
INSERT INTO `projects` VALUES(82, 'module', 'views_bonus', 'Views Bonus Pack', 'Other', '', NULL, '6', 1);
INSERT INTO `projects` VALUES(83, 'module', 'gtranslate', 'GTranslate', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(84, 'module', 'menu_breadcrumb', 'Menu Breadcrumb', 'Other', '', 'a:1:{i:0;s:4:"menu";}', '6', 1);
INSERT INTO `projects` VALUES(85, 'module', 'features', 'Features', 'Features', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(86, 'module', 'scheduler', 'Scheduler', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(87, 'theme', 'fusion', 'Fusion', 'Other', '', NULL, '6', 0);
INSERT INTO `projects` VALUES(88, 'module', 'diff', 'Diff', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(89, 'module', 'recaptcha', 'reCAPTCHA', 'Spam control', '', 'a:1:{i:0;s:7:"captcha";}', '6', 1);
INSERT INTO `projects` VALUES(90, 'module', 'flag', 'Flag', 'Flags', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(91, 'module', 'twitter', 'Twitter', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(92, 'module', 'og', 'Organic groups', 'Organic groups', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(93, 'module', 'context', 'Context', 'Context', '', 'a:1:{i:0;s:8:""ctools"";}', '6', 1);
INSERT INTO `projects` VALUES(94, 'module', 'messaging', 'Messaging', 'Messaging', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(95, 'module', 'comment_notify', 'Comment Notify', 'Other', '', 'a:1:{i:0;s:7:"comment";}', '6', 1);
INSERT INTO `projects` VALUES(96, 'module', 'node_clone', 'Node clone', 'Other', '', NULL, '6', 1);
INSERT INTO `projects` VALUES(97, 'module', 'advanced_forum', 'Advanced Forum', 'Other', '', 'a:2:{i:0;s:5:"forum";i:1;s:11:"author_pane";}', '6', 1);
INSERT INTO `projects` VALUES(98, 'module', 'custom_breadcrumbs', 'Custom Breadcrumbs', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(99, 'module', 'search404', 'Search 404', 'Other', '', 'a:1:{i:0;s:8:"search";}', '6', 1);
INSERT INTO `projects` VALUES(100, 'module', 'faq', 'Frequently Asked Questions', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(101, 'theme', 'mothership', 'mothership', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(102, 'theme', 'tao', 'Tao', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(103, 'theme', 'rubik', 'Rubik', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(104, 'theme', 'ninesixty', 'NineSixty (960 Grid System)', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(105, 'module', 'cck', 'Content Construction Kit (CCK)', 'CCK', '', NULL, '6', 1);
INSERT INTO `projects` VALUES(106, 'lib', 'jquery', 'jQuery', '', '', NULL, '', 1);
INSERT INTO `projects` VALUES(107, 'lib', 'jqueryui', 'jQuery UI', '', '', NULL, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `versions`
--

CREATE TABLE `versions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `version` varchar(255) NOT NULL,
  `release` varchar(255) DEFAULT NULL,
  `url` text,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `versions`
--

INSERT INTO `versions` VALUES(1, 106, '', '1.5.0', 'https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js', '2011-01-30 21:41:09');
INSERT INTO `versions` VALUES(2, 107, '', '1.8.9', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js', '2011-01-30 21:41:09');
INSERT INTO `versions` VALUES(3, 106, '', '1.3.2', 'https://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js', '2011-01-31 10:17:57');
