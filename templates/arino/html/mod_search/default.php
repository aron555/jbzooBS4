<?php
/**
 * @package Helix Ultimate Framework
 * @author JoomShaper https://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2018 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */

defined ('_JEXEC') or die();

?>
<div class="search">
    <form action="<?php echo JRoute::_('index.php'); ?>" method="post">
        <?php
        $output = '';
        $output .= '<div class="input-group">';
        $output .= '<input name="searchword" id="mod-search-searchword' . $module->id . '" class="form-control" type="search" placeholder="' . $text . '">';
        $output .= '<span class="input-group-btn">';
        $output .= '<button class="btn btn-primary" onclick="this.form.searchword.focus();"><i class="fa fa-search"></i></button>';
        $output .= '</span>';
        $output .= '</div>';

        echo $output;
        ?>
        <input type="hidden" name="task" value="search">
        <input type="hidden" name="option" value="com_search">
        <input type="hidden" name="Itemid" value="<?php echo $mitemid; ?>">
    </form>
</div>
