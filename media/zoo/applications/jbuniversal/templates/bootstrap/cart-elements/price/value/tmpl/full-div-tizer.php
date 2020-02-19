<?php
/**
 * JBZoo App is universal Joomla CCK, application for YooTheme Zoo component
 * @package     jbzoo
 * @version     2.x Pro
 * @author      JBZoo App http://jbzoo.com
 * @copyright   Copyright (C) JBZoo.com,  All rights reserved.
 * @license     http://jbzoo.com/license-pro.php JBZoo Licence
 * @coder       Alexander Oganov <t_tapak@yahoo.com>
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

if ($price->compare($total)) {
    return;
}

?>




<div class="jbprice-value-row row-fluid">
        <span class="jbprice-value-label col-xs-4 col-md-4"><?php echo JText::_('От:'); ?></span>
        <span class="jbprice-value-total col-xs-8 col-md-8"><?php echo $total->html($currency); ?></span>
    </div>
