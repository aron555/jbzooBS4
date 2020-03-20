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

?>

<div class="text-center mb-1">

    <input type="submit" name="create" value="<?php echo JText::_('JBZOO_CART_MOBILE_SUBMIT'); ?>"
           class="btn btn-success btn-sm">

    <?php if ($view->payment && (int)$view->config->get('tmpl_button_payment', 1)) : ?>
        <input type="submit" name="create-pay" value="<?php echo JText::_('JBZOO_CART_MOBILE_SUBMIT_AND_PAY'); ?>"
               class="btn btn-success" style="display: none;" />
    <?php endif; ?>

</div>
