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

$payment = $order->getPayment();

?>

<table <?php echo $this->getAttrs(array(
    'width'       => '100%'
)); ?>>

    <tr>
        <td style="width:40%; vertical-align: top; padding: 0 0 6px 0;">
            <strong><?php echo JText::_('JBZOO_ELEMENT_EMAIL_PAYMENT_METHOD'); ?></strong>
        </td>

        <td style="vertical-align: top; padding: 0 0 6px 0;"><?php echo $payment->getName(); ?></td>
    </tr>

    <tr>
        <td style="vertical-align: top; padding: 0 0 6px 0;">
            <strong><?php echo JText::_('JBZOO_ELEMENT_EMAIL_PAYMENT_COMMISSION'); ?></strong>
        </td>
        <td style="vertical-align: top; padding: 0 0 6px 0;">
            <?php echo $payment->getRate()->html(); ?>
        </td>
    </tr>

</table>