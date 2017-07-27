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

defined('XOOPS_ROOT_PATH') || exit('XOOPS Root Path not defined');

//if (!class_exists('XoopsPersistableObjectHandler')) {
//    require_once XOOPS_ROOT_PATH . '/modules/xfaq/class/object.php';
//}

/**
 * Class XfaqTopic
 */
class XfaqTopic extends XoopsObject
{
    //Constructor
    /**
     * xfaq_topic constructor.
     */
    public function __construct()
    {
        //        $this->XoopsObject();
        $this->initVar('topic_id', XOBJ_DTYPE_INT, null, false, 11);
        $this->initVar('topic_pid', XOBJ_DTYPE_INT, null, false, 5);
        $this->initVar('topic_title', XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('topic_desc', XOBJ_DTYPE_TXTAREA, null, false);
        $this->initVar('topic_img', XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('topic_weight', XOBJ_DTYPE_INT, null, false, 5);
        $this->initVar('topic_submitter', XOBJ_DTYPE_INT, null, false, 10);
        $this->initVar('topic_date_created', XOBJ_DTYPE_INT, null, false, 10);
        $this->initVar('topic_online', XOBJ_DTYPE_INT, null, false, 1);

        // Pour autoriser le html
        $this->initVar('dohtml', XOBJ_DTYPE_INT, 1, false);
    }

    /**
     * Returns category title using PHP5
     * @return string
     */
    public function __toString()
    {
        return $this->topic_title;
    }

    /**
     * @param  bool $action
     * @return XoopsThemeForm
     */
    public function getForm($action = false)
    {
        global $xoopsDB, $xoopsModuleConfig, $xoopsModule;

        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }

        $title = $this->isNew() ? sprintf(_AM_XFAQ_TOPIC_ADD) : sprintf(_AM_XFAQ_TOPIC_EDIT);

        require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';

        $form = new XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');

        require_once XOOPS_ROOT_PATH . '/class/tree.php';

        $topicHandler = xoops_getModuleHandler('Topic', 'xfaq');

        if (!$this->isNew()) {
            $arr = $topicHandler->getAll(new Criteria('topic_id', $this->getVar('topic_id'), '!='));
        } else {
            $arr = $topicHandler->getAll();
        }
        if (!empty($arr)) {
            $mytree = new XoopsObjectTree($arr, 'topic_id', 'topic_pid');
            $form->addElement(new XoopsFormLabel(_AM_XFAQ_TOPIC_PID, $mytree->makeSelBox('topic_pid', 'topic_title', '-', $this->getVar('topic_pid'), true)));
        }
        $form->addElement(new XoopsFormText(_AM_XFAQ_TOPIC_TITLE, 'topic_title', 50, 255, $this->getVar('topic_title')), true);
        $form->addElement(new XoopsFormTextArea(_AM_XFAQ_TOPIC_DESC, 'topic_desc', $this->getVar('topic_desc'), 4, 47), false);

        $topic_img                = $this->getVar('topic_img') ?: 'blank.png';
        $uploadirectory_topic_img = $xoopsModule->getVar('dirname') . '/topics/images';
        $imgtray_topic_img        = new XoopsFormElementTray(_AM_XFAQ_TOPIC_IMG, '<br>');
        $imgpath_topic_img        = sprintf(_AM_XFAQ_FORMIMAGE_PATH, $uploadirectory_topic_img);
        $imageselect_topic_img    = new XoopsFormSelect($imgpath_topic_img, 'topic_img', $topic_img);
        $image_array_topic_img    = XoopsLists:: getImgListAsArray(XOOPS_UPLOAD_PATH . '/' . $uploadirectory_topic_img);
        foreach ($image_array_topic_img as $image_topic_img) {
            $imageselect_topic_img->addOption("$image_topic_img", $image_topic_img);
        }
        $imageselect_topic_img->setExtra("onchange='showImgSelected(\"image_topic_img\", \"topic_img\", \"{$uploadirectory_topic_img}\", \"\", \"" . XOOPS_UPLOAD_URL . "\")'");
        $imgtray_topic_img->addElement($imageselect_topic_img, false);
        $imgtray_topic_img->addElement(new XoopsFormLabel('', "<img src='" . XOOPS_UPLOAD_URL . "/{$uploadirectory_topic_img}/{$topic_img}' style='max-width: 300px; padding: 1em 0em;' name='image_topic_img' id='image_topic_img' alt=''>"));

        $fileseltray_topic_img = new XoopsFormElementTray('', '<br>');
        $fileseltray_topic_img->addElement(new XoopsFormFile(_AM_XFAQ_FORMUPLOAD, 'topic_img', $xoopsModuleConfig['img_size']), false);
        $fileseltray_topic_img->addElement(new XoopsFormLabel(''), false);
        $imgtray_topic_img->addElement($fileseltray_topic_img);
        $form->addElement($imgtray_topic_img);

        $form->addElement(new XoopsFormText(_AM_XFAQ_TOPIC_WEIGHT, 'topic_weight', 50, 255, $this->getVar('topic_weight')), true);
        $form->addElement(new XoopsFormSelectUser(_AM_XFAQ_TOPIC_SUBMITTER, 'topic_submitter', false, $this->getVar('topic_submitter'), 1, false), true);
        $form->addElement(new XoopsFormTextDateSelect(_AM_XFAQ_TOPIC_DATE_CREATED, 'topic_date_created', '', $this->getVar('topic_date_created')));
        $topic_online       = $this->isNew() ? 1 : $this->getVar('topic_online');
        $check_topic_online = new XoopsFormRadioYN(_AM_XFAQ_TOPIC_ONLINE, 'topic_online', $topic_online, ' ' . _YES . '', ' ' . _NO . '');
        /*
                $check_topic_online = new XoopsFormCheckBox(_AM_XFAQ_TOPIC_ONLINE, "topic_online", $topic_online);
                $check_topic_online->addOption(1, " ");
        */
        $form->addElement($check_topic_online);

        //permissions
        $memberHandler = xoops_getHandler('member');
        $group_list    = $memberHandler->getGroupList();
        $gpermHandler  = xoops_getHandler('groupperm');
        $full_list     = array_keys($group_list);
        global $xoopsModule;
        if (!$this->isNew()) {
            $groups_ids_view                 = $gpermHandler->getGroupIds('xfaq_access', $this->getVar('topic_id'), $xoopsModule->getVar('mid'));
            $groups_ids_submit               = $gpermHandler->getGroupIds('xfaq_submit', $this->getVar('topic_id'), $xoopsModule->getVar('mid'));
            $groups_ids_view                 = array_values($groups_ids_view);
            $groups_news_can_view_checkbox   = new XoopsFormCheckBox(_AM_XFAQ_PERMISSIONS_ACCESS, 'groups_view[]', $groups_ids_view);
            $groups_ids_submit               = array_values($groups_ids_submit);
            $groups_news_can_submit_checkbox = new XoopsFormCheckBox(_AM_XFAQ_PERMISSIONS_SUBMIT, 'groups_submit[]', $groups_ids_submit);
        } else {
            $groups_news_can_view_checkbox   = new XoopsFormCheckBox(_AM_XFAQ_PERMISSIONS_ACCESS, 'groups_view[]', $full_list);
            $groups_news_can_submit_checkbox = new XoopsFormCheckBox(_AM_XFAQ_PERMISSIONS_SUBMIT, 'groups_submit[]', $full_list);
        }
        // pour voir
        $groups_news_can_view_checkbox->addOptionArray($group_list);
        $form->addElement($groups_news_can_view_checkbox);
        // pour editer
        $groups_news_can_submit_checkbox->addOptionArray($group_list);
        $form->addElement($groups_news_can_submit_checkbox);

        $form->addElement(new XoopsFormHidden('op', 'save_topic'));
        $form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
        $form->display();

        return $form;
    }

    /**
     * @return mixed
     */
    public function get_new_enreg()
    {
        global $xoopsDB;
        $new_enreg = $xoopsDB->getInsertId();

        return $new_enreg;
    }
}

/**
 * Class xfaqxfaq_topicHandler
 */
class XfaqTopicHandler extends XoopsPersistableObjectHandler
{
    /**
     * xfaqxfaq_topicHandler constructor.
     * @param null|XoopsDatabase $db
     */
    public function __construct($db)
    {
        parent::__construct($db, 'xfaq_topic', 'XfaqTopic', 'topic_id', '');
    }
}
