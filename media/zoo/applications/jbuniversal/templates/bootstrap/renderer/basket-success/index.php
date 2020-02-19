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

$this->app->document->setTitle(JText::_('JBZOO_CART_ITEMS'));
$view = $this->getView();
$myorderid = $view->order->id;
$order = JBModelOrder::model()->getById($myorderid);
$cartItems = $order->getItems(false);

$message = \Joomla\String\StringHelper::str_ireplace('$1', $order->id, JText::_('JBZOO_PAYMENT_SUCCESS_MESSAGE'));
$manager_message = JText::_('JBZOO_CART_ORDER_SUCCESS_MANAGER');

foreach ($cartItems as $cartItem) {
    $itemPrice = $order->val($cartItem->get('total'));
    $yaParams['goods'][] = array(
        'id' => $cartItem->get('item_id'),
        'name' => $cartItem->get('item_name'),
        'price' => $itemPrice->val(),
        'quantity' => $cartItem->get('quantity', 1),
    );
}



$mydatecreat = date('d.m.Y H:i:s', strtotime("+0 hours", strtotime($order->created)));

?>
<div class="card mx-auto w-auto js-basket-success-table">
    <div class="card-body">
        <div class="row">
            <div class="col text-center">
                <h2 class="text-primary h3">
                    Номер вашего заказа № <?php echo $order->id ?>
                </h2>
                <i class="fa fa-check-circle fa-10x text-primary"></i>
            </div>
        </div>
        <div class="row">
            <table class="table table-bordered w-auto mx-auto">
                <tbody>
                <tr>
                    <td>
                        Дата и время
                    </td>
                    <td>
                        <?php echo $mydatecreat ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Сумма
                    </td>
                    <td>
                        <?php echo $order->getTotalSum() ?>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div>
            <table class="table table-bordered w-auto mx-auto">
                <tbody>
                <tr>
                    <td>
                        Наименование
                    </td>
                    <td>
                        Цена
                    </td>
                    <td>
                        Кол-во
                    </td>
                    <td>
                        Стоимость
                    </td>
                </tr>
                <?php
                foreach ($yaParams as $oderitemmy) {
                    foreach ($oderitemmy as $oderitemmyx) {
                        $nameorderitem = $oderitemmyx['name'];
                        $priceorderitem = $oderitemmyx['price'];
                        $kolvoorderitem = $oderitemmyx['quantity'];
                        $itogoitem = $kolvoorderitem * $priceorderitem;
                        ?>
                        <tr>
                            <td>
                                <?= $nameorderitem ?>
                            </td>
                            <td>
                                <?= $priceorderitem ?>
                            </td>
                            <td>
                                <?= $kolvoorderitem ?>
                            </td>
                            <td>
                                <?= $itogoitem ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col text-center">
                <!--<script src="/pdf/pdf.js?<?/*=time()*/?>"></script>
                <a id="makepdf" class="btn btn-primary">Скачать в PDF</a>-->
                <p>
                    <a href="/" class="btn btn-primary" title="На главную"><i class="fa fa-chevron-left"></i> На главную</a>
                </p>
                <h4 class="basket-success-manager text-primary">
                    <?php echo $manager_message; ?>
                </h4>
                <p>
                    <?php echo JFactory::getApplication()->get('sitename');?> - <?php echo JURI::base();?>
                </p>
            </div>
        </div>
    </div>
</div>


