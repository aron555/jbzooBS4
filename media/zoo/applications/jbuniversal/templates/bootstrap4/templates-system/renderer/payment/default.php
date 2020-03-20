<?php
/**
 * JBZoo Application
 *
 * This file is part of the JBZoo CCK package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package    Application
 * @license    GPL-2.0
 * @copyright  Copyright (C) JBZoo.com, All rights reserved.
 * @link       https://github.com/JBZoo/JBZoo
 * @author     Denis Smetannikov <denis@jbzoo.com>
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

$bootstrap = $this->app->jbbootstrap;
$rowClass  = $bootstrap->getRowClass();

if ($this->checkPosition('list')) : ?>
    <div class="jbcart-payment">
        <h5 class="jbcart-title py-3">
            <?= JText::_('JBZOO_CART_PAYPMENT_TITLE'); ?>
        </h5>
        <?php
        echo $this->renderPosition('list', array(
            'style' => 'order.payment',
            'rowAttrs' => array(
                'class' =>  array(
                    'row',
                ),
            ),
            'column' => '3'
        ));
        ?>
    </div>
<?php endif;
