<?php
/*
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * @copyright    {@link https://xoops.org/ XOOPS Project}
 * @license      {@link http://www.gnu.org/licenses/gpl-2.0.html GNU GPL 2 or later}
 * @package
 * @since
 * @author       XOOPS Development Team
 * @author       DNPROSSI - 2010
 */

//Default Permission Settings
/**
 * @param $xoopsModule
 * @return bool
 */
function xoops_module_uninstall_xfaq(XoopsObject $xoopsModule)
{
    $module_id       = $xoopsModule->getVar('mid');
    $module_name     = $xoopsModule->getVar('name');
    $moduleDirName   = $xoopsModule->getVar('dirname');
    $module_version  = $xoopsModule->getVar('version');
    $module_original = $xoopsModule->getInfo('original');

    global $xoopsDB;
    //Delete contents of image uploads folder
    $rcsvDirs = array($moduleDirName, 'topics', 'images');
    while (0 !== count($rcsvDirs)) {
        $currentDir = XOOPS_UPLOAD_PATH . '/' . implode('/', $rcsvDirs);
        if (is_dir($currentDir)) {
            $uploadDirContents = scandir($currentDir, SCANDIR_SORT_NONE);
            foreach ($uploadDirContents as $thisFile) {
                if ($thisFile === '.' || $thisFile === '..') {
                    continue;
                }
                unlink("{$currentDir}/{$thisFile}");
            }
            rmdir($currentDir);
            array_pop($rcsvDirs);
        }
    }

    return true;
}
