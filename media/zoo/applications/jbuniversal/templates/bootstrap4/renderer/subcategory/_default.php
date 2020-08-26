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

$subCatImgSrc = $image['src'] ? $image['src'] : '/images/nophoto.png';
$subCatImgWH = $image['width_height'] ? $image['width_height'] : 'width="80" height="80"';

?>
    <div class="subcategory pt-0 subcategory-<?php echo $subcategory->alias; ?> media align-items-center">

        <?php if ($vars['params']->get('template.subcategory_teaser_image', 1))  : ?>
            <div class="subcategory-image d-flex mr-3">
                <a href="<?php echo $link; ?>" title="<?php echo $subcategory->name; ?>">
                    <img
                            src="<?php echo $subCatImgSrc; ?>" <?php echo $subCatImgWH; ?>
                            alt="<?php echo $subcategory->name; ?>"
                            title="<?php echo $subcategory->name; ?>"
                            class="img-fluid"
                    />
                </a>
            </div>
        <?php endif; ?>


        <h2 class="subcategory-title media-body">
            <a href="<?php echo $link; ?>"
               title="<?php echo $subcategory->name; ?>"><?php echo $subcategory->name; ?></a>
            <?php if ($showCount && $countItems != 0) : ?><span>(<?php echo $countItems; ?>)</span><?php endif; ?>
        </h2>

        <?php if ($vars['params']->get('template.subcategory_teaser_text', 1) && strlen($text) > 0) : ?>
            <div class="subcategory-description"><?php echo $text; ?></div>
        <?php endif; ?>

    </div>

<?php
$this->app->jbdebug->mark('layout::subcategory(' . $vars['object']->id . ')::finish');
