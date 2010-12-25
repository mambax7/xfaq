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
	//$modversion["onUpdate"] = "include/update.php";// Menu
	$modversion["hasMain"] = 1;
	$modversion['sub'][1]['name'] = _MI_XFAQ_REQUEST;
	$modversion['sub'][1]['url'] = "request.php";
	$modversion['sub'][2]['name'] = _MI_XFAQ_USER_FAQ;
	$modversion['sub'][2]['url'] = "request.php?op=myFaq";
	
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
	/*
	//Blocs
	$i = 1;
			$modversion["blocks"][$i]["file"] = "blocks_faq.php";
			$modversion["blocks"][$i]["name"] = _MI_XFAQ_FAQ_BLOCK_RECENT;
			$modversion["blocks"][$i]["description"] = "";
			$modversion["blocks"][$i]["show_func"] = "b_xfaq_faq";
			$modversion["blocks"][$i]["edit_func"] = "b_xfaq_faq_edit";
			$modversion["blocks"][$i]["options"] = "recent|5|25|0";
			$modversion["blocks"][$i]["template"] = "xfaq_faq_block_recent.html";
			$i++;
			$modversion["blocks"][$i]["file"] = "blocks_faq.php";
			$modversion["blocks"][$i]["name"] = _MI_XFAQ_FAQ_BLOCK_DAY;
			$modversion["blocks"][$i]["description"] = "";
			$modversion["blocks"][$i]["show_func"] = "b_xfaq_faq";
			$modversion["blocks"][$i]["edit_func"] = "b_xfaq_faq_edit";
			$modversion["blocks"][$i]["options"] = "day|5|25|0";
			$modversion["blocks"][$i]["template"] = "xfaq_faq_block_day.html";
			$i++;
			$modversion["blocks"][$i]["file"] = "blocks_faq.php";
			$modversion["blocks"][$i]["name"] = _MI_XFAQ_FAQ_BLOCK_RANDOM;
			$modversion["blocks"][$i]["description"] = "";
			$modversion["blocks"][$i]["show_func"] = "b_xfaq_faq";
			$modversion["blocks"][$i]["edit_func"] = "b_xfaq_faq_edit";
			$modversion["blocks"][$i]["options"] = "random|5|25|0";
			$modversion["blocks"][$i]["template"] = "xfaq_faq_block_random.html";
			$i++;	
	*/
	//templates
	$modversion['templates'][1]['file'] = 'xfaq_index.html';
	$modversion['templates'][1]['description'] = '';
	$modversion['templates'][2]['file'] = 'xfaq_request.html';
	$modversion['templates'][2]['description'] = '';
?>