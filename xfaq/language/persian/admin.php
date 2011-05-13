<?php
/**
 * ****************************************************************************
 * Module généré par TDMCreate de la TDM "http://www.tdmxoops.net"
 * ****************************************************************************
 * xfaq - a simple module for Frequently Asked Questions
 * Copyright (c) Mojtaba Jamali (http://mydolphin.ir)
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       Mojtaba Jamali (http://mydolphin.ir)
 * @license         GPL
 * @package         xfaq
 * @author 			Mojtaba Jamali (http://mydolphin.ir)
 *
 * Version : 1.00:
 * ****************************************************************************
 */
 	
//Menu
define("_AM_XFAQ_THEREARE_TOPIC","تعداد <span style=\"color: #ff0000; font-weight: bold\">%s</span> شاخه در بانک اطلاعات وجود دارد.");
define("_AM_XFAQ_THEREARE_TOPIC_ONLINE","تعداد <span style='color: #ff0000; font-weight: bold'>%s</span> شاخه فعال  در بانک اطلاعات وجود دارد.");
define("_AM_XFAQ_THEREARE_FAQ","تعداد <span style=\"color: #ff0000; font-weight: bold\">%s</span> پرسش  در بانک اطلاعات وجود دارد.");
define("_AM_XFAQ_THEREARE_FAQ_ONLINE","تعداد <span style='color: #ff0000; font-weight: bold'>%s</span> پرسش بدون پاسخ  در بانک اطلاعات وجود دارد.");

//General
define("_AM_XFAQ_FORMOK","اطلاعات با موفقيت ذخيره شد.");
define("_AM_XFAQ_FORMDELOK","اطلاعات با موفقيت حذف شد");
define("_AM_XFAQ_FORMSUREDEL", "آيا از حذف اين رکورد اطمينان داريد؟ : <b><span style=\"color : Red\"> %s </span></b>");
define("_AM_XFAQ_FORMSURERENEW", "Etes-vous s&ucirc;r de vouloir renevouler : <b><span style=\"color : Red\"> %s </span></b>");
define("_AM_XFAQ_FORMUPLOAD","بارگزاري");
define("_AM_XFAQ_FORMIMAGE_PATH","مسير تصوير %s");
define("_AM_XFAQ_FORMACTION","عمل");
define("_AM_XFAQ_OFF","غيرفعال");
define("_AM_XFAQ_ON","فعال");
define("_AM_XFAQ_EDIT","ويرايش");
define("_AM_XFAQ_DELETE","حذف");
define("_AM_XFAQ_TOPIC_ADD","افزودن شاخه جديد");
define("_AM_XFAQ_TOPIC_EDIT","ويرايش شاخه");
define("_AM_XFAQ_TOPIC_ID","شناسه");
define("_AM_XFAQ_TOPIC_PID","والد");
define("_AM_XFAQ_TOPIC_TITLE","عنوان");
define("_AM_XFAQ_TOPIC_DESC","شرح");
define("_AM_XFAQ_TOPIC_IMG","تصوير");
define("_AM_XFAQ_TOPIC_WEIGHT","اولويت");
define("_AM_XFAQ_TOPIC_SUBMITTER","ارسال کنندي");
define("_AM_XFAQ_TOPIC_DATE_CREATED","تاريخ شاخت");
define("_AM_XFAQ_TOPIC_ONLINE","آنلاين");
define("_AM_XFAQ_FAQ_NO_TOPIC","شاخه‌اي براي شما جهت ارسال وجود ندارد.");

define("_AM_XFAQ_FAQ_ADD","افزودن پرسش جديد");
define("_AM_XFAQ_FAQ_EDIT","ويرايش پرسش");
define("_AM_XFAQ_FAQ_DELETE","حذف پرسش");
define("_AM_XFAQ_FAQ_ID","شناسه");
define("_AM_XFAQ_FAQ_QUESTION","سوال");
define("_AM_XFAQ_FAQ_ANSWER","پاسخ");
define("_AM_XFAQ_FAQ_TOPIC","شاخه");
define("_AM_XFAQ_FAQ_URL","جانشين آدرس");
define("_AM_XFAQ_FAQ_OPEN","باز");
define("_AM_XFAQ_FAQ_ANSUSER","پاسخ دهنده");
define("_AM_XFAQ_FAQ_SUBMITTER","ارسال کننده");
define("_AM_XFAQ_FAQ_DATE_CREATED","تاريخ");
define("_AM_XFAQ_FAQ_ONLINE","آنلاين");
define("_AM_XFAQ_FAQ_USER_FAQ","پرسش‌هاي شما");
define("_AM_XFAQ_FAQ_USER_FAQ","شما به اين قسمت دسترسي نداريد.<br/>لطفا عضو شويد!");
define("_AM_XFAQ_FAQ_NO_ANSWER","تا کنون جوابي براي اين سوال ارسال نشده است!");

//Blocks.php
define("_AM_XFAQ_TOPIC_BLOCK_DAY","topics d'aujourdh'ui");
define("_AM_XFAQ_TOPIC_BLOCK_RANDOM","topics aleatoires");
define("_AM_XFAQ_TOPIC_BLOCK_RECENT","topics recents");
define("_AM_XFAQ_FAQ_BLOCK_DAY","faqs d'aujourdh'ui");
define("_AM_XFAQ_FAQ_BLOCK_RANDOM","faqs aleatoires");
define("_AM_XFAQ_FAQ_BLOCK_RECENT","faqs recents");

//Permissions
define("_AM_XFAQ_PERMISSIONS_ACCESS","دسترسي براي نمايش");
define("_AM_XFAQ_PERMISSIONS_SUBMIT","دسترسي براي ارسال سوال");

//About.php
define("_AM_XFAQ_ABOUT_RELEASEDATE","Release Date");
define("_AM_XFAQ_ABOUT_AUTHOR","Author");
define("_AM_XFAQ_ABOUT_CREDITS","Crédits");
define("_AM_XFAQ_ABOUT_README","Générale Information");
define("_AM_XFAQ_ABOUT_MANUAL","Aide");
define("_AM_XFAQ_ABOUT_LICENSE","Licence");
define("_AM_XFAQ_ABOUT_MODULE_STATUS","Status");
define("_AM_XFAQ_ABOUT_WEBSITE","Web Site");
define("_AM_XFAQ_ABOUT_AUTHOR_NAME","Author Name");
define("_AM_XFAQ_ABOUT_AUTHOR_WORD","Author Word");
define("_AM_XFAQ_ABOUT_CHANGELOG","Change Log");
define("_AM_XFAQ_ABOUT_MODULE_INFO","Module Info");
define("_AM_XFAQ_ABOUT_AUTHOR_INFO","Author Info");
define("_AM_XFAQ_ABOUT_DISCLAIMER","Disclaimer");
define("_AM_XFAQ_ABOUT_DISCLAIMER_TEXT","GPL Licensed - No Warranty");
	
?>