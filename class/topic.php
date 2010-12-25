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
 
	
	if (!defined("XOOPS_ROOT_PATH")) {
		die("XOOPS root path not defined");
	}

	if (!class_exists("XoopsPersistableObjectHandler")) {
		include_once XOOPS_ROOT_PATH."/modules/xfaq/class/object.php";
	}

	class xfaq_topic extends XoopsObject
	{ 
		//Constructor
		function __construct()
		{
			$this->XoopsObject();
			$this->initVar("topic_id",XOBJ_DTYPE_INT,null,false,11);
			$this->initVar("topic_pid",XOBJ_DTYPE_INT,null,false,5);
			$this->initVar("topic_title",XOBJ_DTYPE_TXTBOX,null,false);
			 $this->initVar("topic_desc",XOBJ_DTYPE_TXTAREA, null, false);
			$this->initVar("topic_img",XOBJ_DTYPE_TXTBOX,null,false);
			$this->initVar("topic_weight",XOBJ_DTYPE_INT,null,false,5);
			$this->initVar("topic_submitter",XOBJ_DTYPE_INT,null,false,10);
			$this->initVar("topic_date_created",XOBJ_DTYPE_INT,null,false,10);
			$this->initVar("topic_online",XOBJ_DTYPE_INT,null,false,1);
			
			// Pour autoriser le html
			$this->initVar("dohtml", XOBJ_DTYPE_INT, 1, false);
			
		}

		function xfaq_topic()
		{
			$this->__construct();
		}
	
		function getForm($action = false)
		{
			global $xoopsDB, $xoopsModuleConfig;
		
			if ($action === false) {
				$action = $_SERVER["REQUEST_URI"];
			}
		
			$title = $this->isNew() ? sprintf(_AM_XFAQ_TOPIC_ADD) : sprintf(_AM_XFAQ_TOPIC_EDIT);

			include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");

			$form = new XoopsThemeForm($title, "form", $action, "post", true);
			$form->setExtra("enctype=\"multipart/form-data\"");
			
			
			include_once(XOOPS_ROOT_PATH."/class/tree.php");
			
			$topicHandler =& xoops_getModuleHandler("xfaq_topic", "xfaq");
			$arr = $topicHandler->getall();
			$mytree = new XoopsObjectTree($arr, "topic_id", "topic_pid");
			$form->addElement(new XoopsFormLabel(_AM_XFAQ_TOPIC_PID, $mytree->makeSelBox("topic_pid", "topic_title","-", $this->getVar("topic_pid"),true)));
			$form->addElement(new XoopsFormText(_AM_XFAQ_TOPIC_TITLE, "topic_title", 50, 255, $this->getVar("topic_title")), true);
			$form->addElement(new XoopsFormText(_AM_XFAQ_TOPIC_DESC, "topic_desc", 50, 255, $this->getVar("topic_desc")), true);
			$form->addElement(new XoopsFormText(_AM_XFAQ_TOPIC_IMG, "topic_img", 50, 255, $this->getVar("topic_img")), true);
			$form->addElement(new XoopsFormText(_AM_XFAQ_TOPIC_WEIGHT, "topic_weight", 50, 255, $this->getVar("topic_weight")), true);
			$form->addElement(new XoopsFormSelectUser(_AM_XFAQ_TOPIC_SUBMITTER, "topic_submitter", false, $this->getVar("topic_submitter"), 1, false), true);
			$form->addElement(new XoopsFormTextDateSelect(_AM_XFAQ_TOPIC_DATE_CREATED, "topic_date_created", "", $this->getVar("topic_date_created")));
			 $topic_online = $this->isNew() ? 1 : $this->getVar("topic_online");
			$check_topic_online = new XoopsFormCheckBox(_AM_XFAQ_TOPIC_ONLINE, "topic_online", $topic_online);
			$check_topic_online->addOption(1, " ");
			$form->addElement($check_topic_online);
			
			//permissions
        $member_handler = & xoops_gethandler('member');
        $group_list = &$member_handler->getGroupList();
        $gperm_handler = &xoops_gethandler('groupperm');
        $full_list = array_keys($group_list);
        global $xoopsModule;
        if(!$this->isNew()) {
            $groups_ids_view = $gperm_handler->getGroupIds('xfaq_access', $this->getVar('topic_id'), $xoopsModule->getVar('mid'));
            $groups_ids_submit = $gperm_handler->getGroupIds('xfaq_submit', $this->getVar('topic_id'), $xoopsModule->getVar('mid'));
            $groups_ids_view = array_values($groups_ids_view);
            $groups_news_can_view_checkbox = new XoopsFormCheckBox(_AM_XFAQ_PERMISSIONS_ACCESS, 'groups_view[]', $groups_ids_view);
            $groups_ids_submit = array_values($groups_ids_submit);
            $groups_news_can_submit_checkbox = new XoopsFormCheckBox(_AM_XFAQ_PERMISSIONS_SUBMIT, 'groups_submit[]', $groups_ids_submit);
           
        } else {
            $groups_news_can_view_checkbox = new XoopsFormCheckBox(_AM_XFAQ_PERMISSIONS_ACCESS, 'groups_view[]', $full_list);
            $groups_news_can_submit_checkbox = new XoopsFormCheckBox(_AM_XFAQ_PERMISSIONS_SUBMIT, 'groups_submit[]', $full_list);
            
        }
		 // pour voir
        $groups_news_can_view_checkbox->addOptionArray($group_list);
        $form->addElement($groups_news_can_view_checkbox);
        // pour editer
        $groups_news_can_submit_checkbox->addOptionArray($group_list);
        $form->addElement($groups_news_can_submit_checkbox);
			
			
			$form->addElement(new XoopsFormHidden("op", "save_topic"));
			$form->addElement(new XoopsFormButton("", "submit", _SUBMIT, "submit"));
			$form->display();
			return $form;
		}
	function get_new_enreg()
    {
        global $xoopsDB;
        $new_enreg = $xoopsDB->getInsertId();
        return $new_enreg;
    }
	}
	class xfaqxfaq_topicHandler extends XoopsPersistableObjectHandler 
	{

		function __construct(&$db) 
		{
			parent::__construct($db, "xfaq_topic", "xfaq_topic", "topic_id", "");
		}

	}
	
?>