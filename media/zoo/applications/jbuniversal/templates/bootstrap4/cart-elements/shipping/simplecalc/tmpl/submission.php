<?php
/**
 * JBZoo App is universal Joomla CCK, application for YooTheme Zoo component
 * @package     jbzoo
 * @version     2.x Pro
 * @author      JBZoo App http://jbzoo.com
 * @copyright   Copyright (C) JBZoo.com,  All rights reserved.
 * @license     http://jbzoo.com/license-pro.php JBZoo Licence
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

/** @var JBHtmlHelper $html */
$html = $this->app->jbhtml;

$id = $this->app->jbstring->getId();
?>

<div class="shipping-simplecalc" id="<?= $id; ?>">

    <p>
        Цена за МКАД : <?= $this->getPriceForMkad()->html(); ?><br>
        Расстояние от МКАД, км:
        <?= $html->text($this->getControlName('mkad_length'), $this->get('mkad_length', 0), ['class' => 'jsMkadLength']); ?>
    </p>

</div>

<?= $this->app->jbassets->widget('#' . $id, 'JBZoo.ShippingType.SimpleCalc'); ?>

