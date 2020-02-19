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

$zoo = App::getInstance('zoo');

$categories = $modHelper->getCategories();

$attrs = array(
    'id'    => $modHelper->getModuleId(),
    'class' => array(
        'yoo-zoo', // for Zoo widgets
        'jbzoo',
        'jbcategory-module',
        'jbcategory-module-bootstrap',
        (int)$params->get('category_display_border', 0) ? 'jbzoo-rborder' : '',
        'clearfix',
        'row'
    ),
);

?>
<?php if (!empty($categories)): ?>

    <div <?php echo $modHelper->attrs($attrs) ?>>

        <?php foreach ($categories as $catId => $category) : ?>
            <div class="category-wrapper my-3 col-md-4 <?php echo $category['active_class']; ?>">
                <a href="<?php echo $category['cat_link'] ?>" title="<?php echo $category['category_name'] ?>">
                    <div class="z-depth-2">
                        <figure class="effect-chico position-relative overflow-hidden">
                            <?php echo $category['image'] ?>
                            <figcaption class="position-absolute absolute-0 text-uppercase p-5 flex-center text-center rgba-blue-strong">
                                <h2 class="text-bold">
                                    <strong><?php echo $category['category_name']; ?></strong>
                                </h2>
                            </figcaption>
                        </figure>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
