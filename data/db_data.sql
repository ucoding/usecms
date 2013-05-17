/*
SQLyog Trial v10.12 
MySQL - 5.5.24-log : Database - duxcms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Data for the table `dc_admin` */

insert  into `dc_admin`(`id`,`gid`,`user`,`password`,`nicename`,`regtime`,`logintime`,`ip`,`status`,`loginnum`,`keep`) values (1,1,'admin','21232f297a57a5a743894a0e4a801fc3','admin',1350138971,1368784174,'127.0.0.1',1,111,1),(2,2,'user','e10adc3949ba59abbe56e057f20f883e','user',1368092341,1368173391,'127.0.0.1',1,12,0);

/*Data for the table `dc_admin_group` */

insert  into `dc_admin_group`(`id`,`name`,`model_power`,`class_power`,`status_power`,`grade`,`keep`) values (1,'超级管理员','1,4,2,31,21,22,23,6,12,14,15,234,9,5,26,29,16,30,11,24,27,28,236,237,238,239','',0,1,1),(2,'普通用户','2,31,22,6,12,14,15,234,9,5,29,16','',0,3,0);

/*Data for the table `dc_admin_menu` */

insert  into `dc_admin_menu`(`id`,`pid`,`name`,`module`,`status`) values (2,0,'内容','content',1),(5,1,'站点基本信息','setting',1),(6,0,'模块','expand',1),(27,30,'扩展模型','expand_model',1),(12,1,'片段','fragment',1),(236,30,'设置','dev_setting',1),(14,1,'TAG管理','tags',1),(15,1,'推荐位管理','position',1),(16,29,'附件管理','upload_file',1),(21,31,'角色管理','user_group',1),(22,31,'管理员管理','user',1),(26,1,'语言管理','lang',1),(1,0,'网站','category',1),(4,1,'栏目管理','category',1),(28,30,'表单管理','form',1),(31,0,'用户','user',1),(29,-1,'附件','upload_file',1),(30,0,'扩展','dev',1);

/*Data for the table `dc_category` */

insert  into `dc_category`(`cid`,`pid`,`mid`,`sequence`,`show`,`type`,`name`,`urlname`,`image`,`class_tpl`,`content_tpl`,`page`,`keywords`,`description`,`seo_content`,`lang`,`expand`) values (42,0,1,0,1,0,'1','1','','list.php','content.php',NULL,'','','',1,0),(43,42,1,0,1,1,'新闻','news','','list.php','content.php',NULL,'','','',1,0),(44,0,2,0,1,0,'1','page1',NULL,'page.php',NULL,NULL,NULL,NULL,NULL,1,NULL),(45,44,2,0,1,0,'page2','page2',NULL,'page.php',NULL,NULL,NULL,NULL,NULL,1,NULL),(46,44,2,0,1,0,'page3','page2755edbb0009f4fc554b3ce6d','','page.php',NULL,NULL,'','','',1,NULL),(47,44,2,0,1,0,'page4','page4','','page.php',NULL,NULL,'','','',1,NULL);

/*Data for the table `dc_category_jump` */

/*Data for the table `dc_category_page` */

insert  into `dc_category_page`(`id`,`cid`,`content`) values (1,44,NULL),(2,45,NULL),(3,46,''),(4,47,'');

/*Data for the table `dc_content` */

