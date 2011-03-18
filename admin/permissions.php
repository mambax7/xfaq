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
 
include("header.php");

if( !empty($_POST["submit"]) ) 
{
	redirect_header( XOOPS_URL."/modules/".$xoopsModule->dirname()."/admin/permissions.php" , 1 , _MP_GPERMUPDATED );
}

xoops_cp_header();

global $xoopsDB;


	$permtoset= isset($_POST["permtoset"]) ? intval($_POST["permtoset"]) : 1;
	$selected=array("","","");
	$selected[$permtoset-1]=" selected";
	
echo "
<form method=\"post\" name=\"fselperm\" action=\"permissions.php\">
	<table border=0>
		<tr>
			<td>
				<select name=\"permtoset\" onChange=\"javascript: document.fselperm.submit()\">
					<option value=\"1\"".$selected[0].">"._AM_XFAQ_PERMISSIONS_ACCESS."</option>
					<option value=\"2\"".$selected[1].">"._AM_XFAQ_PERMISSIONS_SUBMIT."</option>
				</select>
			</td>
		</tr>
	</table>
</form>";

$module_id = $xoopsModule->getVar("mid");

	switch($permtoset)
	{
		case 1:
			$title_of_form = _AM_XFAQ_PERMISSIONS_ACCESS;
			$perm_name = "xfaq_access";
			$perm_desc = "";
			break;
		case 2:
			$title_of_form = _AM_XFAQ_PERMISSIONS_SUBMIT;
			$perm_name = "xfaq_submit";
			$perm_desc = "";
			break;
	}
	
	$permform = new XoopsGroupPermForm($title_of_form, $module_id, $perm_name, $perm_desc, "admin/permissions.php");
	$xt = new XoopsTopic( $xoopsDB -> prefix("xfaq_topic") );
	$alltopics =& $xt->getTopicsList();
	
	foreach ($alltopics as $topic_id => $topic) 
	{
		$permform->addItem($topic_id, $topic["title"], $topic["pid"]);
	}
//check if topics exist before rendering the form and redirect, if there are no topics	
$result_view = $xoopsDB->query("SELECT topic_id, topic_title FROM " . $xoopsDB->prefix("xfaq_topic") . " ");
if ($xoopsDB->getRowsNum($result_view)) {
    
	echo $permform->render();
	
} else {
redirect_header("topic.php", 2, _AM_XFAQ_NOPERMSSET, false);	
}	
	
	
	//echo $permform->render();
	
	echo "<br /><br /><br /><br />\n";
	unset ($permform);

xoops_cp_footer();
?>