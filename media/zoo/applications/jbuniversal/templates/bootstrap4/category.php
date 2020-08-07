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
