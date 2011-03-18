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
 
include_once("./header.php");
	
xoops_cp_header();

if (isset($_REQUEST["op"])) {
	$op = $_REQUEST["op"];
} else {
	@$op = "show_list_faq";
}

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
        
         $obj->setVars($_REQUEST);

			$obj->setVar("faq_date_created", strtotime($_REQUEST["faq_date_created"]));
			$online = ($_REQUEST["faq_online"] == 1) ? "1" : "0";
			$obj->setVar("faq_online", $online);
			
         if ($faqHandler->insert($obj)) {
	         if (($xoopsModuleConfig['xfaqtag'] == 1) and (is_dir('../../tag'))){
	            if (isset($_REQUEST["faq_id"])) {
	                $faq_id = $_REQUEST['faq_id'];
	            }else{
	                $faq_id = $obj->get_new_enreg();
	            }
				   $tag_handler = xoops_getmodulehandler('tag', 'tag');
					$tag_handler->updateByItem($_POST["item_tag"], $faq_id , $xoopsModule->getVar("dirname"), $catid = 0);
			   }
	         redirect_header("faq.php?op=show_list_faq", 2, _AM_XFAQ_FORMOK);
         }
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
		$criteria->setOrder("DESC");
		$numrows = $faqHandler->getCount();
		$faq_arr = $faqHandler->getall($criteria);
		
		//Affichage du tableau
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
			        $criteria->setLimit($xoopsModuleConfig['itemperadmin']);
			        $limit = $xoopsModuleConfig['itemperadmin'];
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
			        $pagenav = new XoopsPageNav($numrows, $limit, $start, 'start', 'limit=' . $limit);
			        $pagenav = $pagenav->renderNav(4);
			    } else {
			        $pagenav = '';
			    }
			    
			    echo $pagenav;	
				 
				 /**
				 * end pagenav setting 
				 */		
		
			
			echo "<table width=\"100%\" cellspacing=\"1\" class=\"outer\">
				<tr>
					   <th align=\"center\">"._AM_XFAQ_FAQ_ID."</th>
					   <th align=\"center\">"._AM_XFAQ_FAQ_QUESTION."</th>
						<th align=\"center\">"._AM_XFAQ_FAQ_TOPIC."</th>
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
				   echo "<td align=\"center\">".$faq_arr[$i]->getVar("faq_id")."</td>";	
				   echo "<td align=\"center\">".$faq_arr[$i]->getVar("faq_question")."</td>";	
					$faq1 = $topicHandler->get($faq_arr[$i]->getVar("faq_topic"));
					$faq_topic1 = $faq1->getVar("topic_title");
					echo "<td align=\"center\">".$faq_topic1."</td>";	
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