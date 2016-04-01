<?php
/**
 * xfaq
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright   Gregory Mage (Aka Mage)
 * @license     GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @author      Gregory Mage (Aka Mage)
 * @param $items
 * @return bool
 */

function xfaq_tag_iteminfo(&$items)
{
    if (empty($items) || !is_array($items)) {
        return false;
    }

    $items_id = array();
    foreach (array_keys($items) as $cat_id) {
        foreach (array_keys($items[$cat_id]) as $item_id) {
            $items_id[] = (int)$item_id;
        }
    }

    $item_handler = xoops_getModuleHandler('Faq', 'xfaq');
    $items_obj    = $item_handler->getObjects(new Criteria('faq_id', '(' . implode(', ', $items_id) . ')', 'IN'), true);

    foreach (array_keys($items) as $cat_id) {
        foreach (array_keys($items[$cat_id]) as $item_id) {
            if (isset($items_obj[$item_id])) {
                $item_obj                 = $items_obj[$item_id];
                $items[$cat_id][$item_id] = array(
                    'title'   => $item_obj->getVar('faq_question'),
                    'uid'     => $item_obj->getVar('faq_submitter'),
                    'link'    => 'index.php',
                    'time'    => $item_obj->getVar('faq_date_created'),
                    'tags'    => '',
                    'content' => '');
            }
        }
    }
    unset($items_obj);
}

/**
 * @param $mid
 */
function xfaq_tag_synchronization($mid)
{
    {
        $item_handler = xoops_getModuleHandler('Faq', 'xfaq');
        $link_handler = xoops_getModuleHandler('link', 'tag');

        /* clear tag-item links */
        if (version_compare(mysqli_get_server_info(), '4.1.0', 'ge')):
            $sql = "    DELETE FROM {$link_handler->table}" . '    WHERE ' . "        tag_modid = {$mid}" . '        AND ' . '        ( tag_itemid NOT IN ' . "            ( SELECT DISTINCT {$item_handler->keyName} " . "                FROM {$item_handler->table} " . "                WHERE {$item_handler->table}.status > 0" . '            ) ' . '        )';
        else:
            $sql = "    DELETE {$link_handler->table} FROM {$link_handler->table}" . "    LEFT JOIN {$item_handler->table} AS aa ON {$link_handler->table}.tag_itemid = aa.{$item_handler->keyName} " . '    WHERE ' . "        tag_modid = {$mid}" . '        AND ' . "        ( aa.{$item_handler->keyName} IS NULL" . '            OR aa.status < 1' . '        )';
        endif;
        if (!$result = $link_handler->db->queryF($sql)) {
            //xoops_error($link_handler->db->error());
        }
    }
}
