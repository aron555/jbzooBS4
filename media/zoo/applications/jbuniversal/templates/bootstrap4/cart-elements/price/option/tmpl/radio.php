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
defined('_JEXEC') or die('Restricted access'); ?>

<div class="jbprice-option-radio block-parametrov d-flex flex-column">

    <?php
    foreach ($data as $key => $item) {
        $item2 = '<span>'.$item.'</span>';
        //echo "<pre>";var_dump($item2);echo "</pre>";
        $data[] = $item2;
    }
    ?>

    <?php echo $this->_jbhtml->radio($data, $this->getRenderName('value'), null, $this->getValue(), false, false, true); ?>

</div>
