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

$config   = $this->config;
$shipping = $order->getShipping();

if (!$this->config->get('shipping', 1)) {
    return;
}

?>

<?php if ($shipping && !$shipping->getRate()->isEmpty()) : ?>
    <tr style="border-bottom: 1px solid #dddddd;">
        <td style="padding: 10px; border-bottom: 1px solid #dddddd" colspan="3">
            <table style="width: 100%;">
                <tr>
                    <td style="padding: 0 10px">
                        <p>
                            <strong>
                                <?php echo JText::_('JBZOO_ELEMENT_EMAIL_ITEMS_SHIPPING_RATE'); ?>
                            </strong>
                        </p>
                    </td>
                    <td style="padding: 10px">
                        <?php echo $shipping->getName(); ?>
                        <em>(
                            <?php
                            if ($shipping->isModify()) {
                                echo JText::_('JBZOO_ELEMENT_EMAIL_ITEMS_SHIPPING_RATE_INCLUDED');
                            } else {
                                echo JText::_('JBZOO_ELEMENT_EMAIL_ITEMS_SHIPPING_RATE_NOT_INCLUDED');
                            }
                            ?>
                            )
                        </em>
                    </td>
                    <td style="padding: 10px">
                        <strong><?php echo $shipping->getRate()->html($this->_getCurrency()); ?></strong>
                    </td>
                </tr>
            </table>

        </td>
    </tr>
<?php endif;
