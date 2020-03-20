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
    'id' => $modHelper->getModuleId(),
    'class' => array(
        'yoo-zoo', // for Zoo widgets
        'jbzoo',
        'jbcategory-module',
        'jbcategory-module-bootstrap',
        (int)$params->get('category_display_border', 0) ? 'jbzoo-rborder' : '',
        'clearfix'
    ),
);
// главная страница каталога
//$url = $zoo->route->frontpage($zoo->zoo->getApplication()->id);
//$cat = (int)$this->_params->get('cat_id', 2);
$url = "/vhodnye-dveri";
//$this->_params->get('app_id');

$catIdsSup = [];
?>

<div class="solid-menus solid-menus-2" xmlns="http://www.w3.org/1999/html">
    <div class="navbar navbar-hover p-0 shadow-none">

        <div class="dropdown dropdown-convey-width dropdown-convey-width-2" data-animation="fadeIn">

            <a
                    class="dropdown-categories dropdown-toggle"
                    href="<?= $url ?>"
                    data-toggle="dropdown"
                    data-title="Все категории">
                <span class="megamenu-title megamenu-title-small d-inline-block d-md-none">Входные</span>
                <span class="megamenu-title d-none d-md-inline-block" onclick="location.href='<?= $url ?>'">Входные двери</span>
            </a>

            <ul class="dropdown-menu dropdown-menu-2">
                <li class="col-lg-12 px-0">
                    <div class="tabs side-tabs row">
                        <ul class="tab-nav clearfix tab-nav-hover col-md-auto col-12 p-0 list-unstyled">
                            <?php foreach ($categories as $category) : ?>
                                <li class="position-relative<?= $category['active_class']; ?>">
                                    <a
                                            href="<?= $category['cat_link'] ?>"
                                            data-tabs="s-tab-<?= $category['id'] ?>"
                                            class="prev-default pr-5"
                                            title="<?= $category['category_name'] ?>"
                                            data-toggle="collapse"
                                    >
                                        <span onclick="location.href='<?= $category["cat_link"] ?>'">
                                        <?= $category['category_name'] ?>
                                        </span>
                                    </a>

                                </li>
                                <?php
                                $catIdsSup[$category['id']] = $category;

                                ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
