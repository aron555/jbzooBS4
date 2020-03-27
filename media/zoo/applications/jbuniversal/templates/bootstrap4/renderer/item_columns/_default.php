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

//use Joomla\CMS\Factory;

$this->app->jbdebug->mark('layout::item_columns::start');

if ($vars['count']) {

    $itemsPerPage = "24";
    ?>



    <?php

    $i = 0;
    $count = $vars['count'];
    $rowItems = array_chunk($vars['objects'], $vars['cols_num']);
    $col = "col-12";
    $colsm = (($vars['cols_num'] + 2) == "5") ? "col-sm-6" : "col-sm-" . ($vars['cols_num'] + 2);
    $colmd = (($vars['cols_num'] + 1) == "5") ? "col-md-6" : "col-md-" . ($vars['cols_num'] + 1);
    $colxl = (($vars['cols_num']) == "5") ? "col-xl-4" : "col-xl-" . ($vars['cols_num']);
    $colClass = $col . " " . $colsm . " " . $colmd . " " . $colxl;

    ?>

    <div class="row">

        <?php
        jimport('joomla.application.module.helper');
        $module = JModuleHelper::getModules('category-filter'); // заполняем массив модулями, опубликованными в позиции

        if (!empty($module)) {
            ?>
            <div class="col-md-3">
                <?php
                $attribs['style'] = 'none'; // указываем стиль вывода модуля none (так как при использовании стиля xhtml наблюдается дублирование заголовков модуля)

                foreach ($module as $moduleitem) { // перебираем в цикле и выводим по очереди все модули из позиции category-filter
                    echo JModuleHelper::renderModule($moduleitem, $attribs);
                }
                ?>
            </div>
            <?php
        }
        ?>

        <div class="col">

            <div class="py-3 controls-panel control-top-panel">
                <div class="container">

                    <div class="d-flex justify-content-end mb-3">
                        <div class="dropdown ml-3">
                            <button class="btn btn-default dropdown-toggle" type="button" id="sortPrice"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Сортировать по
                            </button>

                            <div class="dropdown-menu" aria-labelledby="sortPrice">
                                <ul class="list-unstyled mb-0">
                                    <li>
                                        <label class="ml-3 cursor-pointer mask" id="sort-asc">
                                            <input
                                                    type="radio"
                                                    data-jplist-control="radio-buttons-sort"
                                                    data-path=".jbcurrency-value"
                                                    data-group="group1"
                                                    data-order="asc"
                                                    data-type="number"
                                                    class="mr-2 d-none"
                                                    name="radio-sort"
                                            >
                                            Цене <i class="fas fa-angle-double-down ml-2"></i>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="ml-3 cursor-pointer mask" id="sort-desc">
                                            <input
                                                    type="radio"
                                                    data-jplist-control="radio-buttons-sort"
                                                    data-path=".jbcurrency-value"
                                                    data-group="group1"
                                                    data-order="desc"
                                                    data-type="number"
                                                    class="mr-2 d-none"
                                                    name="radio-sort"
                                            >
                                            Цене <i class="fas fa-angle-double-up ml-2"></i>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="dropdown ml-3" hidden>
                            <button class="btn btn-default dropdown-toggle" type="button" id="sortText"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Сортировать по
                            </button>

                            <div class="dropdown-menu" aria-labelledby="sortText">
                                <ul class="list-unstyled mb-0">
                                    <li>
                                        <label class="ml-3 cursor-pointer mask">
                                            <input
                                                    type="radio"
                                                    data-jplist-control="radio-buttons-text-filter"
                                                    data-path="default"
                                                    data-group="group1"
                                                    class="mr-2 d-none"
                                                    name="radio-buttons-text-filter"
                                                    value=""
                                            >
                                            Все
                                        </label>
                                    </li>
                                    <li>
                                        <label class="ml-3 cursor-pointer mask">
                                            <input
                                                    type="radio"
                                                    data-jplist-control="radio-buttons-text-filter"
                                                    data-path=".badge-hit"
                                                    data-group="group1"
                                                    class="mr-2 d-none"
                                                    name="radio-buttons-text-filter"
                                                    value=""
                                            >
                                            Хит
                                        </label>
                                    </li>
                                    <li>
                                        <label class="ml-3 cursor-pointer mask">
                                            <input
                                                    type="radio"
                                                    data-jplist-control="radio-buttons-text-filter"
                                                    data-path=".badge-new"
                                                    data-group="group1"
                                                    class="mr-2 d-none"
                                                    name="radio-buttons-text-filter"
                                                    value=""
                                            >
                                            Новинки
                                        </label>
                                    </li>
                                    <li>
                                        <label class="ml-3 cursor-pointer mask">
                                            <input
                                                    type="radio"
                                                    data-jplist-control="radio-buttons-text-filter"
                                                    data-path=".badge-sale"
                                                    data-group="group1"
                                                    class="mr-2 d-none"
                                                    name="radio-buttons-text-filter"
                                                    value=""
                                            >
                                            Распродажа
                                        </label>
                                    </li>
                                    <li>
                                        <label class="ml-3 cursor-pointer mask">
                                            <input
                                                    type="radio"
                                                    data-jplist-control="radio-buttons-text-filter"
                                                    data-path=".badge-recomend"
                                                    data-group="group1"
                                                    class="mr-2 d-none"
                                                    name="radio-buttons-text-filter"
                                                    value=""
                                            >
                                            Рекомендуем
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>


                    <!--top pagination-->
                    <div class="row mb-2">
                        <div class="col flex flex-wrap align-items-start">
                            <!-- pagination control -->
                            <nav
                                    data-jplist-control="pagination"
                                    data-group="group1"
                                    data-items-per-page="<?= $itemsPerPage ?>"
                                    data-current-page="0"
                                    data-disabled-class="disabled"
                                    data-selected-class="active"
                                    data-jump=""
                                    data-id="pagination1"
                                    data-name="pagination1"
                                    class="mb-2 d-flex flex-row"
                            >
                                <!-- first and previous buttons -->
                                <div class="d-flex">
                                    <ul class="pagination d-inline-flex mb-0">
                                        <li class="page-item d-none d-sm-none d-lg-flex" data-type="first">
                                            <a class="page-link" href="#"><i class="fas fa-angle-double-left"></i></a>
                                        </li>
                                        <li class="page-item" data-type="prev">
                                            <a class="page-link" href="#"><i class="fas fa-angle-left"></i></a>
                                        </li>
                                    </ul>
                                    <!-- pages buttons -->
                                    <ul class="pagination d-none d-sm-none d-lg-flex mb-0" data-type="pages">
                                        <li class="page-item" data-type="page">
                                            <a class="page-link" href="#">{pageNumber}</a>
                                        </li>
                                    </ul>
                                    <!-- next and last buttons -->
                                    <ul class="pagination d-flex mb-0">
                                        <li class="page-item" data-type="next">
                                            <a class="page-link" href="#"><i class="fas fa-angle-right"></i></a>
                                        </li>
                                        <li class="page-item d-none d-sm-none d-lg-flex" data-type="last">
                                            <a class="page-link" href="#"><i class="fas fa-angle-double-right"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="d-flex ml-auto align-items-center">
                                    <!-- information labels -->
                                    <div class="d-none d-sm-none d-md-flex">
                                        Элементов на странице:
                                    </div>
                                    <!-- items per page dropdown -->
                                    <div class="dropdown d-flex ml-lg-3" data-type="items-per-page-dd" data-opened-class="show">
                                        <button data-type="panel" class="btn btn-primary dropdown-toggle py-2"
                                                type="button"><?= $itemsPerPage ?></button>
                                        <div data-type="content" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#"
                                               data-value="<?= $itemsPerPage / 3 ?>"><?= $itemsPerPage / 3 ?></a>
                                            <a class="dropdown-item" href="#"
                                               data-value="<?= $itemsPerPage / 2 ?>"><?= $itemsPerPage / 2 ?></a>
                                            <a class="dropdown-item" href="#"
                                               data-value="<?= $itemsPerPage ?>"><?= $itemsPerPage ?></a>
                                            <a class="dropdown-item" href="#"
                                               data-value="<?= $itemsPerPage * 2 ?>"><?= $itemsPerPage * 2 ?></a>
                                            <a class="dropdown-item" href="#" data-value="0">Все</a>
                                        </div>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                    <!--EO top pagination-->
                </div>
            </div>

            <div class="row items row-flex" data-jplist-group="group1">
                <?php

                foreach ($rowItems as $row) {

                    foreach ($row as $item) {

                        $classes = array(
                            'item-column pb-4', $colClass
                        );

                        ?>
                        <div data-jplist-item class="<?= implode(' ', $classes) ?>">
                            <div class="item-box">
                                <?= $item ?>
                            </div>
                        </div>
                        <?php
                    }

                }
                ?>
                <!-- no results control -->
                <div class="col text-center" data-jplist-control="no-results" data-group="group1" data-name="no-results"
                     style="display: none;">Ничего не найдено
                </div>
            </div>


            <!--bottom pagination-->
            <div class="row mb-2">
                <div class="col flex flex-wrap align-items-start">
                    <!-- pagination control -->
                    <nav
                            data-jplist-control="pagination"
                            data-group="group1"
                            data-items-per-page="<?= $itemsPerPage ?>"
                            data-current-page="0"
                            data-disabled-class="disabled"
                            data-selected-class="active"
                            data-jump=".control-top-panel"
                            data-id="pagination1"
                            data-name="pagination1"
                            class="mb-2 d-flex flex-row"
                    >
                        <!-- first and previous buttons -->
                        <div class="d-flex">
                            <ul class="pagination d-inline-flex mb-0">
                                <li class="page-item d-none d-sm-none d-lg-flex" data-type="first">
                                    <a class="page-link" href="#"><i class="fas fa-angle-double-left"></i></a>
                                </li>
                                <li class="page-item" data-type="prev">
                                    <a class="page-link" href="#"><i class="fas fa-angle-left"></i></a>
                                </li>
                            </ul>
                            <!-- pages buttons -->
                            <ul class="pagination d-none d-sm-none d-lg-flex mb-0" data-type="pages">
                                <li class="page-item" data-type="page">
                                    <a class="page-link" href="#">{pageNumber}</a>
                                </li>
                            </ul>
                            <!-- next and last buttons -->
                            <ul class="pagination d-flex mb-0">
                                <li class="page-item" data-type="next">
                                    <a class="page-link" href="#"><i class="fas fa-angle-right"></i></a>
                                </li>
                                <li class="page-item d-none d-sm-none d-lg-flex" data-type="last">
                                    <a class="page-link" href="#"><i class="fas fa-angle-double-right"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex ml-auto align-items-center">
                            <!-- information labels -->
                            <div class="d-none d-sm-none d-md-flex">
                                Элементов на странице:
                            </div>
                            <!-- items per page dropdown -->
                            <div class="dropdown d-flex ml-lg-3" data-type="items-per-page-dd" data-opened-class="show">
                                <button data-type="panel" class="btn btn-primary dropdown-toggle py-2"
                                        type="button"><?= $itemsPerPage ?></button>
                                <div data-type="content" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#" data-value="<?= $itemsPerPage ?>"><?= $itemsPerPage ?></a>
                                    <a class="dropdown-item" href="#"
                                       data-value="<?= $itemsPerPage * 2 ?>"><?= $itemsPerPage * 2 ?></a>
                                    <a class="dropdown-item" href="#" data-value="0">Все</a>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <!--EO bottom pagination-->
        </div>
    </div>



    <!-- IE 10+ / Edge support via babel-polyfill: https://babeljs.io/docs/en/babel-polyfill/ -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/babel-polyfill/6.26.0/polyfill.min.js"></script>

    <!-- jPList Library -->
    <?php

    $this->app->jbassets->js('jbassets:js/jplist-es6.min.js');

    $this->app->jbassets->css('jbassets:css/jplist.styles.css');

    /*Или из шаблона*/
    /*$document = Factory::getDocument();
    $template = Factory::getApplication()->getTemplate();
    $t_puth = JURI::root(true) . '/templates/' . $template . '/';
    $document->addStyleSheet($t_puth . "css/jplist/jplist.styles.css");
    $document->addScript($t_puth . "js/jplist/jplist-es6.min.js");*/
    ?>
    <script>
        jplist.init({
            /*storage: 'sessionStorage', //'localStorage', 'sessionStorage' or 'cookies'
            storageName: 'jplist',
            deepLinking: true*/
        });
    </script>
    <?php

}

$this->app->jbdebug->mark('layout::item_columns::finish');

