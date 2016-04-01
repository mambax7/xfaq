<?php
/**
 * ****************************************************************************
 *  - TDMAssoc By TDM   - TEAM DEV MODULE FOR XOOPS
 *  - GNU Licence Copyright (c)  (http://www.)
 *
 * La licence GNU GPL, garanti � l'utilisateur les droits suivants
 *
 * 1. La libert� d'ex�cuter le logiciel, pour n'importe quel usage,
 * 2. La libert� de l' �tudier et de l'adapter � ses besoins,
 * 3. La libert� de redistribuer des copies,
 * 4. La libert� d'am�liorer et de rendre publiques les modifications afin
 * que l'ensemble de la communaut� en b�n�ficie.
 *
 * @copyright           (http://www.)
 * @license         http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author          TDM ; TEAM DEV MODULE
 *
 * ****************************************************************************
 */

if (!defined('XOOPS_ROOT_PATH')) {
    die('XOOPS root path not defined');
}

/**
 * @param $queryarray
 * @param $andor
 * @param $limit
 * @param $offset
 * @param $userid
 * @return array
 */
function xfaq_search($queryarray, $andor, $limit, $offset, $userid)
{
    global $xoopsDB;

    global $xoopsDB;
    $sql = 'SELECT * FROM ' . $xoopsDB->prefix('xfaq_faq') . '';
    if (is_array($queryarray) && $count = count($queryarray)) {
        $sql .= " WHERE faq_open = 1 AND((faq_question LIKE '$queryarray[0]' OR faq_answer LIKE
               '$queryarray[0]')";
        for ($i = 1; $i < $count; $i++) {
            $sql .= " $andor ";
            $sql .= "(faq_question LIKE '$queryarray[$i]' OR faq_answer LIKE
                               '$queryarray[$i]')";
        }
        $sql .= ') ';
    }
    $sql .= 'ORDER BY faq_id DESC';
    $query = $xoopsDB->query('SELECT COUNT(*) FROM ' . $xoopsDB->prefix('xfaq_faq') . ' WHERE faq_id>0');
    list($numrows) = $xoopsDB->fetchrow($query);

    $result = $xoopsDB->query($sql, $limit, $offset);
    $ret    = array();
    $i      = 0;
    while ($myrow = $xoopsDB->fetchArray($result)) {
        $ret[$i]['image'] = 'assets/images/icons/search.png';
        $ret[$i]['link']  = 'index.php?cid=' . $myrow['faq_topic'];
        $ret[$i]['title'] = $myrow['faq_question'];
        $ret[$i]['time']  = formatTimestamp($myrow['faq_date_created']);
        $ret[$i]['uid']   = $myrow['faq_submitter'];
        $i++;
    }

    return $ret;
}
