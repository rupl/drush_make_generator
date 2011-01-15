-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 14, 2011 at 03:50 PM
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
  `contrib` text,
  `libs` text,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

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
  `version` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=625 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` VALUES(1, 'core', 'drupal', 'Drupal core', '', '', NULL, '6', 1);
INSERT INTO `projects` VALUES(2, 'contrib', 'views', 'Views', 'Views', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(3, 'contrib', 'cck', 'Content Construction Kit (CCK)', 'CCK', '', 'a:1:{i:0;s:8:"field_ui";}', '7', 1);
INSERT INTO `projects` VALUES(4, 'contrib', 'token', 'Token', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(5, 'contrib', 'pathauto', 'Pathauto', 'Other', '', 'a:2:{i:0;s:4:"path";i:1;s:5:"token";}', '6', 1);
INSERT INTO `projects` VALUES(6, 'contrib', 'filefield', 'FileField', 'CCK', '', 'a:1:{i:0;s:7:"content";}', '6', 1);
INSERT INTO `projects` VALUES(7, 'contrib', 'imageapi', 'ImageAPI', 'ImageCache', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(8, 'contrib', 'admin_menu', 'Administration menu', 'Administration', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(9, 'contrib', 'imagefield', 'ImageField', 'CCK', '', 'a:2:{i:0;s:7:"content";i:1;s:9:"filefield";}', '6', 1);
INSERT INTO `projects` VALUES(10, 'contrib', 'imagecache', 'ImageCache', 'ImageCache', '', 'a:2:{i:0;s:8:"imageapi";i:1;s:15:"transliteration";}', '6', 1);
INSERT INTO `projects` VALUES(11, 'core', 'pressflow', 'Pressflow', '', 'http://files.pressflow.org/pressflow-6-current.tar.gz', NULL, '6', 1);
INSERT INTO `projects` VALUES(12, 'contrib', 'panels', 'Panels', 'Panels', '', 'a:1:{i:0;s:6:"ctools";}', '6', 1);
INSERT INTO `projects` VALUES(13, 'contrib', 'ctools', 'Chaos tool suite', 'Chaos', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(14, 'contrib', 'admin', 'Admin', 'Administration', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(15, 'contrib', 'date', 'Date', 'Other', '', NULL, '6', 1);
INSERT INTO `projects` VALUES(16, 'contrib', 'imce', 'IMCE', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(17, 'contrib', 'google_analytics', 'Google Analytics', 'Other', '', NULL, '6', 1);
INSERT INTO `projects` VALUES(18, 'contrib', 'wysiwyg', 'Wysiwyg', 'User', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(19, 'contrib', 'webform', 'Webform', 'Webform', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(20, 'contrib', 'captcha', 'CAPTCHA', 'Spam', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(21, 'contrib', 'image', 'Image', 'Image', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(22, 'contrib', 'advanced_help', 'Advanced help', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(23, 'contrib', 'poormanscron', 'Poormanscron', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(24, 'contrib', 'jquery_ui', 'jQuery UI', 'User', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(25, 'contrib', 'lightbox2', 'Lightbox2', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(26, 'contrib', 'link', 'Link', 'CCK', '', 'a:1:{i:0;s:7:"content";}', '6', 1);
INSERT INTO `projects` VALUES(27, 'contrib', 'nodewords', 'Nodewords', 'Meta', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(28, 'contrib', 'backup_migrate', 'Backup and Migrate', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(29, 'contrib', 'jquery_update', 'jQuery Update', 'User', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(30, 'contrib', 'fckeditor', 'FCKeditor - WYSIWYG HTML editor', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(31, 'contrib', 'xmlsitemap', 'XML sitemap', 'XML', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(32, 'contrib', 'devel', 'Devel', 'Development', '', 'a:1:{i:0;s:4:"menu";}', '6', 1);
INSERT INTO `projects` VALUES(33, 'contrib', 'calendar', 'Calendar', 'Date/Time', '', 'a:3:{i:0;s:5:"views";i:1;s:8:"date_api";i:2;s:13:"date_timezone";}', '6', 1);
INSERT INTO `projects` VALUES(34, 'contrib', 'globalredirect', 'Global Redirect', 'Other', '', 'a:1:{i:0;s:4:"path";}', '6', 1);
INSERT INTO `projects` VALUES(35, 'contrib', 'transliteration', 'Transliteration', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(36, 'contrib', 'page_title', 'Page Title', 'Other', '', 'a:1:{i:0;s:5:"token";}', '6', 1);
INSERT INTO `projects` VALUES(37, 'contrib', 'imce_wysiwyg', 'IMCE Wysiwyg bridge', 'User', '', 'a:2:{i:0;s:4:"imce";i:1;s:7:"wysiwyg";}', '6', 1);
INSERT INTO `projects` VALUES(38, 'contrib', 'zen', 'Zen', 'Other', '', NULL, '6', 1);
INSERT INTO `projects` VALUES(39, 'contrib', 'votingapi', 'Voting API', 'Voting', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(40, 'contrib', 'ckeditor', 'CKEditor - WYSIWYG HTML editor', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(41, 'contrib', 'views_slideshow', 'Views Slideshow', 'Views', '', 'a:1:{i:0;s:5:"views";}', '6', 1);
INSERT INTO `projects` VALUES(42, 'contrib', 'nice_menus', 'Nice Menus', 'Other', '', 'a:1:{i:0;s:4:"menu";}', '6', 1);
INSERT INTO `projects` VALUES(43, 'contrib', 'email', 'Email Field', 'CCK', '', 'a:1:{i:0;s:7:"content";}', '6', 1);
INSERT INTO `projects` VALUES(44, 'contrib', 'print', 'Printer, e-mail and PDF versions', 'Printer,', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(45, 'contrib', 'rules', 'Rules', 'Other', '', NULL, '6', 1);
INSERT INTO `projects` VALUES(46, 'contrib', 'contemplate', 'Content Templates (Contemplate)', 'CCK', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(47, 'contrib', 'tagadelic', 'Tagadelic', 'Taxonomy', '', 'a:1:{i:0;s:8:"taxonomy";}', '6', 1);
INSERT INTO `projects` VALUES(48, 'contrib', 'path_redirect', 'Path redirect', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(49, 'contrib', 'site_map', 'Site map', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(50, 'contrib', 'emfield', 'Embedded Media Field', 'Media', '', 'a:1:{i:0;s:7:"content";}', '6', 1);
INSERT INTO `projects` VALUES(51, 'contrib', 'logintoboggan', 'LoginToboggan', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(52, 'contrib', 'mimemail', 'Mime Mail', 'Mail', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(53, 'contrib', 'i18n', 'Internationalization', 'Multilanguage', '', 'a:2:{i:0;s:6:"locale";i:1;s:11:"translation";}', '6', 1);
INSERT INTO `projects` VALUES(54, 'contrib', 'better_formats', 'Better Formats', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(55, 'contrib', 'views_bulk_operations', 'Views Bulk Operations (VBO)', 'Views', '', 'a:1:{i:0;s:5:"views";}', '6', 1);
INSERT INTO `projects` VALUES(56, 'contrib', 'ubercart', 'Ubercart', 'Other', '', NULL, '6', 1);
INSERT INTO `projects` VALUES(57, 'contrib', 'auto_nodetitle', 'Automatic Nodetitles', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(58, 'contrib', 'simplenews', 'Simplenews', 'Mail', '', 'a:1:{i:0;s:8:"taxonomy";}', '6', 1);
INSERT INTO `projects` VALUES(59, 'contrib', 'content_profile', 'Content Profile', 'Content', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(60, 'contrib', 'admin', 'Admin', 'Administration', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(61, 'contrib', 'fivestar', 'Fivestar', 'Voting', '', 'a:1:{i:0;s:9:"votingapi";}', '6', 1);
INSERT INTO `projects` VALUES(62, 'contrib', 'location', 'Location', 'Location', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(63, 'contrib', 'vertical_tabs', 'Vertical Tabs', 'Other', '', NULL, '6', 1);
INSERT INTO `projects` VALUES(64, 'contrib', 'menu_block', 'Menu block', 'Other', '', 'a:2:{i:0;s:5:"block";i:1;s:4:"menu";}', '6', 1);
INSERT INTO `projects` VALUES(65, 'contrib', 'extlink', 'External Links', 'User', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(66, 'contrib', 'gmap', 'GMap Module', 'Location', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(67, 'contrib', 'mollom', 'Mollom', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(68, 'contrib', 'dhtml_menu', 'DHTML Menu', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(69, 'contrib', 'swftools', 'SWF Tools', 'SWF', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(70, 'contrib', 'getid3', 'getID3()', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(71, 'contrib', 'content_taxonomy', 'Content Taxonomy', 'CCK', '', 'a:2:{i:0;s:8:"content ";i:1;s:8:"taxonomy";}', '6', 1);
INSERT INTO `projects` VALUES(72, 'contrib', 'thickbox', 'Thickbox', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(73, 'contrib', 'skinr', 'Skinr', 'Other', '', NULL, '6', 1);
INSERT INTO `projects` VALUES(74, 'contrib', 'content_access', 'Content Access', 'Access', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(75, 'contrib', 'img_assist', 'Image Assist', 'Image', '', 'a:2:{i:0;s:5:"image";i:1;s:5:"views";}', '6', 1);
INSERT INTO `projects` VALUES(76, 'contrib', 'taxonomy_manager', 'Taxonomy Manager', 'Other', '', 'a:1:{i:0;s:8:"taxonomy";}', '6', 1);
INSERT INTO `projects` VALUES(77, 'contrib', 'adminrole', 'Admin role', 'Other', '', NULL, '6', 1);
INSERT INTO `projects` VALUES(78, 'contrib', 'jquery_plugin', 'jQuery plugins', 'User', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(79, 'contrib', 'author_pane', 'Author Pane', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(80, 'contrib', 'imagecache_actions', 'ImageCache Actions', 'Other', '', NULL, '6', 1);
INSERT INTO `projects` VALUES(81, 'contrib', 'taxonomy_menu', 'Taxonomy Menu', 'Taxonomy', '', 'a:1:{i:0;s:8:"taxonomy";}', '6', 1);
INSERT INTO `projects` VALUES(82, 'contrib', 'views_bonus', 'Views Bonus Pack', 'Other', '', NULL, '6', 1);
INSERT INTO `projects` VALUES(83, 'contrib', 'gtranslate', 'GTranslate', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(84, 'contrib', 'menu_breadcrumb', 'Menu Breadcrumb', 'Other', '', 'a:1:{i:0;s:4:"menu";}', '6', 1);
INSERT INTO `projects` VALUES(85, 'contrib', 'features', 'Features', 'Features', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(86, 'contrib', 'scheduler', 'Scheduler', 'Other', '', NULL, '6', 1);
INSERT INTO `projects` VALUES(87, 'contrib', 'fusion', 'Fusion', 'Other', '', NULL, '6', 1);
INSERT INTO `projects` VALUES(88, 'contrib', 'diff', 'Diff', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(89, 'contrib', 'recaptcha', 'reCAPTCHA', 'Spam', '', 'a:1:{i:0;s:7:"captcha";}', '6', 1);
INSERT INTO `projects` VALUES(90, 'contrib', 'flag', 'Flag', 'Flags', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(91, 'contrib', 'twitter', 'Twitter', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(92, 'contrib', 'og', 'Organic groups', 'Other', '', NULL, '6', 1);
INSERT INTO `projects` VALUES(93, 'contrib', 'context', 'Context', 'Context', '', 'a:1:{i:0;s:8:""ctools"";}', '6', 1);
INSERT INTO `projects` VALUES(94, 'contrib', 'messaging', 'Messaging', 'Messaging', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(95, 'contrib', 'comment_notify', 'Comment Notify', 'Other', '', 'a:1:{i:0;s:7:"comment";}', '6', 1);
INSERT INTO `projects` VALUES(96, 'contrib', 'node_clone', 'Node clone', 'Other', '', NULL, '6', 1);
INSERT INTO `projects` VALUES(97, 'contrib', 'advanced_forum', 'Advanced Forum', 'Other', '', 'a:2:{i:0;s:5:"forum";i:1;s:11:"author_pane";}', '6', 1);
INSERT INTO `projects` VALUES(98, 'contrib', 'custom_breadcrumbs', 'Custom Breadcrumbs', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(99, 'contrib', 'search404', 'Search 404', 'Other', '', 'a:1:{i:0;s:8:"search";}', '6', 1);
INSERT INTO `projects` VALUES(100, 'contrib', 'faq', 'Frequently Asked Questions', 'Other', '', 'a:0:{}', '6', 1);
INSERT INTO `projects` VALUES(101, 'contrib', 'quicktabs', 'Quick Tabs', 'Other', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(102, 'contrib', 'seo_checklist', 'SEO Checklist', 'Other', '', NULL, '6', 0);
INSERT INTO `projects` VALUES(103, 'contrib', 'notifications', 'Notifications', 'Notifications', '', 'a:2:{i:0;s:9:"messaging";i:1;s:5:"token";}', '6', 0);
INSERT INTO `projects` VALUES(104, 'contrib', 'filefield_paths', 'FileField Paths', 'FileField', '', 'a:1:{i:0;s:6:"token\r";}', '6', 0);
INSERT INTO `projects` VALUES(105, 'contrib', 'acl', 'ACL', 'Other', '', NULL, '6', 0);
INSERT INTO `projects` VALUES(106, 'contrib', 'event', 'Event', 'Other', '', NULL, '6', 0);
INSERT INTO `projects` VALUES(107, 'contrib', 'notify', 'Notify', 'Mail', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(108, 'contrib', 'views_customfield', 'Views Custom Field', 'Views', '', 'a:1:{i:0;s:5:"views";}', '6', 0);
INSERT INTO `projects` VALUES(109, 'contrib', 'front', 'Front Page', 'Other', '', NULL, '6', 0);
INSERT INTO `projects` VALUES(110, 'contrib', 'views_attach', 'Views attach', 'Views', '', 'a:1:{i:0;s:5:"views";}', '6', 0);
INSERT INTO `projects` VALUES(111, 'contrib', 'privatemsg', 'Privatemsg', 'Mail', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(112, 'contrib', 'addtoany', 'AddToAny Share/Bookmark Button', 'Other', '', NULL, '6', 0);
INSERT INTO `projects` VALUES(113, 'contrib', 'service_links', 'Service links', 'Service', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(114, 'contrib', 'smtp', 'SMTP Authentication Support', 'Mail', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(115, 'contrib', 'imagebrowser', 'Image Browser', 'Image', '', 'a:3:{i:0;s:8:"imageapi";i:1;s:5:"image";i:2;s:5:"views";}', '6', 0);
INSERT INTO `projects` VALUES(116, 'contrib', 'imagecache_profiles', 'ImageCache Profiles', 'ImageCache', '', 'a:1:{i:0;s:10:"imagecache";}', '6', 0);
INSERT INTO `projects` VALUES(117, 'contrib', 'nodequeue', 'Nodequeue', 'Nodequeue', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(118, 'contrib', 'nodereference_url', 'Node Reference URL Widget', 'CCK', '', 'a:1:{i:0;s:13:"nodereference";}', '6', 0);
INSERT INTO `projects` VALUES(119, 'contrib', 'feedapi', 'FeedAPI', 'FeedAPI', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(120, 'contrib', 'login_destination', 'Login Destination', 'Other', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(121, 'contrib', 'menutrails', 'Menu Trails', 'Other', '', 'a:1:{i:0;s:4:"menu";}', '6', 0);
INSERT INTO `projects` VALUES(122, 'contrib', 'site_verify', 'Site verification', 'Other', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(123, 'contrib', 'acquia_marina', 'Acquia Marina', 'Other', '', NULL, '6', 0);
INSERT INTO `projects` VALUES(124, 'contrib', 'computed_field', 'Computed Field', 'CCK', '', 'a:1:{i:0;s:7:"content";}', '6', 0);
INSERT INTO `projects` VALUES(125, 'contrib', 'image_fupload', 'Image FUpload', 'Other', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(126, 'contrib', 'update_status', 'Update Status', 'Other', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(127, 'contrib', 'tabs', 'Tabs (jQuery UI tabs)', 'Other', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(128, 'contrib', 'jstools', 'Javascript Tools', 'User', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(129, 'contrib', 'stringoverrides', 'String Overrides', 'Other', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(130, 'contrib', 'node_import', 'Node import', 'Development', '', 'a:1:{i:0;s:8:"date_api";}', '6', 0);
INSERT INTO `projects` VALUES(131, 'contrib', 'securepages', 'Secure Pages', 'Other', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(132, 'contrib', 'languageicons', 'Language icons', 'Other', '', NULL, '6', 0);
INSERT INTO `projects` VALUES(133, 'contrib', 'workflow', 'Workflow', 'Workflow', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(134, 'contrib', 'masquerade', 'Masquerade', 'Other', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(135, 'contrib', 'insert', 'Insert', 'Other', '', NULL, '6', 0);
INSERT INTO `projects` VALUES(136, 'contrib', 'feeds', 'Feeds', 'Other', '', NULL, '6', 0);
INSERT INTO `projects` VALUES(137, 'contrib', 'jcarousel', 'jCarousel', 'User', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(138, 'contrib', 'spamspan', 'SpamSpan filter', 'Other', '', NULL, '6', 0);
INSERT INTO `projects` VALUES(139, 'contrib', 'adsense', 'AdSense', 'Adsense', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(140, 'contrib', 'addthis', 'AddThis', 'Other', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(141, 'contrib', 'strongarm', 'Strongarm', 'Other', '', 'a:1:{i:0;s:8:""ctools"";}', '6', 0);
INSERT INTO `projects` VALUES(142, 'contrib', 'mimedetect', 'MimeDetect', 'Other', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(143, 'contrib', 'image_resize_filter', 'Image Resize Filter', 'Other', '', NULL, '6', 0);
INSERT INTO `projects` VALUES(144, 'contrib', 'pngfix', 'PNG Fix', 'Other', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(145, 'contrib', 'imagefield_crop', 'Imagefield Crop', 'CCK', '', 'a:2:{i:0;s:10:"imagefield";i:1;s:8:"imageapi";}', '6', 0);
INSERT INTO `projects` VALUES(146, 'contrib', 'ed_readmore', 'Read More Link (Drupal 6 and earlier)', 'Other', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(147, 'contrib', 'boost', 'Boost', 'Caching', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(148, 'contrib', 'checkbox_validate', 'Checkbox Validate', 'Other', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(149, 'contrib', 'tinymce', 'TinyMCE', 'Other', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(150, 'contrib', 'services', 'Services', 'Services', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(151, 'contrib', 'ldap_integration', 'LDAP integration', 'Other', '', NULL, '6', 0);
INSERT INTO `projects` VALUES(152, 'contrib', 'menu_attributes', 'Menu attributes', 'Other', '', NULL, '6', 0);
INSERT INTO `projects` VALUES(153, 'contrib', 'hierarchical_select', 'Hierarchical Select', 'Form', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(154, 'contrib', 'menu_per_role', 'Menu per Role', 'Other', '', 'a:1:{i:0;s:4:"menu";}', '6', 0);
INSERT INTO `projects` VALUES(155, 'contrib', 'marinelli', 'Marinelli', 'Other', '', NULL, '6', 0);
INSERT INTO `projects` VALUES(156, 'contrib', 'libraries', 'Libraries API', 'Other', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(157, 'contrib', 'node_export', 'Node export', 'Other', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(159, 'contrib', 'blocks404', '404 Blocks', 'Other', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(160, 'contrib', 'video', 'Video', 'Other', '', NULL, '6', 0);
INSERT INTO `projects` VALUES(161, 'contrib', 'phone', 'Phone (CCK)', 'CCK', '', 'a:1:{i:0;s:7:"content";}', '6', 0);
INSERT INTO `projects` VALUES(162, 'contrib', 'insert_view', 'Insert View', 'Views', '', 'a:1:{i:0;s:5:"views";}', '6', 0);
INSERT INTO `projects` VALUES(163, 'contrib', 'viewscarousel', 'Views carousel', 'Views', '', 'a:1:{i:0;s:5:"views";}', '6', 0);
INSERT INTO `projects` VALUES(164, 'contrib', 'taxonomy_image', 'Taxonomy Image', 'Taxonomy', '', 'a:1:{i:0;s:8:"taxonomy";}', '6', 0);
INSERT INTO `projects` VALUES(165, 'contrib', 'webformblock', 'Webform Block', 'Other', '', NULL, '6', 0);
INSERT INTO `projects` VALUES(166, 'contrib', 'ddblock', 'Dynamic display block', 'Other', '', 'a:1:{i:0;s:15:""jquery_update"";}', '6', 0);
INSERT INTO `projects` VALUES(167, 'contrib', 'autoload', 'Autoload', 'Other', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(169, 'contrib', 'signup', 'Signup', 'Signup', '', 'a:1:{i:0;s:5:"views";}', '6', 0);
INSERT INTO `projects` VALUES(170, 'contrib', 'ad', 'Advertisement', 'Ad', '', 'a:1:{i:0;s:8:"taxonomy";}', '6', 0);
INSERT INTO `projects` VALUES(171, 'contrib', 'forum_access', 'Forum Access', 'Other', '', NULL, '6', 0);
INSERT INTO `projects` VALUES(172, 'contrib', 'customerror', 'CustomError', 'Other', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(173, 'contrib', 'filefield_sources', 'FileField Sources', 'CCK', '', 'a:1:{i:0;s:9:"filefield";}', '6', 0);
INSERT INTO `projects` VALUES(174, 'contrib', 'install_profile_api', 'Install Profile API', 'Other', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(175, 'contrib', 'search_config', 'Search config', 'Other', '', 'a:1:{i:0;s:6:"search";}', '6', 0);
INSERT INTO `projects` VALUES(176, 'contrib', 'schema', 'Schema', 'Database', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(177, 'contrib', 'views_groupby', 'Views Group By', 'Views', '', 'a:1:{i:0;s:5:"views";}', '6', 0);
INSERT INTO `projects` VALUES(178, 'contrib', 'rootcandy', 'RootCandy', 'Other', '', NULL, '6', 0);
INSERT INTO `projects` VALUES(179, 'contrib', 'captcha_pack', 'CAPTCHA Pack', 'Other', '', NULL, '6', 0);
INSERT INTO `projects` VALUES(180, 'contrib', 'advanced_profile', 'Advanced Profile Kit', 'Other', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(181, 'contrib', 'markdown', 'Markdown filter', 'Other', '', NULL, '6', 0);
INSERT INTO `projects` VALUES(182, 'contrib', 'ajax', 'Ajax', 'Other', '', NULL, '6', 0);
INSERT INTO `projects` VALUES(183, 'contrib', 'conditional_fields', 'Conditional Fields', 'CCK', '', 'a:1:{i:0;s:7:"content";}', '6', 0);
INSERT INTO `projects` VALUES(184, 'contrib', 'modalframe', 'Modal Frame API', 'Modal', '', 'a:1:{i:0;s:9:"jquery_ui";}', '6', 0);
INSERT INTO `projects` VALUES(185, 'contrib', 'contact_forms', 'Contact Forms', 'Other', '', 'a:1:{i:0;s:7:"contact";}', '6', 0);
INSERT INTO `projects` VALUES(186, 'contrib', 'comment_upload', 'Comment Upload', 'Other', '', 'a:1:{i:0;s:6:"upload";}', '6', 0);
INSERT INTO `projects` VALUES(187, 'contrib', 'uc_views', 'Ubercart Views', 'Ubercart', '', 'a:3:{i:0;s:10:"uc_product";i:1;s:8:"uc_order";i:2;s:5:"views";}', '6', 0);
INSERT INTO `projects` VALUES(188, 'contrib', 'acquia_slate', 'Acquia Slate', 'Other', '', NULL, '6', 0);
INSERT INTO `projects` VALUES(189, 'contrib', 'linkchecker', 'Link checker', 'Other', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(190, 'contrib', 'realname', 'RealName', 'Other', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(191, 'contrib', 'acquia_prosper', 'Acquia Prosper', 'Other', '', NULL, '6', 0);
INSERT INTO `projects` VALUES(192, 'contrib', 'nodeaccess', 'Nodeaccess', 'Other', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(193, 'contrib', 'invite', 'Invite', 'Invite', '', 'a:1:{i:0;s:5:"token";}', '6', 0);
INSERT INTO `projects` VALUES(194, 'contrib', 'autoassignrole', 'Auto Assign Role', 'Other', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(195, 'contrib', 'media_youtube', 'Media: YouTube', 'Media', '', 'a:2:{i:0;s:7:"emfield";i:1;s:7:"emvideo";}', '6', 0);
INSERT INTO `projects` VALUES(196, 'contrib', 'viewfield', 'Viewfield', 'CCK', '', 'a:2:{i:0;s:5:"views";i:1;s:7:"content";}', '6', 0);
INSERT INTO `projects` VALUES(197, 'contrib', 'css_injector', 'CSS Injector', 'Other', '', NULL, '6', 0);
INSERT INTO `projects` VALUES(198, 'contrib', 'pixture_reloaded', 'Pixture Reloaded', 'Other', '', NULL, '6', 0);
INSERT INTO `projects` VALUES(199, 'contrib', 'rdf', 'Resource Description Framework (RDF)', 'RDF', '', 'a:0:{}', '6', 0);
INSERT INTO `projects` VALUES(200, 'contrib', 'drupalforfirebug', 'Drupal For Firebug', 'Other', '', NULL, '6', 0);
INSERT INTO `projects` VALUES(622, 'core', 'drupal', 'Drupal core', '', '', NULL, '7', 0);
INSERT INTO `projects` VALUES(623, 'contrib', 'views', 'Views', 'Views', '', 'a:1:{i:0;s:6:"ctools";}', '7', 0);
INSERT INTO `projects` VALUES(624, 'contrib', 'cck', 'Content Construction Kit (CCK)', 'CCK', '', NULL, '6', 1);

-- --------------------------------------------------------

--
-- Table structure for table `versions`
--

CREATE TABLE `versions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `version` varchar(255) NOT NULL,
  `release` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=968 ;

--
-- Dumping data for table `versions`
--

