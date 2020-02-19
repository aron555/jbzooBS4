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

$this->app->jbdebug->mark('layout::subcategory(' . $vars['object']->id . ')::start');

// set vars
$subcategory = $vars['object'];
$params = $subcategory->getParams('site');
$link = $this->app->route->category($subcategory);
$task = $this->app->jbrequest->get('task', 'category');

// teaser content
$text = $params->get('content.category_teaser_text', '');
$imageAlign = $params->get('template.subcategory_teaser_image_align', 'left');

// items
$itemsOrder = $vars['params']->get('config.item_order', 'none');
$maxItems = $vars['params']->get('template.subcategory_items_count', 5);
$showCount = $vars['params']->get('template.subcategory_items_count_show', 1);

$items = array();
$countItems = 0;
if ($showCount || $maxItems != "0" || $maxItems == "-1") {
    $items = JBModelCategory::model()->getItemsByCategory($subcategory->application_id, $subcategory->id, $itemsOrder, $maxItems);
    $countItems = $subcategory->itemCount();
}

$image = $this->app->jbimage->get('category_teaser_image', $params);

?>
    <a href="<?php echo $link; ?>" title="<?php echo $subcategory->name; ?>">
        <div class="subcategory subcategory-<?php echo $subcategory->alias; ?> z-depth-2">
            <figure class="effect-chico position-relative overflow-hidden">
                <img
                        src="<?php echo $image['src']; ?>" <?php echo $image['width_height']; ?>
                        alt="<?php echo $subcategory->name; ?>"
                        title="<?php echo $subcategory->name; ?>"
                        class="img-fluid"
                />
                <figcaption class="position-absolute absolute-0 text-uppercase p-5 flex-center text-center rgba-blue-strong">
                    <h2 class="text-bold">
                        <strong><?php echo $subcategory->name; ?></strong>
                    </h2>
                </figcaption>
            </figure>
        </div>
    </a>



<?php
$this->app->jbdebug->mark('layout::subcategory(' . $vars['object']->id . ')::finish');