insert  into `dc_content`(`aid`,`cid`,`title`,`urltitle`,`keywords`,`description`,`updatetime`,`inputtime`,`image`,`url`,`sequence`,`tpl`,`status`,`copyfrom`,`views`,`position`,`taglink`) values (10196,43,'1','1',NULL,NULL,1368787126,1368787126,NULL,NULL,NULL,NULL,1,NULL,0,NULL,0),(10197,43,'1','1ac19b990ac41de991a48b348',NULL,NULL,1368787126,1368787126,NULL,NULL,NULL,NULL,1,NULL,0,NULL,0),(10198,43,'1','10d43da0082d7db67859b620f',NULL,NULL,1368787126,1368787126,NULL,NULL,NULL,NULL,1,NULL,0,NULL,0),(10199,43,'1','1d591c04a8823354ab5551df3',NULL,NULL,1368787126,1368787126,NULL,NULL,NULL,NULL,1,NULL,0,NULL,0),(10200,43,'1','11917cded53eda2bc74ac455e',NULL,NULL,1368787126,1368787126,NULL,NULL,NULL,NULL,1,NULL,0,NULL,0),(10201,43,'1','12ef99b9f31385bee1afb0e4b',NULL,NULL,1368787126,1368787126,NULL,NULL,NULL,NULL,1,NULL,2,NULL,0),(10202,43,'1','1ca4522b79bffcc8e6dea0b01',NULL,NULL,1368787126,1368787126,NULL,NULL,NULL,NULL,1,NULL,1,NULL,0),(10203,43,'1','1174956ca1386fcdceb768bfd',NULL,NULL,1368787126,1368787126,NULL,NULL,NULL,NULL,1,NULL,0,NULL,0),(10204,43,'1','1412882155e6ec15e9f5d92d9',NULL,NULL,1368787126,1368787126,NULL,NULL,NULL,NULL,1,NULL,0,NULL,0),(10205,43,'1','10c7387cea197246be9a314ab',NULL,NULL,1368787126,1368787126,NULL,NULL,NULL,NULL,1,NULL,0,NULL,0),(10206,43,'1','17f5a357957baaa73544269af',NULL,NULL,1368787126,1368787126,NULL,NULL,NULL,NULL,1,NULL,0,NULL,0),(10207,43,'1','1f2789979d37825dc197a829a',NULL,NULL,1368787126,1368787126,NULL,NULL,NULL,NULL,1,NULL,0,NULL,0),(10208,43,'1','152e6668fd736e6e5306e1a7e',NULL,NULL,1368787126,1368787126,NULL,NULL,NULL,NULL,1,NULL,0,NULL,0),(10209,43,'1','114d68bf3c91166a2b0b12ab5',NULL,NULL,1368787126,1368787126,NULL,NULL,NULL,NULL,1,NULL,0,NULL,0),(10210,43,'1','1452ba228362236fa7774cbbe',NULL,NULL,1368787126,1368787126,NULL,NULL,NULL,NULL,1,NULL,0,NULL,0),(10211,43,'1','159e511954131ee514f625b01',NULL,NULL,1368787126,1368787126,NULL,NULL,NULL,NULL,1,NULL,0,NULL,0),(10212,43,'1','1af3872afe9b4262b531c3499',NULL,NULL,1368787126,1368787126,NULL,NULL,NULL,NULL,1,NULL,1,NULL,0),(10213,43,'1','1d71e0212fd6f39736a53bdb3',NULL,NULL,1368787126,1368787126,NULL,NULL,NULL,NULL,1,NULL,0,NULL,0),(10214,43,'1','17b93b49d50c788a1836902e0',NULL,NULL,1368787126,1368787126,NULL,NULL,NULL,NULL,1,NULL,0,NULL,0),(10215,43,'1','18cc7fe19fc1b1b04ef08520d',NULL,NULL,1368787126,1368787126,NULL,NULL,NULL,NULL,1,NULL,1,NULL,0),(10216,43,'1','1b8b012b2a75dac49488a74c9',NULL,NULL,1368787126,1368787126,NULL,NULL,NULL,NULL,1,NULL,0,NULL,0),(10217,43,'1','1a11ec1352912832b0073e743',NULL,NULL,1368787126,1368787126,NULL,NULL,NULL,NULL,1,NULL,0,NULL,0),(10218,43,'1','1a5475efe8eea2124a40e2af5',NULL,NULL,1368787126,1368787126,NULL,NULL,NULL,NULL,1,NULL,1,NULL,0),(10219,43,'1','1d39cab215caf3e530911ffd7',NULL,NULL,1368787126,1368787126,NULL,NULL,NULL,NULL,1,NULL,0,NULL,0),(10220,43,'1','105af58a957f710e21614e5df',NULL,NULL,1368787126,1368787126,NULL,NULL,NULL,NULL,1,NULL,0,NULL,0),(10221,43,'1','113a3222ed3848c5478b3bd45',NULL,NULL,1368787126,1368787126,NULL,NULL,NULL,NULL,1,NULL,2,NULL,0),(10222,43,'1','1e566eab28326789ce1aced77',NULL,NULL,1368787126,1368787126,NULL,NULL,NULL,NULL,1,NULL,2,NULL,0),(10223,43,'1','1612a43b9d2dd67e2a8aa266c',NULL,NULL,1368787126,1368787126,NULL,NULL,NULL,NULL,1,NULL,0,NULL,0),(10224,43,'1','1407050fcbc372618daca3b70',NULL,NULL,1368787126,1368787126,NULL,NULL,NULL,NULL,1,NULL,0,NULL,0),(10225,43,'1','1b6f9a02d3e1a5758a71b406c',NULL,NULL,1368787126,1368787126,NULL,NULL,NULL,NULL,1,NULL,0,NULL,0),(10226,43,'1','147befc1c28011a02d6685cb9',NULL,NULL,1368787126,1368787126,NULL,NULL,NULL,NULL,1,NULL,0,NULL,0),(10227,43,'1','1c0865957c009ff629ad9a793',NULL,NULL,1368787126,1368787126,NULL,NULL,NULL,NULL,1,NULL,0,NULL,0),(10228,43,'1','136da315be8cebb7b3de31e71',NULL,NULL,1368787126,1368787126,NULL,NULL,NULL,NULL,1,NULL,0,NULL,0),(10229,43,'1','132b521d1ab80ace89b7e0173',NULL,NULL,1368787126,1368787126,NULL,NULL,NULL,NULL,1,NULL,0,NULL,0),(10230,43,'1','1b232edad6d9dbe0738ad8188',NULL,NULL,1368787126,1368787126,NULL,NULL,NULL,NULL,1,NULL,0,NULL,0),(10231,43,'1','169fb8e338e370ac2a5095199',NULL,NULL,1368787126,1368787126,NULL,NULL,NULL,NULL,1,NULL,0,NULL,0),(10232,43,'1','1f3499527f3bd8ef0e572be19',NULL,NULL,1368787126,1368787126,NULL,NULL,NULL,NULL,1,NULL,1,NULL,0);

