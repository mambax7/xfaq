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
if (!defined('XOOPS_ROOT_PATH')) {
    die('XOOPS root path not defined'); 
	}
$moduleDirName = basename( dirname( __FILE__ ) ) ;

	$modversion["name"] = "xfaq";
	$modversion["version"] = 1.01;
	$modversion["description"] = "XOOPS FAQ";
	$modversion["author"] = "Mojtaba Jamali";
	$modversion["author_website_url"] = "http://mydolphin.ir";
	$modversion["author_website_name"] = "";
	$modversion["credits"] = "Voltan, Mamba";
    $modversion['license'] = 'GNU GPL 2.0';
    $modversion['license_url'] = "www.gnu.org/licenses/gpl-2.0.html/";
	$modversion["release_info"] = "";
	$modversion["release_file"] = "";
	$modversion["manual"] = "";
	$modversion["manual_file"] = "";
	$modversion["image"] = "images/xfaqLogo.png";
	$modversion["dirname"] = "xfaq";
    $modversion['help'] = 'page=help';	

	//about
	$modversion["demo_site_url"] = "";
	$modversion["demo_site_name"] = "";
	$modversion['module_website_url'] = "http://xoops.org";
	$modversion['module_website_name'] = "XOOPS";
	$modversion["release"] = "0";
	$modversion["module_status"] = "Beta";
	$modversion["author_website_url"] = "http://mydolphin.ir";
	$modversion["author_website_name"] = "MyDolphin";
    $modversion['release_date']     = '2011/03/22';	
    $modversion['min_php']='5.2';
    $modversion['min_xoops']="2.5";
	
	
	//Installation	
	$modversion['onInstall'] = 'include/install.php';

	
	// Admin things
	$modversion["hasAdmin"] = 1;
	$modversion['system_menu'] = 1;
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
	$i = 1;
	$modversion['templates'][$i]['file'] = 'xfaq_index.html';
	$modversion['templates'][$i]['description'] = '';
	$i++;
	$modversion['templates'][$i]['file'] = 'xfaq_request.html';
	$modversion['templates'][$i]['description'] = '';
	$i++;
	$modversion['templates'][$i]['file'] = 'xfaq_faq.html';
	$modversion['templates'][$i]['description'] = '';

	
?>