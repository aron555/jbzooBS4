<?php
/**
 * @package Helix Ultimate Framework
 * @author JoomShaper https://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2018 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */

defined('_JEXEC') or die();

?>
<div class="search">
    <form action="<?php echo JRoute::_('index.php'); ?>" method="post">

        <div class="input-group">
            <i class="fa fa-search"></i>
            <input name="searchword" id="mod-search-searchword<?= $module->id ?>" class="form-control" type="search"
                   placeholder="<?= $text ?>">
            <button class="z-depth-0 go-search" title="Поиск" onclick="this.form.searchword.focus();"><i class="fa fa-level-down fa-rotate-90"></i>
            </button>
        </div>

        <input type="hidden" name="task" value="search">
        <input type="hidden" name="option" value="com_search">
        <input type="hidden" name="Itemid" value="<?php echo $mitemid; ?>">
    </form>
</div>
