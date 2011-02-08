<?php
/**
 * ****************************************************************************
 * Module généré par TDMCreate de la TDM "http://www.tdmxoops.net"
 * ****************************************************************************
 * xfaq - MODULE FOR XOOPS AND IMPRESS CMS
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
 * @license         Dolphin
 * @package         xfaq
 * @author 			Mojtaba Jamali (http://mydolphin.ir)
 *
 * Version : 1.00:
 * ****************************************************************************
 */
 
	
	$modversion["name"] = "xfaq";
	$modversion["version"] = 1.00;
	$modversion["description"] = "XOOPS FAQ";
	$modversion["author"] = "Mojtaba Jamali";
	$modversion["author_website_url"] = "http://mydolphin.ir";
	$modversion["author_website_name"] = "";
	$modversion["credits"] = "";
	$modversion["license"] = "GPL";
	$modversion["release_info"] = "";
	$modversion["release_file"] = "";
	$modversion["manual"] = "";
	$modversion["manual_file"] = "";
	$modversion["image"] = "images/xfaqLogo.png";
	$modversion["dirname"] = "xfaq";

	//about
	$modversion["demo_site_url"] = "";
	$modversion["demo_site_name"] = "";
	$modversion["module_website_url"] = "";
	$modversion["module_website_name"] = "";
	$modversion["release"] = "0";
	$modversion["module_status"] = "";
	
	// Admin things
	$modversion["hasAdmin"] = 1;
	
	$modversion["adminindex"] = "admin/index.php";
	$modversion["adminmenu"] = "admin/menu.php";
	
	
	// Mysql file
	$modversion["sqlfile"]["mysql"] = "sql/mysql.sql";

	// Tables
	$modversion["tables"][0] = "xfaq_topic";
	$modversion["tables"][1] = "xfaq_faq";
	
	
	// Scripts to run upon installation or update
	//$modversion["onInstall"] = "include/install.php";
	//$modversion["onUpdate"] = "include/update.php";
	
	// Menu
	$modversion["hasMain"] = 1;
	$modversion['sub'][1]['name'] = _MI_XFAQ_REQUEST;
	$modversion['sub'][1]['url'] = "request.php";
	$modversion['sub'][2]['name'] = _MI_XFAQ_REQUEST_PRIVACY;
	$modversion['sub'][2]['url'] = "request.php?op=privacyfaq";
	$modversion['sub'][3]['name'] = _MI_XFAQ_USER_ASKEDFAQ;
	$modversion['sub'][3]['url'] = "request.php?op=myaskedfaq";
	$modversion['sub'][4]['name'] = _MI_XFAQ_USER_ANSWEREDFAQ;
	$modversion['sub'][4]['url'] = "request.php?op=myansweredfaq";
	$modversion['sub'][5]['name'] = _MI_XFAQ_USER_ANSWERED;
	$modversion['sub'][5]['url'] = "request.php?op=answeredfaq";
	
	//Recherche
	$modversion["hasSearch"] = 1;
	$modversion["search"]["file"] = "include/search.inc.php";
	$modversion["search"]["func"] = "xfaq_search";
	
	
	$i = 1;
	include_once XOOPS_ROOT_PATH . "/class/xoopslists.php";
	$modversion["config"][$i]["name"]        = "xfaq_editor";
	$modversion["config"][$i]["title"]       = "_MI_XFAQ_EDITOR";
	$modversion["config"][$i]["description"] = "";
	$modversion["config"][$i]["formtype"]    = "select";
	$modversion["config"][$i]["valuetype"]   = "text";
	$modversion["config"][$i]["default"]     = "dhtmltextarea";
	$modversion["config"][$i]["options"]     = XoopsLists::getDirListAsArray(XOOPS_ROOT_PATH . "/class/xoopseditor");
	$modversion["config"][$i]["category"]    = "global";
	$i++;
	$modversion['config'][$i]['name']        = 'xfaqtag';
	$modversion['config'][$i]['title']       = '_MI_XFAQ_USE_TAG';
	$modversion['config'][$i]['description'] = '_MI_XFAQ_USE_TAG_DSC';
	$modversion['config'][$i]['formtype']    = 'yesno';
	$modversion['config'][$i]['valuetype']   = 'int';
	$modversion['config'][$i]['default']     = 0;
	$i++;
	$modversion["config"][$i]["name"] = "img_size";
	$modversion["config"][$i]["title"] = "_MI_XFAQ_IMG_SIZE";
	$modversion["config"][$i]["description"] = "_MI_XFAQ_IMG_SIZE_DESC";
	$modversion["config"][$i]["formtype"] = "textbox";
	$modversion["config"][$i]["valuetype"] = "int";
	$modversion["config"][$i]["default"] = 10485760;
	$i++;
	$modversion["config"][$i]["name"] = "img_mimetypes";
	$modversion["config"][$i]["title"] = "_MI_XFAQ_IMG_MIMETYPES";
	$modversion["config"][$i]["description"] = "_MI_XFAQ_IMG_MIMETYPES_DESC";
	$modversion["config"][$i]["formtype"] = "select_multi";
	$modversion["config"][$i]["valuetype"] = "array";
	$modversion["config"][$i]["default"] = array("image/gif", "image/jpeg", "image/png");
	$modversion["config"][$i]["options"] = array("bmp" => "image/bmp", "gif" => "image/gif", "jpeg" => "image/pjpeg", "jpeg" => "image/jpeg", "jpg" => "image/jpeg", "jpe" => "image/jpeg", "png" => "image/png");
	$i++;
	$modversion["config"][$i]["name"] = "numcolumn";
	$modversion["config"][$i]["title"] = "_MI_XFAQ_NUMCOLUME";
	$modversion["config"][$i]["description"] = "_MI_XFAQ_NUMCOLUME_DESC";	
	$modversion["config"][$i]["formtype"] = "textbox";
	$modversion["config"][$i]["valuetype"] = "int";
	$modversion["config"][$i]["default"] = 2;
	$i++;
	$modversion['config'][$i]['name'] = 'itemperpage';
	$modversion['config'][$i]['title'] = '_MI_XFAQ_PERPAGE';
	$modversion['config'][$i]['description'] = '_MI_XFAQ_PERPAGEEDSC';
	$modversion['config'][$i]['formtype'] = 'textbox';
	$modversion['config'][$i]['valuetype'] = 'int';
	$modversion['config'][$i]['default'] = 10;
	$i++;
	$modversion['config'][$i]['name'] = 'itemperadmin';
	$modversion['config'][$i]['title'] = '_MI_XFAQ_PERADMIN';
	$modversion['config'][$i]['description'] = '_MI_XFAQ_PERADMINEDSC';
	$modversion['config'][$i]['formtype'] = 'textbox';
	$modversion['config'][$i]['valuetype'] = 'int';
	$modversion['config'][$i]['default'] = 10;
	$i++;
	$modversion['config'][$i]['name'] = 'topicperadmin';
	$modversion['config'][$i]['title'] = '_MI_XFAQ_TOPICPERADMIN';
	$modversion['config'][$i]['description'] = '_MI_XFAQ_TOPICPERADMINEDSC';
	$modversion['config'][$i]['formtype'] = 'textbox';
	$modversion['config'][$i]['valuetype'] = 'int';
	$modversion['config'][$i]['default'] = 10;
	$i++;


	//templates
	$modversion['templates'][1]['file'] = 'xfaq_index.html';
	$modversion['templates'][1]['description'] = '';
	$modversion['templates'][2]['file'] = 'xfaq_request.html';
	$modversion['templates'][2]['description'] = '';
	$modversion['templates'][3]['file'] = 'xfaq_faq.html';
	$modversion['templates'][3]['description'] = '';
?>