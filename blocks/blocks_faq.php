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

include_once XOOPS_ROOT_PATH . "/modules/xfaq/include/functions.php";

function b_xfaq_faq($options)
{
    include_once XOOPS_ROOT_PATH . "/modules/xfaq/class/faq.php";
    $myts =& MyTextSanitizer::getInstance();

    $faq = array();
    $type_block = $options[0];
    $nb_faq = $options[1];
    $length_title = $options[2];

    $faqHandler =& xoops_getModuleHandler("xfaq_faq", "xfaq");
    $criteria = new CriteriaCompo();
    array_shift($options);
    array_shift($options);
    array_shift($options);
    if (!(count($options) == 1 && $options[0] == 0)) {
        $criteria->add(new Criteria("faq_topic", block_addCatSelect($options),"IN"));
    }

    switch ($type_block)
    {
      // pour le bloc: faq recents
      case "recent":
        $criteria->add(new Criteria("faq_online", 1));
        $criteria->setSort("faq_date_created");
        $criteria->setOrder("DESC");
          break;
      // pour le bloc: faq du jour
      case "day":
        $criteria->add(new Criteria("faq_online", 1));
        $criteria->add(new Criteria("faq_date_created", strtotime(date("Y/m/d")), ">="));
        $criteria->add(new Criteria("faq_date_created", strtotime(date("Y/m/d"))+86400, "<="));
        $criteria->setSort("faq_date_created");
        $criteria->setOrder("ASC");
          break;
      // pour le bloc: faq aléatoires
      case "random":
        $criteria->add(new Criteria("faq_online", 1));
        $criteria->setSort("RAND()");
          break;
    }


    $criteria->setLimit($nb_faq);
    $faq_arr = $faqHandler->getAll($criteria);
  foreach (array_keys($faq_arr) as $i)
  {
    $faq[$i]["faq_id"] = $faq_arr[$i]->getVar("faq_id");
    $faq[$i]["faq_question"] = $faq_arr[$i]->getVar("faq_question");
    $faq[$i]["faq_answer"] = $faq_arr[$i]->getVar("faq_answer");
    $faq[$i]["faq_submitter"] = $faq_arr[$i]->getVar("faq_submitter");
    $faq[$i]["faq_date_created"] = $faq_arr[$i]->getVar("faq_date_created");
    $faq[$i]["faq_online"] = $faq_arr[$i]->getVar("faq_online");

  }
    return $faq;
}

function b_xfaq_faq_edit($options)
{
  include_once XOOPS_ROOT_PATH."/modules/xfaq/class/topic.php";

  $topicHandler =& xoops_getModuleHandler("xfaq_topic", "xfaq");
  $criteria = new CriteriaCompo();
  $criteria->setSort("topic_title");
  $criteria->setOrder("ASC");
  $topic_arr = $topicHandler->getAll($criteria);

  $form = ""._MB_XFAQ_FAQ_DISPLAY."\n";
  $form .= "<input type=\"hidden\" name=\"options[0]\" value=\"".$options[0]."\" />";
  $form .= "<input name=\"options[1]\" size=\"5\" maxlength=\"255\" value=\"".$options[1]."\" type=\"text\" />&nbsp;<br />";
  $form .= ""._MB_XFAQ_FAQ_TITLELENGTH." : <input name=\"options[2]\" size=\"5\" maxlength=\"255\" value=\"".$options[2]."\" type=\"text\" /><br /><br />";
  array_shift($options);
  array_shift($options);
  array_shift($options);
  $form .= ""._MB_XFAQ_FAQ_CATTODISPLAY."<br /><select name=\"options[]\" multiple=\"multiple\" size=\"5\">";
  $form .= "<option value=\"0\" " . (array_search(0, $options) === false ? "" : "selected=\"selected\"") . ">" ._MB_XFAQ_FAQ_ALLCAT . "</option>";
  foreach (array_keys($topic_arr) as $i) {
    $form .= "<option value=\"" . $topic_arr[$i]->getVar("topic_id") . "\" " . (array_search($topic_arr[$i]->getVar("topic_id"), $options) === false ? "" : "selected=\"selected\"") . ">".$topic_arr[$i]->getVar("topic_title")."</option>";
  }
  $form .= "</select>";

  return $form;
}

?>