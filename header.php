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

require_once XOOPS_ROOT_PATH . '/kernel/module.php';
require_once XOOPS_ROOT_PATH . '/class/xoopstree.php';
require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
require_once XOOPS_ROOT_PATH . '/class/tree.php';
require_once XOOPS_ROOT_PATH . '/class/xoopslists.php';
require_once XOOPS_ROOT_PATH . '/class/pagenav.php';
require_once XOOPS_ROOT_PATH . '/class/xoopstopic.php';
require_once XOOPS_ROOT_PATH . '/class/xoopsform/grouppermform.php';
require_once __DIR__ . '/include/functions.php';

$myts = MyTextSanitizer::getInstance();
require_once XOOPS_ROOT_PATH . '/modules/xfaq/class/topic.php';
require_once XOOPS_ROOT_PATH . '/modules/xfaq/class/faq.php';

// Include language file
xoops_loadLanguage('admin', 'system');
xoops_loadLanguage('admin', $xoopsModule->getVar('dirname', 'e'));
xoops_loadLanguage('modinfo', $xoopsModule->getVar('dirname', 'e'));

$topicHandler = xoops_getModuleHandler('Topic', 'xfaq');
$faqHandler   = xoops_getModuleHandler('Faq', 'xfaq');
