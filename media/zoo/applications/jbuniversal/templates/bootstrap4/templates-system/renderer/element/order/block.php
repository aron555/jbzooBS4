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

$description = $element->config->get('description');

$class = '';
if ($element->config->get('class')) {
    $class = $element->config->get('class');
}

$pattern = '';
if ($element->config->get('pattern')) {
    $pattern = $element->config->get('pattern');
}

$params = $this->app->data->create($params);

// add tooltip
$tooltip = '';
if ($params->get('show_tooltip') && ($description)) {
    $tooltip = ' class="hasTip" title="' . $description . '"';
}

// create error
$error   = '';
$isError = isset($element->error) && !empty($element->error);
if ($isError) {
    $error = '<p class="jbcart-form-error">' . (string)$element->error . '</p>';
}

// create class attribute
$classes = array_filter(array(
    'jbcart-form-row col',
    'jbcart-form-' . $element->getElementType(),
    $params->get('first') ? 'first' : '',
    $params->get('last') ? 'last' : '',
    $params->get('required') ? 'required' : '',
    $isError ? 'error' : '',
));

$element->loadAssets();

$label = $params->get('altlabel') ? $params->get('altlabel') : $element->getName();
$label = $params->get('required') ? ($label . ' <span class="required-dot">*</span>') : $label;

$placeholder = $params->get('placeholder') ? $params->get('placeholder') : '';

$params->placeholder = strip_tags($placeholder);
$params->class = strip_tags($class);
$params->pattern = strip_tags($pattern);

//echo "<pre>";var_dump($params);echo "</pre>";

$html = $element->renderSubmission($params);
if (!$html) {
    return null;
}

?>

<div class="<?php echo implode(' ', $classes); ?>">

    <label class="jbcart-form-label w-100 float-none" for="<?php echo $element->htmlId(); ?>">
        <?php echo $label; ?>
    </label>

    <div class="">

        <?php echo $html; ?>
        <?php echo $error; ?>
    </div>


    <?php // if (!empty($description)) { ?>
    <div class="jbcart-form-desc">
        <?php echo $description; ?>
    </div>
    <?php //}  ?>

</div>
