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

$config  = $this->config;
$payment = $order->getPayment();

if (!$this->config->get('payment', 1)) {
    return;
}

?>


<?php if ($payment && !$payment->getRate()->isEmpty()) : ?>
    <tr>
        <td colspan="2" style="border-bottom: none;"></td>

        <td <?php echo $this->getStyles(); ?>>
            <p><strong><?php echo JText::_('JBZOO_ELEMENT_EMAIL_ITEMS_PAYMENT_RATE'); ?></strong></p>
        </td>

        <td colspan="2" <?php echo $this->getStyles(); ?>>
            <?php echo $payment->getName(); ?>
            <em>(
                <?php
                if ($payment->isModify()) {
                    echo JText::_('JBZOO_ELEMENT_EMAIL_ITEMS_PAYMENT_RATE_INCLUDED');
                } else {
                    echo JText::_('JBZOO_ELEMENT_EMAIL_ITEMS_PAYMENT_RATE_NOT_INCLUDED');
                }
                ?>
            )</em>
        </td>

        <td colspan="1" <?php echo $this->getStyles(array('border-bottom' => '1px solid #dddddd')); ?>>
            <strong><?php echo $payment->getRate()->html($this->_getCurrency()); ?></strong>
        </td>
    </tr>
<?php endif;
