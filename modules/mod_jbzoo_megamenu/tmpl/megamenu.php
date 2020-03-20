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
        (int)$params->get('category_display_border', 0) ? 'jbzoo-rborder' : ''
    ),
);

$dropdown_width = !empty($params->dropdown_width) ? (int)$params->dropdown_width : '600';

// главная страница каталога
$url = $zoo->route->frontpage($zoo->zoo->getApplication()->id);
//$cat = (int)$this->_params->get('cat_id');
//$url = "/mezhkomnatnye-dveri";
//$this->_params->get('app_id');

$catIdsSup = [];
?>

<div class="solid-menus" xmlns="http://www.w3.org/1999/html">
    <div class="navbar navbar-hover p-0 shadow-none">

        <div class="dropdown dropdown-convey-width" data-animation="fadeIn">

            <a
                    class="dropdown-categories dropdown-toggle"
                    href="<?= $url ?>"
                    data-toggle="dropdown"
                    data-title="Все категории">
                <span class="megamenu-title megamenu-title-small d-inline-block d-md-none"><i class="fa fa-fw fa-bars"></i></span>
                <span class="megamenu-title d-none d-md-inline-block" onclick="location.href='<?= $url ?>'">Каталог</span>
            </a>

            <ul class="dropdown-menu" style="width: <?= (int)$dropdown_width ?>px;">
                <li class="col-lg-12 px-0">
                    <div class="tabs side-tabs row">
                        <ul class="tab-nav tab-nav-hover col-md-auto col-12 p-0 list-unstyled">
                            <?php foreach ($categories as $category) : ?>
                                <li class="py-1 position-relative <?= $category['active_class']; ?>">
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
                                        <span class="position-absolute caret"><i class="fas fa-angle-right"></i></span>
                                    </a>
                                </li>
                                <?php
                                $catIdsSup[$category['id']] = $category;
                                ?>
                            <?php endforeach; ?>
                        </ul>
                        <div class="tab-container col-md col-12 hidden-xs overflow-auto">
                            <?php
                            foreach ($catIdsSup as $catId => $category) :
                                if (!empty($category['childs'])) {
                                    $childs = $this->getChilds($category['id']);
                                    ?>
                                    <div class="s-tab-content" id="s-tab-<?= $category['id'] ?>">
                                        <div class="row">
                                            <?php
                                            foreach ($childs as $childId => $child) {
                                                //$class = !empty($child['items']) ? "col-12 col-sm-6 col-md-4 col-xs-3" : "col-12 col-md-auto";
                                                $class = "col-12";
                                                ?>
                                                <div class="<?= $class ?>">
                                                    <div class="mb-3 px-0">
                                                        <div class="overflow-hidden bg-transparent">
                                                            <div class="text-center text-md-left">
                                                                <a class="p-0"
                                                                   href="<?= $child['child_link'] ?>">
                                                                    <?= $child['child_name'] ?>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div><!--.card-->
                                                </div><!--.col--->
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                            endforeach;
                            ?>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
