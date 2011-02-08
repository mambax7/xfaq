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

	class xfaq_faq extends XoopsObject
	{ 
		//Constructor
		function __construct()
		{
			$this->XoopsObject();
			$this->initVar("faq_id",XOBJ_DTYPE_INT,null,false,8);
			$this->initVar("faq_question",XOBJ_DTYPE_TXTAREA, null, false);
			$this->initVar("faq_answer",XOBJ_DTYPE_TXTAREA, null, false);
			$this->initVar("faq_topic",XOBJ_DTYPE_INT,null,false,8);
			$this->initVar("faq_url",XOBJ_DTYPE_TXTBOX,null,false);
			$this->initVar("faq_open",XOBJ_DTYPE_INT,null,false,1);
			$this->initVar("faq_submitter",XOBJ_DTYPE_INT,null,false,10);
			$this->initVar("faq_ansUser",XOBJ_DTYPE_INT,null,false,8);
			$this->initVar("faq_date_created",XOBJ_DTYPE_INT,null,false,10);
			$this->initVar("faq_online",XOBJ_DTYPE_INT,null,false,1);
			$this->initVar("faq_weight",XOBJ_DTYPE_INT,null,false,11);
			$this->initVar("faq_hit",XOBJ_DTYPE_INT,null,false,11);
			$this->initVar("faq_metas_keyword",XOBJ_DTYPE_TXTAREA, null, false);
			$this->initVar("faq_metas_desc",XOBJ_DTYPE_TXTAREA, null, false);
			$this->initVar("faq_howdoi",XOBJ_DTYPE_TXTBOX,null,false);
			$this->initVar("faq_diduno",XOBJ_DTYPE_TXTAREA,null,false);
			$this->initVar("faq_date_answer",XOBJ_DTYPE_INT,null,false,10);
			
			// Pour autoriser le html
			$this->initVar("dohtml", XOBJ_DTYPE_INT, 1, false);
			
		}

      function get_new_enreg()
      {
	      global $xoopsDB;
	      $new_enreg = $xoopsDB->getInsertId();
	      return $new_enreg;
      }
    
		function xfaq_faq()
		{
			$this->__construct();
		}
	
	function XFAQ_CleanVars( &$global, $key, $default = '', $type = 'int' ) {
    switch ( $type ) {
        case 'string':
            $ret = ( isset( $global[$key] ) ) ? filter_var( $global[$key], FILTER_SANITIZE_MAGIC_QUOTES ) : $default;
            break;
        case 'int': default:
            $ret = ( isset( $global[$key] ) ) ? filter_var( $global[$key], FILTER_SANITIZE_NUMBER_INT ) : $default;
            break;
    }
    if ( $ret === false ) {
        return $default;
    }
    return $ret;
}

		function getForm($action = false)
		{
			global $xoopsDB, $xoopsModuleConfig;
		
			if ($action === false) {
				$action = $_SERVER["REQUEST_URI"];
			}
		
			$title = $this->isNew() ? sprintf(_AM_XFAQ_FAQ_ADD) : sprintf(_AM_XFAQ_FAQ_EDIT);

			include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");

			$form = new XoopsThemeForm($title, "form", $action, "post", true);
			$form->setExtra("enctype=\"multipart/form-data\"");

			$form->addElement( new XoopsFormTextArea(_AM_XFAQ_FAQ_QUESTION, "faq_question", $this->getVar("faq_question", "e")), true );
			
			$editor_configs=array();
			$editor_configs["name"] ="faq_answer";
			$editor_configs["value"] = $this->getVar("faq_answer", "e");
			$editor_configs["rows"] = 20;
			$editor_configs["cols"] = 80;
			$editor_configs["width"] = "100%";
			$editor_configs["height"] = "400px";
			$editor_configs["editor"] = $xoopsModuleConfig["xfaq_editor"];				
			$form->addElement( new XoopsFormEditor(_AM_XFAQ_FAQ_ANSWER, "faq_answer", $editor_configs), true );

			//tag
			if (is_dir('../../tag') || is_dir('../tag')){
				$dir_tag_ok = true;
			}else{
				$dir_tag_ok = false;
			}
			if (($xoopsModuleConfig['xfaqtag'] == 1) and $dir_tag_ok){
				$tagId = $this->isNew() ? 0 : $this->getVar("faq_id");
				include_once XOOPS_ROOT_PATH . "/modules/tag/include/formtag.php";
				$form->addElement(new XoopsFormTag("item_tag", 60, 255, $tagId, 0));
			}

			include_once(XOOPS_ROOT_PATH."/class/tree.php");

			$topicHandler =& xoops_getModuleHandler("xfaq_topic", "xfaq");
			$arr = $topicHandler->getall();
			$mytree = new XoopsObjectTree($arr, "topic_id", "topic_pid");
			$form->addElement(new XoopsFormLabel(_AM_XFAQ_FAQ_TOPIC, $mytree->makeSelBox("faq_topic", "topic_title","-", $this->getVar("faq_topic"))));
			$form->addElement(new XoopsFormText(_AM_XFAQ_FAQ_URL, "faq_url", 50, 255, $this->getVar("faq_url")), false);
			$faq_open = new XoopsFormSelect(_AM_XFAQ_FAQ_OPEN, 'faq_open',$this->getVar("faq_open"));
			$faq_open->addOption("1", _AM_XFAQ_FAQ_OPEN1);
			$faq_open->addOption("2", _AM_XFAQ_FAQ_OPEN2);
			$faq_open->addOption("3", _AM_XFAQ_FAQ_OPEN3);
			$faq_open->addOption("4", _AM_XFAQ_FAQ_OPEN4);
			$faq_open->addOption("5", _AM_XFAQ_FAQ_OPEN5);
			$form->addElement($faq_open);	
			$form->addElement(new XoopsFormText(_AM_XFAQ_FAQ_WEIGHT, "faq_weight", 5, 11, $this->getVar("faq_weight")), false);
			$form->addElement(new XoopsFormTextArea(_AM_XFAQ_FAQ_METAKEY, "faq_metas_keyword", $this->getVar("faq_metas_keyword", "e")), false);
			$form->addElement(new XoopsFormTextArea(_AM_XFAQ_FAQ_METADESC, "faq_metas_desc", $this->getVar("faq_metas_desc", "e")), false);
			$form->addElement(new XoopsFormText(_AM_XFAQ_FAQ_HOWDOI, "faq_howdoi", 50, 255, $this->getVar("faq_howdoi")), false);
			$form->addElement(new XoopsFormTextArea(_AM_XFAQ_FAQ_DIDUNO, "faq_diduno", $this->getVar("faq_diduno", "e")), false);
			$form->addElement(new XoopsFormSelectUser(_AM_XFAQ_FAQ_SUBMITTER, "faq_submitter", false, $this->getVar("faq_submitter"), 1, false), true);
			$form->addElement(new XoopsFormSelectUser(_AM_XFAQ_FAQ_ANSUSER, "faq_ansUser", false, $this->getVar("faq_ansUser"), 1, false), true);
			$form->addElement(new XoopsFormTextDateSelect(_AM_XFAQ_FAQ_DATE_CREATED, "faq_date_created", "", $this->getVar("faq_date_created")));
			$form->addElement(new XoopsFormTextDateSelect(_AM_XFAQ_FAQ_DATE_ANSWER, "faq_date_answer", "", $this->getVar("faq_date_created")));
			$faq_online = $this->isNew() ? 1 : $this->getVar("faq_online");
			$check_faq_online = new XoopsFormCheckBox(_AM_XFAQ_FAQ_ONLINE, "faq_online", $faq_online);
			$check_faq_online->addOption(1, " ");
			$form->addElement($check_faq_online);
		
			$form->addElement(new XoopsFormHidden("op", "save_faq"));
			$form->addElement(new XoopsFormButton("", "submit", _SUBMIT, "submit"));
			$form->display();
			return $form;
		}
		
		function getUserForm($action = false)
		{
			global $xoopsDB;
		
			if ($action === false) {
				$action = $_SERVER["REQUEST_URI"];
			}
		
			$title = $this->isNew() ? sprintf(_AM_XFAQ_FAQ_ADD) : sprintf(_AM_XFAQ_FAQ_EDIT);

			include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");

			$form = new XoopsThemeForm($title, "form", $action, "post", true);
			$form->setExtra("enctype=\"multipart/form-data\"");
			
			$editor_configs=array();
			$editor_configs["name"] ="faq_question";				
			$form->addElement( new XoopsFormTextArea(_AM_XFAQ_FAQ_QUESTION, "faq_question", $this->getVar("faq_question", "e")), true );
			
			include_once(XOOPS_ROOT_PATH."/class/tree.php");
			$access_topic = XFAQ_MygetItemIds('xfaq_submit', 'xfaq');
			$criteria = new CriteriaCompo();
			$criteria->add(new Criteria('topic_id', '(' . implode(',', $access_topic) . ')','IN'));
			$criteria->add(new Criteria('topic_online','1','='));
			$topicHandler =& xoops_getModuleHandler("xfaq_topic", "xfaq");
			$numrows = $topicHandler->getCount();
			$topic_arr = $topicHandler->getall($criteria);
			if($numrows == 0)
				redirect_header ( XOOPS_URL , 3,  _AM_XFAQ_FAQ_NO_TOPIC);
			$mytree = new XoopsObjectTree($topic_arr, "topic_id", "topic_pid");
			$form->addElement(new XoopsFormLabel(_AM_XFAQ_FAQ_TOPIC, $mytree->makeSelBox("faq_topic", "topic_title","-", $this->getVar("faq_topic"))));
		
		   $form->addElement(new XoopsFormHidden("faq_open", "1"));
			$form->addElement(new XoopsFormHidden("op", "save_faq"));
			$form->addElement(new XoopsFormButton("", "submit", _SUBMIT, "submit"));
			$form->display();
			return $form;
		}

		function getprivacyForm($action = false)
		{
			global $xoopsDB;
		
			if ($action === false) {
				$action = $_SERVER["REQUEST_URI"];
			}
		
			$title = $this->isNew() ? sprintf(_AM_XFAQ_FAQ_PRIVACY) : sprintf(_AM_XFAQ_FAQ_EDIT);

			include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");

			$form = new XoopsThemeForm($title, "form", $action, "post", true);
			$form->setExtra("enctype=\"multipart/form-data\"");
			
			$editor_configs=array();
			$editor_configs["name"] ="faq_question";				
			$form->addElement( new XoopsFormTextArea(_AM_XFAQ_FAQ_QUESTION, "faq_question", $this->getVar("faq_question", "e")), true );
			
			include_once(XOOPS_ROOT_PATH."/class/tree.php");
			$access_topic = XFAQ_MygetItemIds('xfaq_submit', 'xfaq');
			$criteria = new CriteriaCompo();
			$criteria->add(new Criteria('topic_id', '(' . implode(',', $access_topic) . ')','IN'));
			$criteria->add(new Criteria('topic_online','1','='));
			$topicHandler =& xoops_getModuleHandler("xfaq_topic", "xfaq");
			$numrows = $topicHandler->getCount();
			$topic_arr = $topicHandler->getall($criteria);
			if($numrows == 0)
				redirect_header ( XOOPS_URL , 3,  _AM_XFAQ_FAQ_NO_TOPIC);
			$mytree = new XoopsObjectTree($topic_arr, "topic_id", "topic_pid");
			$form->addElement(new XoopsFormLabel(_AM_XFAQ_FAQ_TOPIC, $mytree->makeSelBox("faq_topic", "topic_title","-", $this->getVar("faq_topic"))));
		
		   $form->addElement(new XoopsFormHidden("faq_open", "4"));
			$form->addElement(new XoopsFormHidden("op", "save_faq"));
			$form->addElement(new XoopsFormButton("", "submit", _SUBMIT, "submit"));
			$form->display();
			return $form;
		}		
		
		
		
		function getanswereForm($action = false)
		{
			global $xoopsDB;
		
			if ($action === false) {
				$action = $_SERVER["REQUEST_URI"];
			}
		
			$title = sprintf(_AM_XFAQ_FAQ_ANSWER);

			include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");

			$form = new XoopsThemeForm($title, "form", $action, "post", true);
			$form->setExtra("enctype=\"multipart/form-data\"");
			$form->addElement( new XoopsFormLabel(_AM_XFAQ_FAQ_QUESTION,  $this->getVar("faq_question", "e")));
			$editor_configs=array();
			$editor_configs["name"] ="faq_answer";
			$editor_configs["value"] = $this->getVar("faq_answer", "e");
			$editor_configs["rows"] = 20;
			$editor_configs["cols"] = 80;
			$editor_configs["width"] = "100%";
			$editor_configs["height"] = "400px";
			$editor_configs["editor"] = $xoopsModuleConfig["xfaq_editor"];				
			$form->addElement( new XoopsFormEditor(_AM_XFAQ_FAQ_ANSWER, "faq_answer", $editor_configs), true );

			include_once(XOOPS_ROOT_PATH."/class/tree.php");
			$access_topic = XFAQ_MygetItemIds('xfaq_submit', 'xfaq');
			$criteria = new CriteriaCompo();
			$criteria->add(new Criteria('topic_id', '(' . implode(',', $access_topic) . ')','IN'));
			$criteria->add(new Criteria('topic_online','1','='));
			$topicHandler =& xoops_getModuleHandler("xfaq_topic", "xfaq");
			$numrows = $topicHandler->getCount();
			$topic_arr = $topicHandler->getall($criteria);
			if($numrows == 0)
				redirect_header ( XOOPS_URL , 3,  _AM_XFAQ_FAQ_NO_TOPIC);
			$mytree = new XoopsObjectTree($topic_arr, "topic_id", "topic_pid");
			$form->addElement(new XoopsFormLabel(_AM_XFAQ_FAQ_TOPIC, $mytree->makeSelBox("faq_topic", "topic_title","-", $this->getVar("faq_topic"))));
		
		   $form->addElement(new XoopsFormHidden("faq_open", "3"));
			$form->addElement(new XoopsFormHidden("op", "save_faq"));
			$form->addElement(new XoopsFormButton("", "submit", _SUBMIT, "submit"));
			$form->display();
			return $form;
		}
		
		
	}
	class xfaqxfaq_faqHandler extends XoopsPersistableObjectHandler 
	{

		function __construct(&$db) 
		{
			parent::__construct($db, "xfaq_faq", "xfaq_faq", "faq_id", "");
		}

	}
	
?>