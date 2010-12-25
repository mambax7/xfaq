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
 
include_once("./header.php");
	
xoops_cp_header();

if (isset($_REQUEST["op"])) {
	$op = $_REQUEST["op"];
} else {
	@$op = "show_list_faq";
}

//Menu admin
if ( !is_readable(XOOPS_ROOT_PATH . "/Frameworks/art/functions.admin.php") ) {
xfaq_adminmenu(2, _AM_XFAQ_MANAGER_FAQ);
} else {
include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php";
loadModuleAdminMenu (2, _AM_XFAQ_MANAGER_FAQ);
}

//Sous menu
echo "<div class=\"CPbigTitle\" style=\"background-image: url(../images/deco/faq.png); background-repeat: no-repeat; background-position: left; padding-left: 50px;\">
		<strong>"._AM_XFAQ_MANAGER_FAQ."</strong>
	</div><br /><br>";
switch ($op) 
{	
	case "save_faq":
		if ( !$GLOBALS["xoopsSecurity"]->check() ) {
           redirect_header("faq.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
        }
        if (isset($_REQUEST["faq_id"])) {
           $obj =& $faqHandler->get($_REQUEST["faq_id"]);
        } else {
           $obj =& $faqHandler->create();
        }
		$obj->setVar("faq_question", $_REQUEST["faq_question"]);
			$obj->setVar("faq_answer", $_REQUEST["faq_answer"]);
			$obj->setVar("faq_topic", $_REQUEST["faq_topic"]);
			$obj->setVar("faq_url", $_REQUEST["faq_url"]);
			$obj->setVar("faq_open", $_REQUEST["faq_open"]);
			$obj->setVar("faq_submitter", $_REQUEST["faq_submitter"]);
			$obj->setVar("faq_ansUser", $_REQUEST["faq_ansUser"]);
			$obj->setVar("faq_date_created", strtotime($_REQUEST["faq_date_created"]));
			$online = ($_REQUEST["faq_online"] == 1) ? "1" : "0";
			$obj->setVar("faq_online", $online);
			
		
        if ($faqHandler->insert($obj)) {
           redirect_header("faq.php?op=show_list_faq", 2, _AM_XFAQ_FORMOK);
        }
        //include_once("../include/forms.php");
        echo $obj->getHtmlErrors();
        $form =& $obj->getForm();
	break;
	
	case "edit_faq":
		$obj = $faqHandler->get($_REQUEST["faq_id"]);
		$form = $obj->getForm();
	break;
	
	case "delete_faq":
		$obj =& $faqHandler->get($_REQUEST["faq_id"]);
		if (isset($_REQUEST["ok"]) && $_REQUEST["ok"] == 1) {
			if ( !$GLOBALS["xoopsSecurity"]->check() ) {
				redirect_header("faq.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
			}
			if ($faqHandler->delete($obj)) {
				redirect_header("faq.php", 3, _AM_XFAQ_FORMDELOK);
			} else {
				echo $obj->getHtmlErrors();
			}
		} else {
			xoops_confirm(array("ok" => 1, "faq_id" => $_REQUEST["faq_id"], "op" => "delete_faq"), $_SERVER["REQUEST_URI"], sprintf(_AM_XFAQ_FORMSUREDEL, $obj->getVar("faq")));
		}
	break;
	
	case "update_online_faq":
		
	if (isset($_REQUEST["faq_id"])) {
		$obj =& $faqHandler->get($_REQUEST["faq_id"]);
	} 
	$obj->setVar("faq_online", $_REQUEST["faq_online"]);

	if ($faqHandler->insert($obj)) {
		redirect_header("faq.php", 3, _AM_XFAQ_FORMOK);
	}
	echo $obj->getHtmlErrors();
	
	break;
	
	case "default":
	default:

		$criteria = new CriteriaCompo();
		$criteria->setSort("faq_id");
		$criteria->setOrder("ASC");
		$numrows = $faqHandler->getCount();
		$faq_arr = $faqHandler->getall($criteria);
		
		//Affichage du tableau
		if ($numrows>0) 
		{			
			echo "<table width=\"100%\" cellspacing=\"1\" class=\"outer\">
				<tr>
					<th align=\"center\">"._AM_XFAQ_FAQ_QUESTION."</th>
						<th align=\"center\">"._AM_XFAQ_FAQ_ANSWER."</th>
						<th align=\"center\">"._AM_XFAQ_FAQ_TOPIC."</th>
						<th align=\"center\">"._AM_XFAQ_FAQ_URL."</th>
						<th align=\"center\">"._AM_XFAQ_FAQ_OPEN."</th>
						<th align=\"center\">"._AM_XFAQ_FAQ_SUBMITTER."</th>
						<th align=\"center\">"._AM_XFAQ_FAQ_ANSUSER."</th>
						<th align=\"center\">"._AM_XFAQ_FAQ_DATE_CREATED."</th>
						<th align=\"center\">"._AM_XFAQ_FAQ_ONLINE."</th>
						
					<th align=\"center\" width=\"10%\">"._AM_XFAQ_FORMACTION."</th>
				</tr>";
					
			$class = "odd";
			
			foreach (array_keys($faq_arr) as $i) 
			{
				echo "<tr class=\"".$class."\">";
				$class = ($class == "even") ? "odd" : "even";
				echo "<td align=\"center\">".$faq_arr[$i]->getVar("faq_question")."</td>";	
					echo "<td align=\"center\">".$faq_arr[$i]->getVar("faq_answer")."</td>";	
					$faq1 = $topicHandler->get($faq_arr[$i]->getVar("faq_topic"));
					$faq_topic1 = $faq1->getVar("topic_title");
					echo "<td align=\"center\">".$faq_topic1."</td>";	
					echo "<td align=\"center\">".$faq_arr[$i]->getVar("faq_url")."</td>";	
					echo "<td align=\"center\">".$faq_arr[$i]->getVar("faq_open")."</td>";	
					echo "<td align=\"center\">".XoopsUser::getUnameFromId($faq_arr[$i]->getVar("faq_submitter"),"S")."</td>";	
					echo "<td align=\"center\">".XoopsUser::getUnameFromId($faq_arr[$i]->getVar("faq_ansUser"),"S")."</td>";	
					echo "<td align=\"center\">".formatTimeStamp($faq_arr[$i]->getVar("faq_date_created"),"S")."</td>";	
					
					$online = $faq_arr[$i]->getVar("faq_online");
				
					if( $online == 1 ) {
						echo "<td align=\"center\"><a href=\"./faq.php?op=update_online_faq&faq_id=".$faq_arr[$i]->getVar("faq_id")."&faq_online=0\"><img src=\"./../images/deco/on.png\" border=\"0\" alt=\""._AM_XFAQ_ON."\" title=\""._AM_XFAQ_ON."\"></a></td>";	
					} else {
						echo "<td align=\"center\"><a href=\"./faq.php?op=update_online_faq&faq_id=".$faq_arr[$i]->getVar("faq_id")."&faq_online=1\"><img src=\"./../images/deco/off.png\" border=\"0\" alt=\""._AM_XFAQ_OFF."\" title=\""._AM_XFAQ_OFF."\"></a></td>";
					}
							echo "<td align=\"center\" width=\"10%\">
								<a href=\"faq.php?op=edit_faq&faq_id=".$faq_arr[$i]->getVar("faq_id")."\"><img src=\"../images/deco/edit.png\" alt=\""._AM_XFAQ_EDIT."\" title=\""._AM_XFAQ_EDIT."\"></a>
								<a href=\"faq.php?op=delete_faq&faq_id=".$faq_arr[$i]->getVar("faq_id")."\"><img src=\"../images/deco/delete.png\" alt=\""._AM_XFAQ_DELETE."\" title=\""._AM_XFAQ_DELETE."\"></a>
							  </td>";
				echo "</tr>";
			}
			echo "</table><br><br>";
		}
		// Affichage du formulaire
    	$obj =& $faqHandler->create();
    	$form = $obj->getForm();	
}
echo "<br /><br />
";
xoops_cp_footer();
	
?>