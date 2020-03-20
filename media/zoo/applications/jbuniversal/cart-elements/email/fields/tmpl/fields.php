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

/** @var array $fields */
/** @var JBCartOrder $order */
$fields = $this->_getFields();
$order  = $this->getOrder();

$output = array();

foreach ($fields as $identifier => $elementData) {

    /** @var JBCartElementOrderEmail $element */
    if ($element = $order->getFieldElement($identifier)) {
        $element->bindData((array)$elementData);

        $params   = $this->app->data->create();
        $output[] = "<dt style='float: left; width: 40%;background: transparent;padding: 0;margin: 0;font-weight: 700;'>{$element->getName()}</dt><dd style='float: left; width: 60%;background: transparent;padding: 0;margin: 0;'>{$element->edit($params)}</dd>";
    }
}

if (count($output)) {
    ?>
    <dl style="width: 100%;overflow: hidden;background: transparent;padding: 0 0 6px 0;margin: 0"><?= implode(PHP_EOL, $output) ?></dl>
<?php
}
