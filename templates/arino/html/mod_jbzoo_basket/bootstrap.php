<?php
/**
 * JBZoo App is universal Joomla CCK, application for YooTheme Zoo component
 * @package     jbzoo
 * @version     2.x Pro
 * @author      JBZoo App http://jbzoo.com
 * @copyright   Copyright (C) JBZoo.com,  All rights reserved.
 * @license     http://jbzoo.com/license-pro.php JBZoo Licence
 * @coder       Denis Smetannikov <denis@jbzoo.com>
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

$cart = JBCart::getInstance();
$order = $modHelper->getOrder();
$currency = $modHelper->getCurrency();
$items = $modHelper->getBasketItems(array(
    'class' => array(
        'image' => 'thumbnail'
    )
));

?>
<div class="jbzoo jbcart-module jsJBZooCartModule" id="<?php echo $modHelper->getModuleId(); ?>">

    <?php
    $title = '';
    if ((int)$params->get('jbcart_totalsum', 1)) : ?>
        <?php $title = '<div class="jbcart-module-line">' . JText::_('JBZOO_CART_MODULE_TOTAL_SUM') . ':<span class="jbcart-module-total-value">' . $order->getTotalSum()->html($currency) . '</span></div>'; ?>
    <?php
    endif
    ?>

    <?php if ((int)$params->get('jbcart_button_gotocart', 1)): ?>
        <a rel="nofollow" class="jbcart-module-gotocart"
           href="<?php echo $modHelper->getBasketUrl(); ?>" data-html="true" data-toggle="tooltip" data-placement="bottom"
           title="В корзину. <?= htmlspecialchars($title); ?>">

            <i class="flaticon-shopping-cart-1"></i>

            <!--<img src="/modules/mod_jbzoo_basket/assets/images/cart-icon.svg" alt="cart">-->

            <?php if (empty($items)) : ?>
                <div class="jbcart-module-total-items jbcart-module-empty"><?php echo JText::_('JBZOO_CART_MODULE_EMPTY'); ?></div>
            <?php else: ?>

                <?php if ((int)$params->get('jbcart_items', 1)) : ?>
                    <div class="jbcart-module-items">

                        <?php foreach ($items as $itemKey => $cartItem) :
                            $attrs = array(
                                'data-key' => $itemKey,
                                'data-jbprice' => $cart->get($itemKey . '.element_id') . '-' . $cart->get($itemKey . '.item_id'),
                                'class' => array(
                                    $itemKey,
                                    'jsCartItem',
                                    'jbcart-module-item',
                                    'clearfix'
                                ),
                            );
                            ?>

                            <div <?php echo $modHelper->attrs($attrs); ?>>
                                <?php if ((int)$params->get('jbcart_item_delete', 1)) : ?>
                                    <span class="btn btn-danger btn-xs btn-mini round jsDelete jbcart-item-delete">
                                <?php echo $this->app->jbbootstrap->icon('remove', array('type' => 'white')); ?>
                            </span>
                                <?php endif; ?>

                                <?php if ((int)$params->get('jbcart_item_image', 1)) {
                                    echo $cartItem['image'];
                                } ?>

                                <?php echo $cartItem['name']; ?>

                                <?php if ((int)$params->get('jbcart_item_price', 1)) : ?>
                                    <div class="jbcart-item-price">
                                        <?php echo $cartItem['price4one']; ?>

                                        <?php if ((int)$params->get('jbcart_item_quantity', 1)) : ?>
                                            <span class="jbcart-item-price-multiple">x</span>
                                            <?php echo $cartItem['quantity']; ?>
                                        <?php endif; ?>

                                    </div>

                                <?php elseif ((int)$params->get('jbcart_item_quantity', 1)): ?>
                                    <?php echo $cartItem['quantity']; ?>
                                <?php endif; ?>

                                <?php if ((int)$params->get('jbcart_item_total', 1)) {
                                    echo $cartItem['totalsum'];
                                } ?>

                                <?php if ((int)$params->get('jbcart_item_params', 1)) {
                                    echo $cartItem['params'];
                                } ?>
                            </div>
                        <?php endforeach; ?>

                    </div>
                <?php endif; ?>

                <?php if ((int)$params->get('jbcart_count_items', 1)) : ?>
                    <span class="jbcart-module-total-items">
                    <?php echo $order->getTotalCount() . ' ' . JText::_('JBZOO_CART_COUNT_ABR'); ?>
                    </span>
                <?php endif ?>

            <?php endif; ?>

        </a>
    <?php endif ?>

</div>
