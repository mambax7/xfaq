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
 * @author          Mojtaba Jamali (http://mydolphin.ir)
 *
 * Version : 1.00:
 * ****************************************************************************
 */
include __DIR__ . '/../../mainfile.php';
$GLOBALS['xoopsOption']['template_main'] = 'xfaq_faq.tpl';
require_once XOOPS_ROOT_PATH . '/header.php';
require_once __DIR__ . '/header.php';
$xoTheme->addStylesheet(XOOPS_URL . '/modules/system/css/ui/' . xoops_getModuleOption('jquery_theme', 'system') . '/ui.all.css');
$faq_id   = XFAQ_CleanVars($_REQUEST, 'faq_id', 0, 'int');
$view_faq = $faqHandler->get($faq_id);

// redirection si le téléchargement n'existe pas ou n'est pas activé
if (count($view_faq) == 0 || $view_faq->getVar('faq_online') == 0) {
    redirect_header('index.php', 3, _f);
}

// pour les permissions
$access_topic = XFAQ_MygetItemIds('xfaq_access', 'xfaq');
if (!in_array($view_faq->getVar('faq_topic'), $access_topic)) {
    redirect_header('index.php', 3, _NOPERM);
}

if ($view_faq->getVar('faq_metas_keyword')) {
    $xoTheme->addMeta('meta', 'keywords', $view_faq->getVar('faq_metas_keyword'));
}

if ($view_faq->getVar('faq_metas_desc')) {
    $xoTheme->addMeta('meta', 'description', $view_faq->getVar('faq_metas_desc'));
}

$xoopsTpl->assign('question', $view_faq->getVar('faq_question'));
$xoopsTpl->assign('answer', $view_faq->getVar('faq_answer'));
$xoopsTpl->assign('url', $view_faq->getVar('faq_url'));
$xoopsTpl->assign('ansusername', XoopsUser::getUnameFromId($view_faq->getVar('faq_ansUser')));
$xoopsTpl->assign('ansuserid', $view_faq->getVar('faq_ansUser'));
$xoopsTpl->assign('submittername', XoopsUser::getUnameFromId($view_faq->getVar('faq_submitter')));
$xoopsTpl->assign('submitterid', $view_faq->getVar('faq_submitter'));
$xoopsTpl->assign('datecreated', formatTimestamp($view_faq->getVar('faq_date_created'), 'Y-m-d'));
$xoopsTpl->assign('howdoi', $view_faq->getVar('faq_howdoi'));
$xoopsTpl->assign('diduno', $view_faq->getVar('faq_diduno'));

// tags
if (($xoopsModuleConfig['xfaqtag'] == 1) && is_dir('../tag')) {
    require_once XOOPS_ROOT_PATH . '/modules/tag/include/tagbar.php';
    $xoopsTpl->assign('tagbar', tagBar($faq_id, $catid = 0));
    $xoopsTpl->assign('tags', true);
} else {
    $xoopsTpl->assign('tags', false);
}

require_once XOOPS_ROOT_PATH . '/footer.php';
