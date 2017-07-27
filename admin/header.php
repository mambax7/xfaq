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

include __DIR__ . '/../../../include/cp_header.php';

require_once XOOPS_ROOT_PATH . '/kernel/module.php';
require_once XOOPS_ROOT_PATH . '/class/xoopstree.php';
require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
require_once XOOPS_ROOT_PATH . '/class/tree.php';
require_once XOOPS_ROOT_PATH . '/class/xoopslists.php';
require_once XOOPS_ROOT_PATH . '/class/pagenav.php';
require_once XOOPS_ROOT_PATH . '/class/xoopstopic.php';
require_once XOOPS_ROOT_PATH . '/class/xoopsform/grouppermform.php';

//include once XOOPS_ROOT_PATH."include/cp_header.php";
$pathIcon16           = $GLOBALS['xoops']->url('www/' . $GLOBALS['xoopsModule']->getInfo('sysicons16'));
$pathIcon32           = $GLOBALS['xoops']->url('www/' . $GLOBALS['xoopsModule']->getInfo('sysicons32'));
$xoopsModuleAdminPath = $GLOBALS['xoops']->path('www/' . $GLOBALS['xoopsModule']->getInfo('dirmoduleadmin'));
require_once "{$xoopsModuleAdminPath}/moduleadmin.php";

$myts = MyTextSanitizer::getInstance();
require_once XOOPS_ROOT_PATH . '/modules/xfaq/class/topic.php';
require_once XOOPS_ROOT_PATH . '/modules/xfaq/class/faq.php';

if ($xoopsUser) {
    $xoopsModule = XoopsModule::getByDirname('xfaq');
    if (!$xoopsUser->isAdmin($xoopsModule->mid())) {
        redirect_header(XOOPS_URL . '/', 3, _NOPERM);
        exit();
    }
} else {
    redirect_header(XOOPS_URL . '/', 3, _NOPERM);
    exit();
}

xoops_cp_header();

// Include language file
xoops_loadLanguage('admin', 'system');
xoops_loadLanguage('admin', $xoopsModule->getVar('dirname', 'e'));
xoops_loadLanguage('modinfo', $xoopsModule->getVar('dirname', 'e'));

$topicHandler = xoops_getModuleHandler('Topic', 'xfaq');
$faqHandler   = xoops_getModuleHandler('Faq', 'xfaq');
