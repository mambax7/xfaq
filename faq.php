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
$xoopsOption['template_main'] = 'xfaq_faq.html';
include_once XOOPS_ROOT_PATH."/header.php";
include_once "header.php";
$xoTheme->addStylesheet(XOOPS_URL . '/modules/system/css/ui/' . xoops_getModuleOption('jquery_theme', 'system') . '/ui.all.css');
$faq_id = XFAQ_CleanVars($_REQUEST, 'faq_id', 0, 'int');
$view_faq = $faqHandler->get($faq_id);

// redirection si le téléchargement n'existe pas ou n'est pas activé
if (count($view_faq) == 0 || $view_faq->getVar('faq_online') == 0){
    redirect_header('index.php', 3, _f);
    exit();
}

	$xoopsTpl->assign('question' , $view_faq->getVar('faq_question'));
	$xoopsTpl->assign('answer' , $view_faq->getVar('faq_answer'));
	$xoopsTpl->assign('url' , $view_faq->getVar('faq_url'));
	$xoopsTpl->assign('ansusername' , XoopsUser::getUnameFromId($view_faq->getVar("faq_ansUser")));
	$xoopsTpl->assign('ansuserid' , $view_faq->getVar("faq_ansUser"));
	$xoopsTpl->assign('submittername' , XoopsUser::getUnameFromId($view_faq->getVar("faq_submitter")));
	$xoopsTpl->assign('submitterid' , $view_faq->getVar("faq_submitter"));
	$xoopsTpl->assign('datecreated' , formatTimestamp($view_faq->getVar("faq_date_created"),"Y-m-d"));
	$xoopsTpl->assign('howdoi' , $view_faq->getVar("faq_howdoi"));
	$xoopsTpl->assign('diduno' , $view_faq->getVar("faq_diduno"));


// tags
if (($xoopsModuleConfig['xfaqtag'] == 1) and (is_dir('../tag'))){
    include_once XOOPS_ROOT_PATH."/modules/tag/include/tagbar.php";
	 $xoopsTpl->assign('tagbar', tagBar( $faq_id, $catid = 0));
    $xoopsTpl->assign('tags', true);
} else {
    $xoopsTpl->assign('tags', false);
}


	
include_once XOOPS_ROOT_PATH."/footer.php";	
?>