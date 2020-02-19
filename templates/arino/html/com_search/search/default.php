<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_search
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
//JHtml::_('formbehavior.chosen', 'select');

?>

<div class="jbzoo search<?php echo $this->pageclass_sfx; ?>">

    <?php if ($this->params->get('show_page_heading')) : ?>
        <h1 class="page-title">
            <?php
            if ($this->escape($this->params->get('page_heading'))) {
                echo $this->escape($this->params->get('page_heading'));
            } else {
                echo $this->escape($this->params->get('page_title'));
            }
            ?>
        </h1>
    <?php endif; ?>


    <?php

    //echo $this->loadTemplate('form');


    if ($this->error == null && count($this->results) > 0) {
        echo $this->loadTemplate('results');
    } else {
        echo $this->loadTemplate('error');
    }

    ?>

</div>
