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

$view = $this->getView();

?>

<?php if (count($view->items) == 0) : ?>
    <p class="jbcart-empty-message">
        <?php echo JText::_('JBZOO_CART_ITEMS_NOT_FOUND'); ?>
    </p>
<?php else:

    //$this->app->jbassets->less(array('jbassets:less/general/cart.less'));

    $this->app->jbassets->widget('.jbzoo .jsJBZooCart', 'JBZoo.Cart', array(
        'text_remove_all'  => JText::_('JBZOO_CART_CLEANUP'),
        'text_remove_item' => JText::_('JBZOO_CART_REMOVE_ITEM'),
        'url_shipping'     => $this->app->jbrouter->basketShipping(),
        'url_quantity'     => $this->app->jbrouter->basketQuantity(),
        'url_delete'       => $this->app->jbrouter->basketDelete(),
        'url_clear'        => $this->app->jbrouter->basketClear(),
        'items'            => $view->order->getItems(false),
    ));

    $formAttrs = array(
        'action'         => $this->app->jbrouter->cartOrderCreate(),
        'method'         => 'post',
        'name'           => 'jbcartForm',
        'accept-charset' => 'utf-8',
        'enctype'        => 'multipart/form-data',
        'class'          => array(
            'jbcart',
            'jsJBZooCart',
        ),
    );

    ?>
    <form <?php echo $this->app->jbhtml->buildAttrs($formAttrs); ?>>

        <?php echo $this->partial('basket', 'validators'); ?>
        <?php echo $this->partial('basket', 'table'); ?>
        <?php echo $this->partial('basket', 'form'); ?>
        <?php echo $this->partial('basket', 'shipping'); ?>
        <?php echo $this->partial('basket', 'payment'); ?>
        <?php echo $this->partial('basket', 'buttons'); ?>
        <?php echo $this->partial('basket', 'mobile_tools'); ?>

        <?php
        // system fields
        echo $this->app->jbhtml->hiddens(array(
                'option'     => 'com_zoo',
                'controller' => 'basket',
                'task'       => 'index',
                'Itemid'     => $view->Itemid,
            ))
            . $this->app->html->_('form.token');
        ?>
    </form>

<!--<script>
    jQuery(function($){
        $('input[type=radio]').on('change', function() {

            //только для корзины Оплатить сбербанк
            if (this.value === "00ee9906-39f8-49c5-8304-64339b0482ae") {
                $('input[name=create-pay]').show();
            } else {
                $('input[name=create-pay]').hide();
            }
        });
    });
</script>-->

<?php endif;
