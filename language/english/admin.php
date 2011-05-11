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
if (!defined('XOOPS_ROOT_PATH')) { exit(); } 

global $xoopsModule;	
//Menu
//define("_AM_XFAQ_MANAGER_INDEX","Home");

define("_AM_XFAQ_THEREARE_TOPIC","There are <span style=\"color: #ff0000; font-weight: bold\">%s</span> Topics in the Database");
define("_AM_XFAQ_THEREARE_TOPIC_ONLINE","There are <span style='color: #ff0000; font-weight: bold'>%s</span> pending Topics");
define("_AM_XFAQ_THEREARE_FAQ","There are <span style=\"color: #ff0000; font-weight: bold\">%s</span> Questions in the Database");
define("_AM_XFAQ_THEREARE_FAQ_ONLINE","There are <span style='color: #ff0000; font-weight: bold'>%s</span> pending Questions");

//define("_AM_XFAQ_MANAGER_ABOUT","About");
//define("_AM_XFAQ_MANAGER_PREFERENCES","Preferences");
//define("_AM_XFAQ_MANAGER_UPDATE","Update");
//define("_AM_XFAQ_MANAGER_PERMISSIONS","Permissions");

//Index
define("_AM_XFAQ_MANAGER_TOPIC","Topics");
define("_AM_XFAQ_MANAGER_FAQ","FAQ");


//General
define("_AM_XFAQ_FORMOK","Saved successfully");
define("_AM_XFAQ_FORMDELOK","Deleted successfully");
define("_AM_XFAQ_FORMSUREDEL", "Are you sure you want to delete: <b><span style=\"color : Red\"> %s </span></b>");
define("_AM_XFAQ_FORMSURERENEW", "Are you sure you want update: <b><span style=\"color : Red\"> %s </span></b>");
define("_AM_XFAQ_FORMUPLOAD","Upload");
define("_AM_XFAQ_FORMIMAGE_PATH","File in %s");
define("_AM_XFAQ_FORMACTION","Action");
define("_AM_XFAQ_OFF","Off");
define("_AM_XFAQ_ON","Approved");
define("_AM_XFAQ_EDIT","Edit");
define("_AM_XFAQ_DELETE","Delete");
define("_AM_XFAQ_TOPIC_ADD","Add new topic");
define("_AM_XFAQ_TOPIC_EDIT","Edit topic");
define("_AM_XFAQ_TOPIC_ID","Id");
define("_AM_XFAQ_TOPIC_PID","Parent");
define("_AM_XFAQ_TOPIC_TITLE","Title");
define("_AM_XFAQ_TOPIC_DESC","Description");
define("_AM_XFAQ_TOPIC_IMG","Image");
define("_AM_XFAQ_TOPIC_WEIGHT","Weight");
define("_AM_XFAQ_TOPIC_SUBMITTER","Submitter");
define("_AM_XFAQ_TOPIC_DATE_CREATED","Date_created");
define("_AM_XFAQ_TOPIC_ONLINE","Online");
define("_AM_XFAQ_FAQ_NO_TOPIC","No topic exist for you to add questions.");

define("_AM_XFAQ_FAQ_ADD","Add new FAQ");
define("_AM_XFAQ_FAQ_PRIVACY","Add Priacy FAQ");
define("_AM_XFAQ_FAQ_EDIT","Edit Question");
define("_AM_XFAQ_FAQ_DELETE","Delete Question");
define("_AM_XFAQ_FAQ_ID","Id");
define("_AM_XFAQ_FAQ_QUESTION","Question");
define("_AM_XFAQ_FAQ_ANSWER","Answer");
define("_AM_XFAQ_FAQ_TOPIC","Topic");
define("_AM_XFAQ_FAQ_URL","URL");
define("_AM_XFAQ_FAQ_OPEN","status");
define("_AM_XFAQ_FAQ_OPEN1","Asked");
define("_AM_XFAQ_FAQ_OPEN2","Answered - close");
define("_AM_XFAQ_FAQ_OPEN3","Answered - Open");
define("_AM_XFAQ_FAQ_OPEN4","Privacy");
define("_AM_XFAQ_FAQ_OPEN5","Answered by users");
define("_AM_XFAQ_FAQ_ANSUSER","Answered");
define("_AM_XFAQ_FAQ_SUBMITTER","Submitted");
define("_AM_XFAQ_FAQ_DATE_CREATED","Date created");
define("_AM_XFAQ_FAQ_ONLINE","Online");
define("_AM_XFAQ_FAQ_USER_FAQ","Your FAQs");
//define("_AM_XFAQ_FAQ_USER_FAQ","You don't have permission to access this area.<br/>Please login!");
define("_AM_XFAQ_FAQ_NO_ANSWER","There are no answer for this question until now!");
define("_AM_XFAQ_FAQ_DATE_ANSWER","Date answered");
define("_AM_XFAQ_FAQ_WEIGHT","Weight");
define("_AM_XFAQ_FAQ_METAKEY","Meta Keywords");
define("_AM_XFAQ_FAQ_METADESC","Meta Description");
define("_AM_XFAQ_FAQ_HOWDOI","How do I");
define("_AM_XFAQ_FAQ_DIDUNO","Did You Know?");	

//Blocks.php
define("_AM_XFAQ_TOPIC_BLOCK_DAY","Today's Topics");
define("_AM_XFAQ_TOPIC_BLOCK_RANDOM","Random Topics");
define("_AM_XFAQ_TOPIC_BLOCK_RECENT","Recent Topics");
define("_AM_XFAQ_FAQ_BLOCK_DAY","Today's FAQ");
define("_AM_XFAQ_FAQ_BLOCK_RANDOM","Random FAQ");
define("_AM_XFAQ_FAQ_BLOCK_RECENT","Recent FAQ");

//Permissions
define("_AM_XFAQ_PERMISSIONS_ACCESS","Permission for view");
define("_AM_XFAQ_PERMISSIONS_SUBMIT","Permission for submit");

//About.php
define("_AM_XFAQ_ABOUT_RELEASEDATE","Released:");
define("_AM_XFAQ_ABOUT_UPDATEDATE","Updated:");
define("_AM_XFAQ_ABOUT_AUTHOR","Author");
define("_AM_XFAQ_ABOUT_CREDITS","Credits");
define("_AM_XFAQ_ABOUT_README","General Information");
define("_AM_XFAQ_ABOUT_MANUAL","Manual");
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
define("_AM_XFAQ_ABOUT_DESCRIPTION",          "Description: ");

// text in admin footer
define("_AM_XFAQ_ADMIN_FOOTER", "<div class='right smallsmall italic pad5'><b>" . $xoopsModule->getVar("name") . "</b> is maintained by the <a class='tooltip' rel='external' href='http://xoops.org/' title='Visit XOOPS Community'>XOOPS Community</a></div>");

define('_XFAQ_ADMIN_'," "); //

define("_AM_XFAQ_NOPERMSSET", "Permission cannot be set : No Topics created yet! Please create a Topic first.");

// Configuration
define("_AM_XFAQ_CONFIG_CHECK","Configuration Check");
define("_AM_XFAQ_CONFIG_PHP","Minimum PHP required: %s (your version is %s)");
define("_AM_XFAQ_CONFIG_XOOPS","Minimum XOOPS required:  %s (your version is %s)");
?>