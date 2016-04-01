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

/***************Blocks**************
 * @param $cats
 * @return string
 */
function block_addCatSelect($cats)
{
    if (is_array($cats)) {
        $cat_sql = '(' . current($cats);
        array_shift($cats);
        foreach ($cats as $cat) {
            $cat_sql .= ',' . $cat;
        }
        $cat_sql .= ')';
    }

    return $cat_sql;
}

/**
 * @param $permtype
 * @param $dirname
 * @return mixed
 */
function XFAQ_MygetItemIds($permtype, $dirname)
{
    global $xoopsUser;
    $module_handler = xoops_getHandler('module');
    $tdmModule      = $module_handler->getByDirname($dirname);
    $groups         = is_object($xoopsUser) ? $xoopsUser->getGroups() : XOOPS_GROUP_ANONYMOUS;
    $gperm_handler  = xoops_getHandler('groupperm');
    $categories     = $gperm_handler->getItemIds($permtype, $groups, $tdmModule->getVar('mid'));

    return $categories;
}

/**
 * @param        $global
 * @param        $key
 * @param string $default
 * @param string $type
 * @return mixed|string
 */
function XFAQ_CleanVars(&$global, $key, $default = '', $type = 'int')
{
    switch ($type) {
        case 'string':
            $ret = isset($global[$key]) ? filter_var($global[$key], FILTER_SANITIZE_MAGIC_QUOTES) : $default;
            break;
        case 'int':
        default:
            $ret = isset($global[$key]) ? filter_var($global[$key], FILTER_SANITIZE_NUMBER_INT) : $default;
            break;
    }
    if ($ret === false) {
        return $default;
    }

    return $ret;
}
