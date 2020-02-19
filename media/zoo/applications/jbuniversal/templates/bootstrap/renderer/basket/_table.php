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

$cart = JBCart::getInstance();
$order = $cart->newOrder();
$config = $cart->getConfig();
?>
<div class="table-responsive ">
    <table class="table table-bordered jsJBZooCartTable">
        <thead>
        <tr>
            <th scope="col" class="jbcart-col-name">
                <?php echo JText::_('JBZOO_CART_ITEM_NAME'); ?>
            </th>
            <th scope="col" class="jbcart-col-price">
                <?php if ($config->get('tmpl_price4one', 1)) {
                    echo JText::_('JBZOO_CART_ITEM_PRICE');
                } ?>
            </th>
            <th scope="col" class="jbcart-col-quantity w-auto text-nowrap">
                <?php if ($config->get('tmpl_quntity', 1)) {
                    echo JText::_('JBZOO_CART_ITEM_QUANTITY');
                } ?>
            </th>
            <th scope="col" class="jbcart-col-subtotal d-none d-sm-table-cell">
                <?php if ($config->get('tmpl_subtotal', 1)) {
                    echo JText::_('JBZOO_CART_ITEM_SUBTOTAL');
                } ?>
            </th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($view->itemsHtml as $itemKey => $itemHtml) : ?>
            <tr class="jbcart-row jsCartTableRow js<?php echo $itemKey; ?>" data-key="<?php echo $itemKey; ?>">
                <td class="jbcart-name">
                    <?php echo $itemHtml['name']; ?>
                    <?php if ($config->get('tmpl_sku_show', 1)) {
                        echo $itemHtml['sku'];
                    } ?>
                    <?php echo $itemHtml['params']; ?>
                </td>
                <td class="jbcart-price">
                    <?php
                    if ($config->get('tmpl_price4one', 1)) {
                        echo $itemHtml['price4one'];
                    } ?>
                </td>
                <td class="jbcart-quantity text-nowrap w-auto">
                    <div class="row">
                        <div class="col-md-auto col-12">
                            <?php
                            if ($config->get('tmpl_quntity', 1)) {
                                echo $itemHtml['quantityEdit'];
                            } ?>
                        </div>
                        <div class="jbcart-subtotal col-md-auto col-12">
                            <a class="btn btn-danger btn-xs btn-small round jsDelete">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                    </div>
                </td>
                <td class="jbcart-subtotal d-none d-sm-table-cell">
                    <?php if ($config->get('tmpl_subtotal', 1)) {
                        echo $itemHtml['totalsum'];
                    } ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="table-responsive">
    <table class="table table-bordered">
        <tbody>
        <?php
        if (!empty($view->items) && !empty($view->modifierPrice)) {
            $this->app->jbassets->less('jbassets:less/cart/modifier.less');
            echo $view->modifierOrderPriceRenderer->render('modifier.default', array('order' => $view->order));
        } ?>

        <tr class="jbcart-row-total">
            <td class="jbcart-total-cell">
                <div class="jbcart-items-in-cart">
                    <span class="jbcart-label">
                        <?php echo JText::_('JBZOO_CART_TABLE_TOTAL_COUNT'); ?>:
                    </span>
                    <span class="jbcart-value jsTotalCount">
                        <?php echo $order->getTotalCount(); ?>
                    </span>
                </div>
                <div class="jbcart-price-of-goods">
                    <span class="jbcart-label">
                        <?php echo JText::_('JBZOO_CART_TABLE_SUBTOTAL_SUM'); ?>:
                    </span>
                    <span class="jbcart-value jsTotalPrice">
                        <?php echo $order->getTotalForItems()->html(); ?>
                    </span>
                </div>
            </td>
            <td class="jbcart-shipping-cell">
                <?php if ($view->shipping) : ?>
                    <div class="jbcart-label">
                        <?php echo JText::_('JBZOO_CART_TABLE_SHIPPING'); ?>:
                    </div>
                    <div class="jbcart-value jsShippingPrice">
                        <?php echo $order->getShippingPrice()->html(); ?>
                    </div>
                <?php endif; ?>
            </td>
            <td class="jbcart-total-price-cell">
                <div class="jbcart-label">
                    <?php echo JText::_('JBZOO_CART_TABLE_TOTAL_SUM'); ?>:
                </div>
                <div class="jbcart-value jsTotal">
                    <?php echo $order->getTotalSum()->html(); ?>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>
