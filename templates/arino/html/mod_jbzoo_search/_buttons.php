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

$submitShow = (int)$params->get('button_submit_show', 1);
$resetShow = (int)$params->get('button_reset_show', 1);

$value = $params->get('text_search', 1) ? $params->get('text_search', 1) : JText::_('JBZOO_BUTTON_SUBMIT');

if ($submitShow || $resetShow) {

    echo '<div class="jbfilter-row jbfilter-buttons">';

    if ($submitShow) {
        $attrs = [
            'type'  => 'submit',
            'name'  => 'send-form',
            'value' => $value,
            'class' => [
                'jsSubmit',
                'btn btn-primary'
            ],
        ];

        echo '<input ' . $modHelper->attrs($attrs) . ' /> ';
    }

    if ($resetShow) {
        $attrs = [
            'type'  => 'reset',
            'name'  => 'reset-form',
            'value' => JText::_('JBZOO_BUTTON_RESET'),
            'class' => [
                'jsReset',
                $btnClass
            ],
        ];

        echo '<input ' . $modHelper->attrs($attrs) . ' /> ';
    }

    echo JBZOO_CLR;
    echo '</div>';
}