/*Data for the table `dc_content_data` */

insert  into `dc_content_data`(`id`,`aid`,`content`) values (10196,10196,NULL),(10197,10197,'11111'),(10198,10198,'11111'),(10199,10199,'11111'),(10200,10200,'11111'),(10201,10201,'11111'),(10202,10202,'11111'),(10203,10203,'11111'),(10204,10204,'11111'),(10205,10205,'11111'),(10206,10206,'11111'),(10207,10207,'11111'),(10208,10208,'11111'),(10209,10209,'11111'),(10210,10210,'11111'),(10211,10211,'11111'),(10212,10212,'11111'),(10213,10213,'11111'),(10214,10214,'11111'),(10215,10215,'11111'),(10216,10216,'11111'),(10217,10217,'11111'),(10218,10218,'11111'),(10219,10219,'11111'),(10220,10220,'11111'),(10221,10221,'11111'),(10222,10222,'11111'),(10223,10223,'11111'),(10224,10224,'11111'),(10225,10225,'11111'),(10226,10226,'11111'),(10227,10227,'11111'),(10228,10228,'11111'),(10229,10229,'11111'),(10230,10230,'11111'),(10231,10231,'11111'),(10232,10232,'11111');

/*Data for the table `dc_expand_content_chanpin` */

insert  into `dc_expand_content_chanpin`(`id`,`aid`,`price`,`pattern`,`listpic`) values (1,19,'1880.00','SX240 HS','N;');

/*Data for the table `dc_expand_content_images` */

insert  into `dc_expand_content_images`(`id`,`aid`,`zutu`) values (26,45,'a:3:{i:0;a:3:{s:3:\"url\";s:55:\"/upload/2013-03-13/7209391df51cbedd0f0be0b36fcec06e.jpg\";s:5:\"title\";s:0:\"\";s:5:\"order\";s:1:\"0\";}i:1;a:3:{s:3:\"url\";s:55:\"/upload/2013-03-13/80c0701cad908aa7c40be0ea08d4d7f7.jpg\";s:5:\"title\";s:0:\"\";s:5:\"order\";s:1:\"0\";}i:2;a:3:{s:3:\"url\";s:55:\"/upload/2013-03-13/f9a85c173021cfb323eacc7388d9dec8.jpg\";s:5:\"title\";s:0:\"\";s:5:\"order\";s:1:\"0\";}}'),(27,66,'N;'),(28,67,'N;');

/*Data for the table `dc_expand_content_movie` */

/*Data for the table `dc_expand_model` */

insert  into `dc_expand_model`(`mid`,`table`,`name`) values (1,'chanpin','产品'),(3,'movie','视频');

/*Data for the table `dc_expand_model_field` */

