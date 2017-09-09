<?php
/**
 * ****************************************************************************
 * Module g�n�r� par TDMCreate de la TDM "http://www.tdmxoops.net"
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
 * @author          Mojtaba Jamali (http://mydolphin.ir)
 *
 * Version : 1.00:
 * ****************************************************************************
 */

use Xmf\Module\Admin;
use Xmf\Module\Helper;

// defined('XOOPS_ROOT_PATH') || exit('Restricted access.');

//$path = dirname(dirname(dirname(__DIR__)));
//require_once $path . '/mainfile.php';

$moduleDirName = basename(dirname(__DIR__));

if (false !== ($moduleHelper = Helper::getHelper($moduleDirName))) {
} else {
    $moduleHelper = Helper::getHelper('system');
}
$pathIcon32    = Admin::menuIconPath('');
$pathModIcon32 = $moduleHelper->getModule()->getInfo('modicons32');

xoops_loadLanguage('modinfo', $moduleDirName);

$adminmenu[] = [
    'title' => _MI_XFAQ_MANAGER_INDEX,
    'link'  => 'admin/index.php',
    'icon'  => 'assets/images/admin/home.png',
];

$adminmenu[] = [
    'title' => _MI_XFAQ_MANAGER_TOPIC,
    'link'  => 'admin/topic.php',
    'icon'  => 'assets/images/admin/category.png',
];

$adminmenu[] = [
    'title' => _MI_XFAQ_MANAGER_FAQ,
    'link'  => 'admin/faq.php',
    'icon'  => 'assets/images/admin/xfaq.png',
];

$adminmenu[] = [
    'title' => _MI_XFAQ_MANAGER_PERMISSIONS,
    'link'  => 'admin/permissions.php',
    'icon'  => 'assets/images/admin/permissions.png',
];

$adminmenu[] = [
    'title' => _MI_XFAQ_ADMIN_ABOUT,
    'link'  => 'admin/about.php',
    'icon'  => 'assets/images/admin/about.png',
];
