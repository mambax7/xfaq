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

global $xoopsModule;

//Apelle du menu admin
if ( !is_readable(XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php"))	{
xfaq_adminmenu(0, _AM_XFAQ_MANAGER_INDEX);
} else {
include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php";
loadModuleAdminMenu (0, _AM_XFAQ_MANAGER_INDEX);
}

	//compte "total"
	$count_topic = $topicHandler->getCount();
	//compte "attente"
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria("topic_online", 1));
	$topic_online = $topicHandler->getCount($criteria);
	
	//compte "total"
	$count_faq = $faqHandler->getCount();
	//compte "attente"
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria("faq_online", 1));
	$faq_online = $faqHandler->getCount($criteria);
	
include_once XOOPS_ROOT_PATH."/modules/xfaq/class/menu.php";

	$menu = new xfaqMenu();
	$menu->addItem("topic", "topic.php", "../images/deco/topic.png", _AM_XFAQ_MANAGER_TOPIC);$menu->addItem("faq", "faq.php", "../images/deco/faq.png", _AM_XFAQ_MANAGER_FAQ);
	$menu->addItem("update", "../../system/admin.php?fct=modulesadmin&op=update&module=xfaq", "../images/deco/update.png",  _AM_XFAQ_MANAGER_UPDATE);	
	$menu->addItem("permissions", "permissions.php", "../images/deco/permissions.png", _AM_XFAQ_MANAGER_PERMISSIONS);
	$menu->addItem("preference", "../../system/admin.php?fct=preferences&amp;op=showmod&amp;mod=".$xoopsModule->getVar("mid").
												"&amp;&confcat_id=1", "../images/deco/pref.png", _AM_XFAQ_MANAGER_PREFERENCES);
	$menu->addItem("about", "about.php", "../images/deco/about.png", _AM_XFAQ_MANAGER_ABOUT);
	
	echo $menu->getCSS();
	

echo "<div class=\"CPbigTitle\" style=\"background-image: url(../images/deco/index.png); background-repeat: no-repeat; background-position: left; padding-left: 50px;\"><strong>"._AM_XFAQ_MANAGER_INDEX."</strong></div><br />
		<table width=\"100%\" border=\"0\" cellspacing=\"10\" cellpadding=\"4\">
			<tr>
				<td valign=\"top\">".$menu->render()."</td>
				<td valign=\"top\" width=\"60%\">";
				
					echo "<fieldset>
						<legend class=\"CPmediumTitle\">"._AM_XFAQ_MANAGER_TOPIC."</legend>
						<br />";
						printf(_AM_XFAQ_THEREARE_TOPIC, $count_topic);
						echo "<br /><br />";
						printf(_AM_XFAQ_THEREARE_TOPIC_ONLINE, $topic_online);
						echo "<br />
					</fieldset><br /><br />";
					
					echo "<fieldset>
						<legend class=\"CPmediumTitle\">"._AM_XFAQ_MANAGER_FAQ."</legend>
						<br />";
						printf(_AM_XFAQ_THEREARE_FAQ, $count_faq);
						echo "<br /><br />";
						printf(_AM_XFAQ_THEREARE_FAQ_ONLINE, $faq_online);
						echo "<br />
					</fieldset><br /><br />";
					
				echo "</td>
			</tr>
		</table>
<br />
";
xoops_cp_footer();

?>