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

$this->app->jbdebug->mark('template::category::start');

?>
    <div class="row">

        <div class="col">
            <?php

            $this->app->jblayout->setView($this);
            $currentView = $this->app->jbrequest->get('view', 'category');
            $currentTask = $this->app->jbrequest->get('task', 'category');

            if (isset($this->category)) {
                if ($currentView == 'frontpage' || $currentTask == 'frontpage') {
                    $category = $this->application;
                } else {
                    $category = $this->category;
                }
            }

            if (!$this->app->jbcache->start($this->params->get('config.lastmodified'))) {
                $this->app->jbwrapper->start();

                // category render
                if (isset($category)) {
                    echo $this->app->jblayout->render($currentView, $category);
                }

                // subcategories render
                if (isset($category)) {
                    $categories = $this->category->getChildren();
                    if ($this->params->get('template.subcategory_show', 1) && count($categories)) {
                        echo $this->app->jblayout->render('subcategories', $categories);
                    }
                }

                // category items render
                if ($this->params->get('config.items_show', 1) && count($this->items)) {

                    echo $this->app->jblayout->render('items', $this->items);

                } else {

                    echo $this->app->jblayout->render('items_empty', $category);

                    $level = 3;

                    $countSlick = 3;
                    $slick = false;

                    if ($this->category->hasChildren() && $level >= 2) {
                        foreach ($this->category->getChildren() as $child) {
                            if (!$child->totalItemCount()) continue;
                            $link = $this->app->route->category($child);

                            // get category params
                            $params = $child->getParams('site');
                            $itemsOrder = $params->get('config.item_order', 'none');
                            $maxItems = $params->get('template.subcategory_items_count', 6);

                            if ($maxItems >= "10") {
                                $maxItems = "10";
                            }
                            // get items
                            $childitems = $this->app->table->item->getByCategory($child->getApplication()->id, $child->id, true, null, $itemsOrder, 0, $maxItems, false);

                            // render items
                            if (count($childitems) > 0) {
                                ?>
                                <div class="my-5">
                                    <h3 class="page-title">
                                        <a href="<?= $link ?>" title="<?= $child->name ?>">
                                            <?= $child->name ?>
                                        </a>
                                    </h3>
                                    <div class="row <?php echo (count($childitems) > $countSlick && $currentView != 'frontpage' && $currentTask != 'frontpage' && $slick == true)  ? 'slick' : ''; ?>">
                                        <?php
                                        //var_dump($currentView, $currentTask);
                                        foreach ($childitems as $item) {
                                            ?>
                                            <div class="col-md-4 my-3 d-flex align-items-stretch">
                                                <?php
                                                echo $this->app->jblayout->renderItem($item, 'teaser');
                                                ?>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <h4 class="page-title-bottom">
                                        <a href="<?= $link ?>" title="<?= $child->name ?>">
                                            Другие товары из категории <?= $child->name ?>
                                        </a>
                                    </h4>
                                </div>
                                <?php
                            } else {
                                if ($child->hasChildren() && $level >= 3) {
                                    foreach ($child->getChildren() as $child2) {
                                        if (!$child2->totalItemCount()) continue;
                                        $link2 = $this->app->route->category($child2);
                                        // get category2 params
                                        $params2 = $child2->getParams('site');
                                        $itemsOrder2 = $params2->get('config.item_order', 'none');
                                        $maxItems2 = $params2->get('template.subcategory_items_count', 6);

                                        // get items
                                        $childitems2 = $this->app->table->item->getByCategory($child2->getApplication()->id, $child2->id, true, null, $itemsOrder2, 0, $maxItems2, false);

                                        // render items
                                        if (count($childitems2) > 0) {
                                            ?>
                                            <div class="my-5">
                                                <h3 class="page-title">
                                                    <a href="<?= $link2 ?>" title="<?= $child2->name ?>">
                                                        <?= $child2->name ?>
                                                    </a>
                                                </h3>
                                                <div class="row <?php echo (count($childitems2) > $countSlick && $currentView != 'frontpage' && $currentTask != 'frontpage' && $slick == true)  ? 'slick' : ''; ?>">
                                                    <?php
                                                    foreach ($childitems2 as $item2) {
                                                        ?>
                                                        <div class="col-md-4 my-3">
                                                            <?php
                                                            echo $this->app->jblayout->renderItem($item2, 'teaser');
                                                            ?>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                                <h4 class="page-title-bottom">
                                                    <a href="<?= $link2 ?>" title="<?= $child2->name ?>">
                                                        Другие товары из категории <?= $child2->name ?>
                                                    </a>
                                                </h4>
                                            </div>
                                            <?php
                                        }
                                    }
                                }
                            }

                        }
                    }

                }

                // pagination render
                if ($this->params->get('template.item_pagination', 1)) {
                    echo $this->app->jblayout->render('pagination', $this->pagination, array('link' => $this->pagination_link));
                }

                // description render
                if (!empty($category->description)) {
                    ?>
                    <div class="my-3">
                        <?php
                        echo $category->getText($category->description);
                        ?>
                    </div>
                    <?php
                }

                $this->app->jbwrapper->end();
                $this->app->jbcache->stop();

            }

            ?>
        </div>
    </div>
<?php

$this->app->jbdebug->mark('template::category::finish');
