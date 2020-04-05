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

$this->app->jbdebug->mark('layout::category::start');

// set vars
$category = $vars['object'];
$title    = $this->app->string->trim($vars['params']->get('content.category_title', ''));
$subTitle = $this->app->string->trim($vars['params']->get('content.category_subtitle', ''));
$image    = $this->app->jbimage->get('category_image', $vars['params']);
$title    = $title ? $title : $category->name;

if ((int)$vars['params']->get('template.category_show', 1)) : ?>
    <div class="category pt-0 pl-0 alias-<?php echo $category->alias; ?> ">

        <?php if ((int)$vars['params']->get('template.category_title_show', 1)) : ?>
            <h1 class="title products-cat-title"><?php echo $title; ?></h1>
        <?php endif; ?>


        <?php if ((int)$vars['params']->get('template.category_subtitle', 1) && !empty($subTitle)) : ?>
            <h2 class="subtitle"><?php echo $subTitle; ?></h2>
        <?php endif; ?>


        <?php if ((int)$vars['params']->get('template.category_image', 1) && $image['src']) : ?>
            <div class="image-full d-flex justify-content-center">
                <img src="<?php echo $image['src']; ?>" <?php echo $image['width_height']; ?>
                     title="<?php echo $category->name; ?>" alt="<?php echo $category->name; ?>" class="img-fluid">
            </div>
        <?php endif; ?>


        <?php if ((int)$vars['params']->get('template.category_teaser_text', 1) && $vars['params']->get('content.category_teaser_text', '')) : ?>
            <div class="description-teaser">
                <?php echo $vars['params']->get('content.category_teaser_text', ''); ?>
            </div>
        <?php endif; ?>

        <?php echo JBZOO_CLR; ?>
    </div>

<?php else: ?>

    <div class="category alias-<?php echo $category->alias; ?> ">
        <?php if ((int)$vars['params']->get('template.category_title_show', 1)) : ?>
            <h1 class="title products-cat-title"><?php echo $title; ?></h1>
        <?php endif; ?>
    </div>

<?php endif; ?>

<?php
$this->app->jbdebug->mark('layout::category::finish');
