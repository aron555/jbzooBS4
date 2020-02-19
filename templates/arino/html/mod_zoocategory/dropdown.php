<?php
/**
 * @package   ZOO Category
 * @author    YOOtheme http://www.yootheme.com
 * @copyright Copyright (C) YOOtheme GmbH
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

// include css
$zoo->document->addStylesheet('mod_zoocategory:tmpl/dropdown/style.css');

// include js
$zoo->document->addScript('mod_zoocategory:tmpl/dropdown/script.js');

echo $zoo->categorymodule->render($category, $params, 1, false, 'id="zoo-list-'.$category->alias.'" class="zoo-list dropdown-menu white z-depth-1 dropright"', true);