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

$params = $this->app->data->create($params);
$bootstrap = $this->app->jbbootstrap;

// create error
$error = '';
if ($element->isDebug()) {
    $error .= '<p class="jbcart-payment-debug">' . JText::_('JBZOO_PAYMENT_DEBUG_MESSAGE') . '</p>';
}

$isError = isset($element->error) && !empty($element->error);
if ($isError) {
    $error .= '<p class="jbcart-payment-error">' . (string)$element->error . '</p>';
}

// create class attribute
$classes = array_filter(array(
    'jbcart-payment-ui-row',
    'jbcart-payment-' . $element->getElementType(),
    $params->get('first') ? 'first' : '',
    $params->get('last') ? 'last' : '',
    'col-md-4 d-flex align-items-stretch',
    $isError ? 'error' : null,
));

$element->loadAssets();

$paymentId = $element->htmlId();
?>
<div class="<?php echo implode(' ', $classes); ?>">
    <div class="card w-100">
        <input <?php echo $this->app->jbhtml->buildAttrs(array(
            'type' => 'radio',
            'id' => $paymentId,
            'value' => $element->identifier,
            'class' => 'jbcart-radio-input jbcart-payment-radio',
            'name' => $element->getControlName('_payment_id'),
            'checked' => $element->isDefault() ? 'checked' : null,
        )); ?> />

        <label class="jbcart-radio-label jbcart-payment-label p-3" for="<?php echo $paymentId; ?>">

            <div class="jbcart-radio"></div>

            <div class="jbcart-payment-element">
                <?php
                if (!($html = $element->renderSubmission($params))) {
                    $html = '<p class="jbcart-payment-element-name p-0 m-0">' . $element->getName() . '</p>';
                }
                echo $html;
                ?>
            </div>

            <?php if ($description = $element->config->get('description')) : ?>
                <p class="jbcart-payment-desc">
                    <?= JText::_($description); ?>
                </p>
            <?php endif; ?>

            <?php echo $error; ?>
        </label>
    </div>
</div>
