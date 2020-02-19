<?php
/**
 * @package   ZOO Category
 * @author    YOOtheme http://www.yootheme.com
 * @copyright Copyright (C) YOOtheme GmbH
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

$addToggle = $params->get('add_toggle');

// include css
$zoo->document->addStylesheet('mod_jbzoo_accordion:tmpl/megamenu/style.css');

// include js
$zoo->document->addScript('mod_jbzoo_accordion:tmpl/megamenu/script.js');

$class = '';
if ($addToggle) {
    $class = " d-none";
    $zoo->document->addScript('mod_jbzoo_accordion:tmpl/toggle.js');
} else {
    $class = " add-padding-item";
}

?>
<div class="smuzi-megamenu position-absolute mx-auto w-100 zoo-list d-none">
    <div class="smuzi-megamenu-2 row">
        <div class="col-md-3">
            <div class="smuzi-megamenu-left">
                <?php
                echo $zoo->categorymodule->render($category, $params, $flat = "megamenu", $level = 0, 'id="zoo-list-' . $category->alias . '" class="zoo-list-megamenu"', false);
                ?>
            </div>
        </div>
        <div class="col-md-9">
            <div class="smuzi-megamenu-right">
                <?php

                $show1level = ($nextLevel==1) ? '' : 'd-none';

                echo $zoo->categorymodule->render($category, $params, $flat = "megamenu", $level = 1, 'id="zoo-list-' . $category->alias . '" class="zoo-list-megamenu"', true);
                ?>
            </div>
        </div>

    </div>
</div>
<?


?>