insert  into `dc_expand_model_field`(`fid`,`mid`,`name`,`field`,`type`,`property`,`len`,`decimal`,`default`,`sequence`,`tip`,`must`,`config`) values (1,1,'价格','price',1,4,10,2,'',0,'',1,''),(2,1,'型号','pattern',1,1,250,0,NULL,0,NULL,1,NULL),(3,1,'产品图片','listpic',5,1,250,0,NULL,0,NULL,0,NULL);

/*Data for the table `dc_form` */

insert  into `dc_form`(`id`,`name`,`table`,`display`,`page`,`tpl`,`alone_tpl`,`order`,`where`) values (2,'留言板','guestbook',1,10,'guestbook.php',0,'id desc','status=1');

/*Data for the table `dc_form_data_guestbook` */

insert  into `dc_form_data_guestbook`(`id`,`name`,`email`,`content`,`time`,`http`,`reply`) values (3,'2','2','222',1368164075,NULL,NULL);

/*Data for the table `dc_form_field` */

insert  into `dc_form_field`(`id`,`fid`,`name`,`field`,`type`,`property`,`len`,`decimal`,`default`,`sequence`,`tip`,`config`,`must`,`admin_display`,`admin_html`) values (4,2,'昵称','name',1,1,250,0,'',1,'','',1,1,''),(5,2,'邮箱','email',1,1,250,0,'',2,'','',1,1,''),(6,2,'内容','content',3,3,0,0,'',3,'','',1,1,''),(7,2,'时间','time',7,2,10,0,'',4,'','',1,1,'echo date(\'Y-m-d H:i:s\',{content});'),(12,2,'网址','http',1,1,250,0,'',0,'','',0,0,''),(13,2,'管理员回复','reply',2,3,0,0,'',0,'','',0,0,'');

/*Data for the table `dc_fragment` */

insert  into `dc_fragment`(`id`,`content`,`title`,`sign`) values (1,'欢迎使用DUXCMS网站管理系统，DUXCMS是一款针对中小企业所开发的专业网站管理系统。&lt;br /&gt;\n进入后台请在网之后加admin,后台默认帐号密码均为:admin&lt;br /&gt;\n网站上线后请更改后台密码以免影响您的安全','简介','info'),(2,'版权所有：&lt;a href=&quot;http://www.duxcms.com&quot; target=&quot;_blank&quot;&gt;DUXCMS&lt;/a&gt; 地址：中国.独享网络小组 电话：+86-000000000 &amp;nbsp;传真：\n+86-0000000','底部信息','dibu'),(3,'&lt;img src=&quot;/duxcms/upload/2013-05/10/logo-0f774.gif&quot; title=&quot;logo&quot; alt=&quot;logo&quot; /&gt;','LOGO','logo');

/*Data for the table `dc_lang` */

insert  into `dc_lang`(`id`,`name`,`lang`,`protection`) values (1,'中文','zh',1),(2,'english','en',0);

/*Data for the table `dc_model` */

insert  into `dc_model`(`mid`,`model`,`name`,`admin_category`,`admin_content`,`module_category`,`module_content`,`url_category`,`url_category_page`,`url_content`,`url_content_page`,`table`,`file`,`config`) values (1,'content','内容','content_category','content','category','content','{CDIR}','{CDIR}_{P}{EXT}','{CDIR}/{AID}{EXT}','{CDIR}/{AID}-{P}{EXT}',NULL,NULL,NULL),(3,'jump','超链接','jump_category',NULL,'jump',NULL,'{CDIR}',NULL,NULL,NULL,NULL,NULL,NULL),(2,'pages','页面','pages_category',NULL,'pages',NULL,'{CDIR}{EXT}',NULL,NULL,NULL,NULL,NULL,NULL);

/*Data for the table `dc_position` */

insert  into `dc_position`(`id`,`name`,`sequence`) values (1,'首页推荐',1),(3,'首页幻灯片',0),(4,'栏目推荐',0);

/*Data for the table `dc_position_relation` */

insert  into `dc_position_relation`(`aid`,`pid`) values (43,4),(45,3),(11,3),(13,3),(16,3),(17,3),(18,3),(18,1),(8,1),(6,1),(2,1),(4,1),(14,1),(5,4),(3,1),(4250,3),(4250,1);

/*Data for the table `dc_replace` */

/*Data for the table `dc_tags` */

/*Data for the table `dc_tags_relation` */

/*Data for the table `dc_upload` */

/*Data for the table `dc_upload_category` */

/*Data for the table `dc_upload_content` */

/*Data for the table `dc_upload_form` */

/*Data for the table `dc_upload_plus` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
