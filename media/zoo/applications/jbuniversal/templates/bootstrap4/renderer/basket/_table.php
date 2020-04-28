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
<div class="card jsJBZooCartTable text-center text-md-left">
    <div class="card-header d-none d-sm-block bg-light">
        <div class="row">
            <?php if ($config->get('tmpl_image_show', 1)) {
                ?>
                <div class="col-12 col-md-2 jbcart-col-image">

                </div>
                <?php
            } ?>
            <div class="col-12 col-md-3 jbcart-col-name">
                <?php echo JText::_('JBZOO_CART_ITEM_NAME'); ?>
            </div>
            <div class=" col-12 col-md-2 jbcart-col-price">
                <?php if ($config->get('tmpl_price4one', 1)) {
                    echo JText::_('JBZOO_CART_ITEM_PRICE');
                } ?>
            </div>
            <div class="col-12 col-md-3 jbcart-col-quantity w-auto text-nowrap">
                <?php if ($config->get('tmpl_quntity', 1)) {
                    echo JText::_('JBZOO_CART_ITEM_QUANTITY');
                } ?>
            </div>
            <div class="col-12 col-md jbcart-col-subtotal d-none d-sm-flex">
                <?php if ($config->get('tmpl_subtotal', 1)) {
                    echo JText::_('JBZOO_CART_ITEM_SUBTOTAL');
                } ?>
            </div>
        </div>
    </div>

    <div class="card-body">
        <?php foreach ($view->itemsHtml as $itemKey => $itemHtml) : ?>
            <div class="row jsCartTableRow mb-2 js<?php echo $itemKey; ?>" data-key="<?php echo $itemKey; ?>">

                <?php if ($config->get('tmpl_image_show', 1)) {
                    ?>
                    <div class="col-12 col-md-2 jbcart-image">
                        <?php
                        echo $itemHtml['image'];
                        ?>
                    </div>
                    <?php
                } ?>

                <div class="col-12 col-md-3 jbcart-name">
                    <?php echo $itemHtml['name']; ?>
                    <?php if ($config->get('tmpl_sku_show', 1)) {
                        echo $itemHtml['sku'];
                    } ?>
                    <?php echo $itemHtml['params']; ?>
                </div>
                <div class="col-12 col-md-2 jbcart-price">
                    <?php
                    if ($config->get('tmpl_price4one', 1)) {
                        echo $itemHtml['price4one'];
                    } ?>
                </div>
                <div class="col-12 col-md-3 jbcart-quantity text-nowrap w-auto">
                    <div class="row">
                        <div class="col-md-auto col-6">
                            <?php
                            if ($config->get('tmpl_quntity', 1)) {
                                echo $itemHtml['quantityEdit'];
                            } ?>
                        </div>
                        <div class="jbcart-subtotal col-md-auto col-6">
                            <a class="btn btn-danger jsDelete">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md jbcart-subtotal d-none d-sm-flex">
                    <?php if ($config->get('tmpl_subtotal', 1)) {
                        echo $itemHtml['totalsum'];
                    } ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="card-footer bg-light">
        <?php
        if (!empty($view->items) && !empty($view->modifierPrice)) {
            $this->app->jbassets->less('jbassets:less/cart/modifier.less');
            echo $view->modifierOrderPriceRenderer->render('modifier.default', array('order' => $view->order));
        } ?>

        <div class="jbcart-row-total row">
            <div class="col-12 col-md-4 jbcart-total-cell">
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
            </div>
            <div class="col-12 col-md-4 jbcart-shipping-cell">
                <?php if ($view->shipping) : ?>
                    <div class="jbcart-label">
                        <?php echo JText::_('JBZOO_CART_TABLE_SHIPPING'); ?>:
                    </div>
                    <div class="jbcart-value jsShippingPrice">
                        <?php echo $order->getShippingPrice()->html(); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-12 col-md-4 jbcart-total-price-cell">
                <div class="jbcart-label">
                    <?php echo JText::_('JBZOO_CART_TABLE_TOTAL_SUM'); ?>:
                </div>
                <div class="jbcart-value jsTotal">
                    <?php echo $order->getTotalSum()->html(); ?>
                </div>
            </div>
        </div>
    </div>
</div>


