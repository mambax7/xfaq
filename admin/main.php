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

include_once __DIR__ . '/admin_header.php';

global $xoopsModule;

//compte "total"
$count_topic = $topicHandler->getCount();

//compte "attente"
$criteria = new CriteriaCompo();
$criteria->add(new Criteria('topic_online', 1));
$topic_online  = $topicHandler->getCount($criteria);
$topic_offline = $count_topic - $topic_online;

//compte "total"
$count_faq = $faqHandler->getCount();
//compte "attente"
$criteria = new CriteriaCompo();
$criteria->add(new Criteria('faq_online', 1));
$faq_online  = $faqHandler->getCount($criteria);
$faq_offline = $count_faq - $faq_online;

$indexAdmin = new ModuleAdmin();
$indexAdmin->addInfoBox(_AM_XFAQ_XFAQCONF);

//number of topics
$indexAdmin->addInfoBoxLine(_AM_XFAQ_XFAQCONF, _AM_XFAQ_THEREARE_TOPIC_ONLINE, $topic_online, 'Green');
$indexAdmin->addInfoBoxLine(_AM_XFAQ_XFAQCONF, _AM_XFAQ_THEREARE_TOPIC, $count_topic);

//number of faqs
$indexAdmin->addInfoBoxLine(_AM_XFAQ_XFAQCONF, _AM_XFAQ_THEREARE_FAQ_ONLINE, $faq_online, 'Green');
$indexAdmin->addInfoBoxLine(_AM_XFAQ_XFAQCONF, _AM_XFAQ_THEREARE_FAQ, $count_faq);

//$indexAdmin->addConfigLabel(_AM_XFAQ_CONFIG_CHECK);
//$indexAdmin->addLineConfigLabel(_AM_XFAQ_CONFIG_PHP, $xoopsModule->getInfo('min_php'), 'php');
//$indexAdmin->addLineConfigLabel(_AM_XFAQ_CONFIG_XOOPS, $xoopsModule->getInfo('min_xoops'), 'xoops');

echo $indexAdmin->addNavigation(basename(__FILE__));
echo $indexAdmin->renderIndex();

include_once __DIR__ . '/admin_footer.php';
