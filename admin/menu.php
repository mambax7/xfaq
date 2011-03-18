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
 
$adminmenu = array(); 
$i = 0;
$adminmenu[$i]["title"] = _MI_XFAQ_MANAGER_INDEX;
$adminmenu[$i]["link"] = "admin/index.php";
$adminmenu[$i]["icon"] = "images/icons/home.png";
$i++;
$adminmenu[$i]["title"] = _MI_XFAQ_MANAGER_TOPIC;
$adminmenu[$i]["link"] = "admin/topic.php";
$adminmenu[$i]["icon"] = "images/icons/category.png";
$i++;
$adminmenu[$i]["title"] = _MI_XFAQ_MANAGER_FAQ;
$adminmenu[$i]["link"] = "admin/faq.php";
$adminmenu[$i]["icon"] = "images/icons/xfaq.png";
$i++;
$adminmenu[$i]["title"] = _MI_XFAQ_MANAGER_PERMISSIONS;
$adminmenu[$i]["link"] = "admin/permissions.php";
$adminmenu[$i]["icon"] = "images/icons/permissions.png";

$i++;
$adminmenu[$i]["title"] = _MI_XFAQ_ADMIN_ABOUT;
$adminmenu[$i]["link"]  = "admin/about.php";
//$adminmenu[$i]["desc"] = _AM_XFAQ_ADMIN_ABOUT_DESC;
$adminmenu[$i]["icon"] = "images/icons/about.png";
$i++;
$adminmenu[$i]["title"] = _MI_XFAQ_ADMIN_HELP;
$adminmenu[$i]["link"]  = "admin/help.php";
//$adminmenu[$i]["desc"] = _AM_XFAQ_ADMIN_HELP_DESC;
$adminmenu[$i]["icon"] = "images/icons/help.png";


?>