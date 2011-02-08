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
 
include "../../mainfile.php";
$xoopsOption['template_main'] = 'xfaq_index.html';
include_once XOOPS_ROOT_PATH."/header.php";
include_once "header.php";
$xoTheme->addStylesheet ( 'modules/xfaq/css/cupertino/jquery-ui-1.8.1.custom.css', array ('media' => 'screen' ) );

// pour les permissions
$access_topic = XFAQ_MygetItemIds('xfaq_access', 'xfaq');
$criteria = new CriteriaCompo();
$criteria->add(new Criteria('topic_id', '(' . implode(',', $access_topic) . ')','IN'));
$criteria->add(new Criteria('topic_online','1','='));
$pid = (isset($_GET['cid']))? intval($_GET['cid']):0;
$criteria->add(new Criteria('topic_pid', $pid ,'='));
$criteria->setSort('topic_weight');
$criteria->setOrder('ASC');
$numrows = $topicHandler->getCount($criteria);
$topic_arr = $topicHandler->getall($criteria);

		
	//Affichage du tableau
	$list = array();
	if ($numrows>0) 
	{
		foreach (array_keys($topic_arr) as $i) 
		{
			$list[$i]['topic_id'] = $topic_arr[$i]->getVar("topic_id");
			$list[$i]['topic_img'] = $topic_arr[$i]->getVar("topic_img");
			$list[$i]['topic_title'] = $topic_arr[$i]->getVar("topic_title");
			$list[$i]['topic_desc'] = $topic_arr[$i]->getVar("topic_desc");
		}
	}
	$xoopsTpl->assign('topicList',$list);
	$xoopsTpl->assign('topicNum',$numrows);
//////////////////////////////////////////////////////////////////////////////////////////
	$criteria = new CriteriaCompo();
	$criteria->setSort("faq_id");
	$criteria->setOrder("DESC");
	$criteria->add(new Criteria('faq_online','1','='));
	$criteria->add(new Criteria('faq_open','1','='));
	$cid = (isset($_GET['cid']))? intval($_GET['cid']):0;
	$criteria->add(new Criteria('faq_topic', $cid ,'='));
	$numrows = $faqHandler->getCount($criteria);
	$faq_arr = $faqHandler->getall($criteria);
	if ($numrows>0) 
		{		
		
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
	    if ( $numrows > $limit ) {
	        $pagenav = new XoopsPageNav($numrows, $limit, $start, 'start', 'limit=' . $limit.'&cid='.$cid);
	        $pagenav = $pagenav->renderNav(4);
	    } else {
	        $pagenav = '';
	    }
	    $xoopsTpl->assign('faqpagenav', $pagenav);	
		 
		 /**
		 * end pagenav setting 
		 */	
		 
			$list = array();
			foreach (array_keys($faq_arr) as $i) 
			{
				$list[$i]['faq_id'] = $faq_arr[$i]->getVar("faq_id");
				$list[$i]['faq_question'] = $faq_arr[$i]->getVar("faq_question");
				$list[$i]['faq_answer'] = $faq_arr[$i]->getVar("faq_answer");
				$list[$i]['faq_url'] = $faq_arr[$i]->getVar("faq_url");
				$list[$i]['faq_ansUser'] = XoopsUser::getUnameFromId($faq_arr[$i]->getVar("faq_ansUser"));
				$list[$i]['faq_ansUserId'] = $faq_arr[$i]->getVar("faq_ansUser");
				$list[$i]['faq_submitter'] = XoopsUser::getUnameFromId($faq_arr[$i]->getVar("faq_submitter"));
				$list[$i]['faq_submitterId'] = $faq_arr[$i]->getVar("faq_submitter");
				$list[$i]['faq_date_created'] = formatTimestamp($faq_arr[$i]->getVar("faq_date_created"),"Y-m-d");
			}
		}
$xoopsTpl->assign('faqList',$list);
$xoopsTpl->assign('faqNum',$numrows);

include_once XOOPS_ROOT_PATH."/footer.php";	
?>