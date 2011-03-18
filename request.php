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
 
include "../../mainfile.php";
$xoopsOption['template_main'] = 'xfaq_request.html';
include_once XOOPS_ROOT_PATH."/header.php";
include_once "header.php";

$xoTheme->addStylesheet(XOOPS_URL . '/modules/system/css/ui/' . xoops_getModuleOption('jquery_theme', 'system') . '/ui.all.css');
$obj =& $faqHandler->create();

if (isset($_REQUEST["op"])) {
	$op = $_REQUEST["op"];
} else {
	@$op = "show_list_faq";
}
global $xoopsUser;
if(!is_object($xoopsUser))
{
	redirect_header("index.php", 3, "Login");
	exit(0);
}

$userId = $xoopsUser->getVar ( "uid" );

switch ($op) 
{	
	case "save_faq":
		if ( !$GLOBALS["xoopsSecurity"]->check() ) {
           redirect_header("index.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
        }
		
        if (isset($_REQUEST["faq_id"])) {
           $obj =& $faqHandler->get($_REQUEST["faq_id"]);
		   if ( $obj->getVar("faq_submitter") != $userId ) {
			redirect_header("index.php", 3, "It's Not your faq");
        }
        } else {
           $obj =& $faqHandler->create();
        }
		
			$obj->setVar("faq_question", $_REQUEST["faq_question"]);
			$obj->setVar("faq_topic", $_REQUEST["faq_topic"]);
			$obj->setVar("faq_submitter", $userId);
			$obj->setVar("faq_date_created", time());
			$obj->setVar("faq_open", $_REQUEST["faq_open"]);

         if($_REQUEST["faq_answer"]){
         	$obj->setVar("faq_answer", $_REQUEST["faq_answer"]);
         }


        if ($faqHandler->insert($obj)) {
           redirect_header("index.php", 2, _AM_XFAQ_FORMOK);
        }
        echo $obj->getHtmlErrors();
        //$form =& $obj->getForm();
	break;
	
	case "edit_faq":
		$obj = $faqHandler->get($_REQUEST["faq_id"]);
		$form = $obj->getUserForm();
		$xoopsTpl->assign('requestForm',$form);
	break;
	
	case "answere_faq":
		$obj = $faqHandler->get($_REQUEST["faq_id"]);
		$form = $obj->getanswereForm();
		$xoopsTpl->assign('answereForm',$form);
	break;
	
	case "delete_faq":
		$obj =& $faqHandler->get($_REQUEST["faq_id"]);
		if (isset($_REQUEST["ok"]) && $_REQUEST["ok"] == 1) {
			if ( !$GLOBALS["xoopsSecurity"]->check() ) {
				redirect_header("request.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
			}
			if ($faqHandler->delete($obj)) {
				redirect_header("request.php", 3, _AM_XFAQ_FORMDELOK);
			} else {
				echo $obj->getHtmlErrors();
			}
		} else {
			xoops_confirm(array("ok" => 1, "faq_id" => $_REQUEST["faq_id"], "op" => "delete_faq"), $_SERVER["REQUEST_URI"], sprintf(_AM_XFAQ_FORMSUREDEL, $obj->getVar("faq")));
		}
	break;
	
	case 'myaskedfaq':
		$criteria = new CriteriaCompo();
		$criteria->setSort("faq_id");
		$criteria->setOrder("DESC");
		$criteria->add(new Criteria('faq_submitter', $userId ,'='));
		$numrows = $faqHandler->getCount($criteria);
		$faq_arr = $faqHandler->getall($criteria);
		if ($numrows>0) 
			{			
				$list = array();
				foreach (array_keys($faq_arr) as $i) 
				{
					$list[$i]['faq_id'] = $faq_arr[$i]->getVar("faq_id");
					$list[$i]['faq_question'] = $faq_arr[$i]->getVar("faq_question");
					$list[$i]['faq_answer'] = $faq_arr[$i]->getVar("faq_answer");
					$faq1 = $topicHandler->get($faq_arr[$i]->getVar("faq_topic"));
					$faq_topic1 = $faq1->getVar("topic_title");
					$list[$i]['faq_topic'] = $faq_topic1;
					$list[$i]['faq_topicId'] = $faq_arr[$i]->getVar("faq_topic");
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
		break;
		
		case 'myansweredfaq':
		$criteria = new CriteriaCompo();
		$criteria->setSort("faq_id");
		$criteria->setOrder("DESC");
		$criteria->add(new Criteria('faq_ansUser', $userId ,'='));
		$numrows = $faqHandler->getCount($criteria);
		$faq_arr = $faqHandler->getall($criteria);
		if ($numrows>0) 
			{			
				$list = array();
				foreach (array_keys($faq_arr) as $i) 
				{
					$list[$i]['faq_id'] = $faq_arr[$i]->getVar("faq_id");
					$list[$i]['faq_question'] = $faq_arr[$i]->getVar("faq_question");
					$list[$i]['faq_answer'] = $faq_arr[$i]->getVar("faq_answer");
					$faq1 = $topicHandler->get($faq_arr[$i]->getVar("faq_topic"));
					$faq_topic1 = $faq1->getVar("topic_title");
					$list[$i]['faq_topic'] = $faq_topic1;
					$list[$i]['faq_topicId'] = $faq_arr[$i]->getVar("faq_topic");
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
		break;
		
		case 'privacyfaq':
		$form = $obj->getprivacyForm();	
		$xoopsTpl->assign('privacyForm',$form);
		break;
		
		case 'answeredfaq':
			$criteria = new CriteriaCompo();
			$criteria->setSort("faq_id");
			$criteria->setOrder("DESC");
			$criteria->add(new Criteria('faq_open', '5' ,'='));
			$numrows = $faqHandler->getCount($criteria);
			$faq_arr = $faqHandler->getall($criteria);
			if ($numrows>0) 
				{			
					$list = array();
					foreach (array_keys($faq_arr) as $i) 
					{
						$list[$i]['faq_id'] = $faq_arr[$i]->getVar("faq_id");
						$list[$i]['faq_question'] = $faq_arr[$i]->getVar("faq_question");
						$list[$i]['faq_answer'] = $faq_arr[$i]->getVar("faq_answer");
						$faq1 = $topicHandler->get($faq_arr[$i]->getVar("faq_topic"));
						$faq_topic1 = $faq1->getVar("topic_title");
						$list[$i]['faq_topic'] = $faq_topic1;
						$list[$i]['faq_topicId'] = $faq_arr[$i]->getVar("faq_topic");
						$list[$i]['faq_url'] = $faq_arr[$i]->getVar("faq_url");
						$list[$i]['faq_ansUser'] = XoopsUser::getUnameFromId($faq_arr[$i]->getVar("faq_ansUser"));
						$list[$i]['faq_ansUserId'] = $faq_arr[$i]->getVar("faq_ansUser");
						$list[$i]['faq_submitter'] = XoopsUser::getUnameFromId($faq_arr[$i]->getVar("faq_submitter"));
						$list[$i]['faq_submitterId'] = $faq_arr[$i]->getVar("faq_submitter");
						$list[$i]['faq_date_created'] = formatTimestamp($faq_arr[$i]->getVar("faq_date_created"),"Y-m-d");
					}
				}
			$xoopsTpl->assign('answeredList',$list);
			$xoopsTpl->assign('answeredNum',$numrows);
		break;
		
	   default:
		$form = $obj->getUserForm();	
		$xoopsTpl->assign('requestForm',$form);

}

include_once XOOPS_ROOT_PATH."/footer.php";	
?>