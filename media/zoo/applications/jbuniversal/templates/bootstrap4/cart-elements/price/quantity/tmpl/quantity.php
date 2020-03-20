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

$quantity =  $this->_jbhtml->quantity($params->get('default', 1), $params, $this->htmlId(true), $this->getRenderName('value'), true);

if ($quantity) : ?>
    <?php

    $id = $this->htmlId(true) ? $this->htmlId(true) : $this->_jbstring->getId('quantity-');

    $params = array(
        'min'      => (int)$params->get("min", "1"),
        'max'      => (int)$params->get("max", "999"),
        'step'     => (int)$params->get("step", "1"),
        'default'  => (int)$params->get("default", "1"),
        'decimals' => (int)$params->get("decimals", "0")
    );
    ?>
    <div class="jsQuantity quantity-block d-flex flex-row" id="<?= $id ?>">
        <span class="jsRemove minus_field btn btn-primary">–</span>
        <div class="jsCountBox">
            <dl class="item-count-digits d-none"><?= str_repeat('<dd></dd>', 5)?></dl>
            <span class="item-count">
                        <input type="text" value="<?= $params["default"] ?>" style="opacity: 1 !important;" class="jsInput text-center quantity_field form-control" name="<?= $this->getRenderName('value') ?>">
                    </span>
        </div>
        <span class="jsAdd plus_field btn btn-primary">+</span>
    </div>

    <script type="text/javascript">
        jQuery(function($){ setTimeout(function(){$("#<?= $id ?>").JBZooQuantity({"min":<?= $params["min"] ?>,"max":<?= $params["max"] ?>,"step":<?= $params["step"] ?>,"default":<?= $params["default"] ?>,"decimals":<?= $params["decimals"] ?>}, 0);}, 0); });
    </script>

<?php endif;
