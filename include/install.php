<?php
// 
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                  Copyright (c) 2000-2016 XOOPS.org                        //
//                         <https://xoops.org/>                               //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
//  DNPROSSI - 2010
//  ------------------------------------------------------------------------ //

include_once __DIR__ . '/functions.php';

/**
 * @return bool
 */
function xoops_module_install_xfaq()
{
    global $xoopsModule, $xoopsConfig;

    //Create directory /xfaq
    $dir = XOOPS_UPLOAD_PATH . '/xfaq';
    //    if (!is_dir($dir)) {
    //        mkdir($dir, 0705);
    if (!@mkdir($dir, 0757) && !is_dir($dir)) {
        throw Exception("Couldn't create this directory: " . $dir);
    }

    chmod($dir, 0705);

    //Create directory /xfaq
    $dir = XOOPS_ROOT_PATH . '/uploads/xfaq';
    //    if (!is_dir($dir)) {
    //        mkdir($dir, 0705);
    if (!@mkdir($dir, 0757) && !is_dir($dir)) {
        throw Exception("Couldn't create this directory: " . $dir);

    }

    chmod($dir, 0705);

    //Create directory /xfaq/topics/
    $dir = XOOPS_ROOT_PATH . '/uploads/xfaq/topics';
    //        mkdir($dir, 0705);
    if (!@mkdir($dir, 0757) && !is_dir($dir)) {
        throw Exception("Couldn't create this directory: " . $dir);
    }
    chmod($dir, 0705);

    //Create uploads directory /xfaq/topics/images/
    $dir = XOOPS_ROOT_PATH . '/uploads/xfaq/topics/images';
    //    if (!is_dir($dir)) {
    //        mkdir($dir, 0705);
    if (!@mkdir($dir, 0757) && !is_dir($dir)) {
        throw Exception("Couldn't create this directory: " . $dir);
    }
    chmod($dir, 0705);

    //Copy index.html
    $indexFile = XOOPS_ROOT_PATH . '/modules/xfaq/include/index.html';
    copy($indexFile, XOOPS_ROOT_PATH . '/uploads/xfaq/index.html');
    copy($indexFile, XOOPS_ROOT_PATH . '/uploads/xfaq/topics/index.html');
    copy($indexFile, XOOPS_ROOT_PATH . '/uploads/xfaq/topics/images/index.html');
    //Copy images
    copy(XOOPS_ROOT_PATH . '/modules/xfaq/assets/images/topics/blank.png', XOOPS_ROOT_PATH . '/uploads/xfaq/topics/images/blank.png');
    copy(XOOPS_ROOT_PATH . '/modules/xfaq/assets/images/topics/xoops.gif', XOOPS_ROOT_PATH . '/uploads/xfaq/topics/images//xoops.gif');

    return true;
}
