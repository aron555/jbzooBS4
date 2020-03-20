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

$shipping = $this->getOrder()->getShipping();

?>
<table <?php echo $this->getAttrs(array(
    'width'       => '100%'
)); ?>>

    <tr>
        <td style="width: 40%; vertical-align: top; padding: 0 0 6px 0;">
            <strong><?php echo JText::_('JBZOO_ELEMENT_EMAIL_SHIPPING_METHOD'); ?></strong>
        </td>

        <td style="vertical-align: top; padding: 0 0 6px 0;">
            <?php echo $shipping->getName(); ?>
        </td>
    </tr>

    <tr>
        <td style="vertical-align: top; padding: 0 0 6px 0;">
            <strong><?php echo JText::_('JBZOO_ELEMENT_EMAIL_SHIPPING_PRICE'); ?></strong>
        </td>

        <td style="vertical-align: top; padding: 0 0 6px 0;">
            <?php echo $shipping->getRate(); ?>
        </td>
    </tr>

    <tr>
        <td style="vertical-align: top; padding: 0 0 6px 0;">
            <strong><?php echo JText::_('JBZOO_ELEMENT_EMAIL_SHIPPING_INFO'); ?></strong>
        </td>

        <td style="vertical-align: top; padding: 0 0 6px 0;">
            <?php
            $shippingRender = $this->app->jbrenderer->create('Shipping');
            echo $shippingRender->renderAdminEdit(array('order' => $order, 'style' => 'none'));

            if ($this->config->get('fields', 1)) {
                $shippingFieldsRender = $this->app->jbrenderer->create('ShippingFields');
                echo $shippingFieldsRender->renderAdminEdit(array('order' => $order));
            }
            ?>
        </td>
    </tr>

</table>
