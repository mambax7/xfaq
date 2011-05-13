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

include_once "./header.php";

include_once XOOPS_ROOT_PATH . "/modules/" . $xoopsModule->getVar("dirname") . "/class/admin.php";
$index_admin = new ModuleAdmin();
echo $index_admin->addNavigation('topic.php');

if (isset($_REQUEST["op"])) {
    $op = $_REQUEST["op"];
} else {
    @$op = "show_list_topic";
}

switch ($op)
{
    case "save_topic":
        if ( !$GLOBALS["xoopsSecurity"]->check() ) {
               redirect_header("topic.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
        }
        if (isset($_REQUEST["topic_id"])) {
           $obj =& $topicHandler->get($_REQUEST["topic_id"]);
        } else {
           $obj =& $topicHandler->create();
        }
        $obj->setVar("topic_pid", $_REQUEST["topic_pid"]);
        $obj->setVar("topic_title", $_REQUEST["topic_title"]);
        $obj->setVar("topic_desc", $_REQUEST["topic_desc"]);
        $obj->setVar("topic_img", $_REQUEST["topic_img"]);
        $obj->setVar("topic_weight", $_REQUEST["topic_weight"]);
        $obj->setVar("topic_submitter", $_REQUEST["topic_submitter"]);
        $obj->setVar("topic_date_created", strtotime($_REQUEST["topic_date_created"]));
        $online = ($_REQUEST["topic_online"] == 1) ? "1" : "0";
        $obj->setVar("topic_online", $online);

        if ($topicHandler->insert($obj)) {

            $newcat_cid = $obj->get_new_enreg();
            //permission pour voir
            $perm_id = isset($_REQUEST['topic_id']) ? intval($_REQUEST['topic_id']) : $newcat_cid;
            $gperm_handler = &xoops_gethandler('groupperm');
            $criteria = new CriteriaCompo();
            $criteria->add(new Criteria('gperm_itemid', $perm_id, '='));
            $criteria->add(new Criteria('gperm_modid', $xoopsModule->getVar('mid'),'='));
            $criteria->add(new Criteria('gperm_name', 'xfaq_access', '='));
            $gperm_handler->deleteAll($criteria);
            if(isset($_REQUEST['groups_view'])) {
                foreach($_REQUEST['groups_view'] as $onegroup_id) {
                    $gperm_handler->addRight('xfaq_access', $perm_id, $onegroup_id, $xoopsModule->getVar('mid'));
                }
            }
            //permission pour editer
            $perm_id = isset($_REQUEST['topic_id']) ? intval($_REQUEST['topic_id']) : $newcat_cid;
            $gperm_handler = &xoops_gethandler('groupperm');
            $criteria = new CriteriaCompo();
            $criteria->add(new Criteria('gperm_itemid', $perm_id, '='));
            $criteria->add(new Criteria('gperm_modid', $xoopsModule->getVar('mid'),'='));
            $criteria->add(new Criteria('gperm_name', 'xfaq_submit', '='));
            $gperm_handler->deleteAll($criteria);
            if(isset($_POST['groups_submit'])) {
                foreach($_POST['groups_submit'] as $onegroup_id) {
                    $gperm_handler->addRight('xfaq_submit', $perm_id, $onegroup_id, $xoopsModule->getVar('mid'));
                }
            }

            redirect_header("topic.php?op=show_list_topic", 2, _AM_XFAQ_FORMOK);
        }
        //include_once("../include/forms.php");
        echo $obj->getHtmlErrors();
        $form =& $obj->getForm();
        break;

    case "edit_topic":
        $obj = $topicHandler->get($_REQUEST["topic_id"]);
        $form = $obj->getForm();
        break;

    case "delete_topic":
        $obj =& $topicHandler->get($_REQUEST["topic_id"]);
        if (isset($_REQUEST["ok"]) && $_REQUEST["ok"] == 1) {
            if ( !$GLOBALS["xoopsSecurity"]->check() ) {
                redirect_header("topic.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
            }
            if ($topicHandler->delete($obj)) {
                redirect_header("topic.php", 3, _AM_XFAQ_FORMDELOK);
            } else {
                echo $obj->getHtmlErrors();
            }
        } else {
            xoops_confirm(array("ok" => 1, "topic_id" => $_REQUEST["topic_id"], "op" => "delete_topic"), $_SERVER["REQUEST_URI"], sprintf(_AM_XFAQ_FORMSUREDEL, $obj->getVar("topic")));
        }
        break;

    case "update_online_topic":

        if (isset($_REQUEST["topic_id"])) {
            $obj =& $topicHandler->get($_REQUEST["topic_id"]);
        }
        $obj->setVar("topic_online", $_REQUEST["topic_online"]);

        if ($topicHandler->insert($obj)) {
            redirect_header("topic.php", 3, _AM_XFAQ_FORMOK);
        }
        echo $obj->getHtmlErrors();

        break;

    case "default":
    default:

        $criteria = new CriteriaCompo();
        $criteria->setSort("topic_id");
        $criteria->setOrder("DESC");
        $numrows = $topicHandler->getCount();

        //Affichage du tableau
        if ($numrows>0)
        {
            $topic_arr = $topicHandler->getAll($criteria);

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
                $criteria->setLimit($xoopsModuleConfig['topicperadmin']);
                $limit = $xoopsModuleConfig['topicperadmin'];
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
            $topic_arr = $topicHandler->getAll($criteria);
            if ( $numrows > $limit ) {
                $pagenav = new XoopsPageNav($numrows, $limit, $start, 'start', 'limit=' . $limit);
                $pagenav = $pagenav->renderNav(4);
            } else {
                $pagenav = '';
            }

            echo $pagenav;

      /**
            * end pagenav setting
             */
            echo "<table style=\"width: 100%; margin: 1px;\" class=\"outer\">\n"
                ."  <tr>\n"
                ."    <th style=\"text-align: center;\">" . _AM_XFAQ_TOPIC_ID . "</th>\n"
                ."    <th style=\"text-align: center;\">" . _AM_XFAQ_TOPIC_TITLE . "</th>\n"
                ."    <th style=\"text-align: center;\">" . _AM_XFAQ_TOPIC_DESC . "</th>\n"
                ."    <th style=\"text-align: center;\">" . _AM_XFAQ_TOPIC_IMG . "</th>\n"
                ."    <th style=\"text-align: center;\">" . _AM_XFAQ_TOPIC_WEIGHT . "</th>\n"
                ."    <th style=\"text-align: center;\">" . _AM_XFAQ_TOPIC_ONLINE . "</th>\n"
                ."    <th style=\"text-align: center; width: 10%;\">" . _AM_XFAQ_FORMACTION . "</th>\n"
                ."  </tr>\n";

            $class = "odd";

            foreach (array_keys($topic_arr) as $i)
            {
                echo "<tr class=\"".$class."\">";
                $class = ($class == "even") ? "odd" : "even";
                echo "    <td style=\"text-align: center;\">" . $topic_arr[$i]->getVar("topic_id") . "</td>\n"
                    ."    <td style=\"text-align: center;\">" . $topic_arr[$i]->getVar("topic_title") . "</td>\n"
                    ."    <td style=\"text-align: center;\">" . $topic_arr[$i]->getVar("topic_desc") . "</td>\n"
                    ."    <td style=\"text-align: center;\">" . $topic_arr[$i]->getVar("topic_img") . "</td>\n"
                    ."    <td style=\"text-align: center;\">" . $topic_arr[$i]->getVar("topic_weight") . "</td>\n";

                $online = $topic_arr[$i]->getVar("topic_online");

                if (1 ==  $online) {
                    echo "    <td style=\"text-align: center;\"><a href=\"./topic.php?op=update_online_topic&amp;topic_id=" . $topic_arr[$i]->getVar("topic_id") . "&amp;topic_online=0\"><img src=\"./../images/icons/on.png\" border=\"0\" alt=\"" . _AM_XFAQ_ON . "\" title=\"" . _AM_XFAQ_ON . "\"></a></td>\n";
                } else {
                    echo "    <td style=\"text-align: center;\"><a href=\"./topic.php?op=update_online_topic&amp;topic_id=".$topic_arr[$i]->getVar("topic_id")."&amp;topic_online=1\"><img src=\"./../images/icons/off.png\" border=\"0\" alt=\""._AM_XFAQ_OFF."\" title=\""._AM_XFAQ_OFF."\"></a></td>\n";
                }
                echo "    <td style=\"text-align: center; width: 10%;\">\n"
                    ."      <a href=\"topic.php?op=edit_topic&amp;topic_id=" . $topic_arr[$i]->getVar("topic_id") . "\"><img src=\"../images/icons/edit.png\" alt=\"" . _AM_XFAQ_EDIT . "\" title=\"" . _AM_XFAQ_EDIT . "\"></a>\n"
                    ."      <a href=\"topic.php?op=delete_topic&topic_id=" . $topic_arr[$i]->getVar("topic_id") . "\"><img src=\"../images/icons/delete.png\" alt=\"" . _AM_XFAQ_DELETE . "\" title=\"" . _AM_XFAQ_DELETE . "\"></a>\n"
                    ."    </td>\n"
            ."  </tr>\n";
            }
            echo "</table><br /><br />\n";
        }
        // Affichage du formulaire
        $obj =& $topicHandler->create();
        $form = $obj->getForm();
}

xoops_cp_footer();

?>