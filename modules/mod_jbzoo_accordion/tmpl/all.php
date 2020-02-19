<?php
/**
 * @package   ZOO Category
 * @author    YOOtheme http://www.yootheme.com
 * @copyright Copyright (C) YOOtheme GmbH
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

// no direct access
defined('_JEXEC') or die('Restricted access');
?>
    <div class="d-none d-md-block">
        <?php
        require_once "modules/mod_jbzoo_accordion/tmpl/dropdown.php";
        //echo $zoo->categorymodule->render($category, $params, $flat = "dropdown", $level = 1, 'id="zoo-dropdown-list-'.$category->alias.'" class="zoo-list dropdown-menu white z-depth-1 dropright"', true);
        ?>
    </div>

    <div class="d-block d-md-none">
        <?php
        require_once "modules/mod_jbzoo_accordion/tmpl/accordion.php";
        //echo $zoo->categorymodule->render($category, $params, $flat = "accordion", $level = 1, 'id="zoo-accordion-list-'.$category->alias.'" class="list-group zoo-list'.$class.'"', true);
        ?>
    </div>
<?php

