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

$this->app->jbdebug->mark('layout::item_columns::start');

if ($vars['count']) {

    $itemsPerPage = "60";

    $i = 0;
    $count = $vars['count'];
    $rowItems = array_chunk($vars['objects'], $vars['cols_num']);
    $col = "col-12";
    $colsm = (($vars['cols_num'] + 2) == "5") ? "col-sm-6" : "col-sm-" . ($vars['cols_num'] + 2);
    $colmd = (($vars['cols_num'] + 1) == "5") ? "col-md-6" : "col-md-" . ($vars['cols_num'] + 1);
    $colxl = (($vars['cols_num']) == "5") ? "col-xl-4" : "col-xl-" . ($vars['cols_num']);
    $colClass = $col . " " . $colsm . " " . $colmd . " " . $colxl;

    ?>

    <div class="controls-panel control-top-panel">
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
                class="mb-1 d-flex justify-content-end flex-row sortpo"
        >

            <!-- hidden sort control -->

            <!-- first and previous buttons -->
            <div class="d-flex">

                <div class="d-flex justify-content-end mb-1">
                    <div class="dropdown ml-3">
                        <button class="btn btn-danger btn-sm dropdown-toggle" type="button"
                                id="sortPrice"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Сортировать по
                        </button>

                        <div class="dropdown-menu" aria-labelledby="sortPrice" style="width:250px;">
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
                                        <i class="fa fa-sort-numeric-down mr-2"></i> Сначала
                                        дешевые

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
                                        <i class="fa fa-sort-numeric-down-alt mr-2"></i> Сначала
                                        дорогие
                                    </label>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div> <!-- место пагинации -->

            </div>

        </nav>
    </div>

    <!--Вывод товаров-->
    <div class="row items row-flex" data-jplist-group="group1">
        <?php

        foreach ($rowItems as $row) {

            foreach ($row as $item) {

                $classes = array(
                    'col-4 item-column pb-2',
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
        <!--Вывод товаров-->

        <!-- no results control -->
        <div class="col text-center" data-jplist-control="no-results" data-group="group1" data-name="no-results"
             style="display: none;">Ничего не найдено
        </div>
    </div>


    <!-- IE 10+ / Edge support via babel-polyfill: https://babeljs.io/docs/en/babel-polyfill/ -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/babel-polyfill/6.26.0/polyfill.min.js"></script>

    <!-- jPList Library -->
    <?php

    $this->app->jbassets->js('jbassets:js/jplist-es6.min.js');
    $this->app->jbassets->css('jbassets:css/jplist.styles.css');

    ?>
    <script>
        jplist.init();
    </script>
    <?php

}

$this->app->jbdebug->mark('layout::item_columns::finish');

