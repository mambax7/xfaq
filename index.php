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

include __DIR__ . '/../../mainfile.php';
$GLOBALS['xoopsOption']['template_main'] = 'xfaq_index.tpl';
require_once XOOPS_ROOT_PATH . '/header.php';
require_once __DIR__ . '/header.php';
$xoTheme->addStylesheet(XOOPS_URL . '/modules/system/css/ui/' . xoops_getModuleOption('jquery_theme', 'system') . '/ui.all.css');
//$xoTheme->addStylesheet(XOOPS_URL . '/modules/system/css/ui/' . $xoopsConfig['jquery_theme'] . '/ui.all.css');
//$xoTheme->addStylesheet(XOOPS_URL . '/modules/system/css/ui/' . xoops_getModuleOption('jquery_theme', 'system') . '/ui.all.css');

// pour les permissions
$access_topic = XFAQ_MygetItemIds('xfaq_access', 'xfaq');
$criteria     = new CriteriaCompo();
$criteria->add(new Criteria('topic_id', '(' . implode(',', $access_topic) . ')', 'IN'));
$criteria->add(new Criteria('topic_online', '1', '='));
$cid = isset($_GET['cid']) ? (int)$_GET['cid'] : 0;
$criteria->add(new Criteria('topic_pid', $cid, '='));
$criteria->setSort('topic_weight');
$criteria->setOrder('ASC');
$numrows = $topicHandler->getCount($criteria);

//Affichage du tableau
$list = [];
if ($numrows > 0) {
    $topic_arr = $topicHandler->getAll($criteria);
    foreach (array_keys($topic_arr) as $i) {
        $list[$i]['topic_id']    = $topic_arr[$i]->getVar('topic_id');
        $list[$i]['topic_img']   = $topic_arr[$i]->getVar('topic_img');
        $list[$i]['topic_title'] = $topic_arr[$i]->getVar('topic_title');
        $list[$i]['topic_desc']  = $topic_arr[$i]->getVar('topic_desc');
    }
}

$xoopsTpl->assign('topicList', $list);
$xoopsTpl->assign('topicNum', $numrows);
//////////////////////////////////////////////////////////////////////////////////////////

if ($cid > 0) {
    $xoTheme->addScript('browse.php?Frameworks/jquery/jquery.js');
    $xoTheme->addScript('browse.php?Frameworks/jquery/plugins/jquery.ui.js');

    $criteria = new CriteriaCompo();
    $criteria->setSort('faq_id');
    $criteria->setOrder('DESC');
    $criteria->add(new Criteria('faq_online', '1'));
    $criteria->add(new Criteria('faq_open', '2'));
    $criteria->add(new Criteria('faq_open', '3'), 'OR');
    $criteria->add(new Criteria('faq_topic', $cid));
    $numrows = $faqHandler->getCount($criteria);
    if ($numrows > 0) {

        /**
         * start pagenav setting
         * get information for limit by $_REQUEST['limit']
         * get information for start by $_REQUEST['start']
         */

        // get limited information
        if (isset($_REQUEST['limit'])) {
            $criteria->setLimit($_REQUEST['limit']);
            $limit = $_REQUEST['limit'];
        } else {
            $criteria->setLimit($xoopsModuleConfig['itemperpage']);
            $limit = $xoopsModuleConfig['itemperpage'];
        }

        // get start information
        if (isset($_REQUEST['start'])) {
            $criteria->setStart($_REQUEST['start']);
            $start = $_REQUEST['start'];
        } else {
            $criteria->setStart(0);
            $start = 0;
        }

        // make pagenav tolbar
        $faq_arr = $faqHandler->getall($criteria);
        if ($numrows > $limit) {
            $pagenav = new XoopsPageNav($numrows, $limit, $start, 'start', 'limit=' . $limit . '&cid=' . $cid);
            $pagenav = $pagenav->renderNav(4);
        } else {
            $pagenav = '';
        }
        $xoopsTpl->assign('faqpagenav', $pagenav);

        /**
         * end pagenav setting
         */

        $list = [];
        foreach (array_keys($faq_arr) as $i) {
            $list[$i]['faq_id']           = $faq_arr[$i]->getVar('faq_id');
            $list[$i]['faq_question']     = $faq_arr[$i]->getVar('faq_question');
            $list[$i]['faq_answer']       = $faq_arr[$i]->getVar('faq_answer');
            $list[$i]['faq_url']          = $faq_arr[$i]->getVar('faq_url');
            $list[$i]['faq_ansUser']      = XoopsUser::getUnameFromId($faq_arr[$i]->getVar('faq_ansUser'));
            $list[$i]['faq_ansUserId']    = $faq_arr[$i]->getVar('faq_ansUser');
            $list[$i]['faq_submitter']    = XoopsUser::getUnameFromId($faq_arr[$i]->getVar('faq_submitter'));
            $list[$i]['faq_submitterId']  = $faq_arr[$i]->getVar('faq_submitter');
            $list[$i]['faq_date_created'] = formatTimestamp($faq_arr[$i]->getVar('faq_date_created'), 'Y-m-d');
            $list[$i]['faq_howdoi']       = $faq_arr[$i]->getVar('faq_howdoi');
            $list[$i]['faq_diduno']       = $faq_arr[$i]->getVar('faq_diduno');
        }
    }

    $xoopsTpl->assign('faqList', $list);
    $xoopsTpl->assign('faqNum', $numrows);
}

require_once XOOPS_ROOT_PATH . '/footer.php';
