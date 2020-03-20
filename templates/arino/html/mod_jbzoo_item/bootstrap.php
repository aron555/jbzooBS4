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

$items = $modHelper->getItems();
$count = count($items);
$columns = (int)$params->get('item_cols', 1);
$border = (int)$params->get('display_border', 1) ? 'rborder' : 'no-border';

$application = $modHelper->app->zoo->getApplication();
$appTemplate = $application->params->get('template', 'bootstrap');

if ($appTemplate !== 'bootstrap') {
    $modHelper->app->jbtemplate->regHelpersByTpl('bootstrap');
}

$bootstrap = $modHelper->app->jbbootstrap;

if ($count) {
    ?>
    <div id="<?= $modHelper->getModuleId() ?>" class="jbzoo yoo-zoo">
        <div class="module-items jbzoo-<?= $border ?> module-items-col-<?= $columns ?>">
            <?php
            echo $modHelper->renderRemoveButton();

            //echo "<pre>";var_dump(count($items));echo "</pre>";

            if ($columns) {

                $j = $i = 0;

                $rowItem = array_chunk($items, $columns);
                $colClass = $bootstrap->columnClass($columns);

                ?>
                <div class="items items-col-<?= $columns ?>">
                    <?php

                    foreach ($rowItem as $row) {
                        ?>
                        <div class="row item-row-<?= $i ?>">
                            <?php
                            foreach ($row as $item) {

                                $app_id = $item->application_id;
                                $first = ($j == 0) ? ' first' : '';
                                $last = ($j == $count - 1) ? ' last' : '';
                                $j++;

                                $isLast = $j % $columns == 0;

                                if ($isLast) {
                                    $last .= ' last';
                                }

                                $renderer = $modHelper->createRenderer('item');

                                ?>
                                <div class="item-column <?= $colClass . $first . $last ?>">
                                    <?php
                                    $renderer->render('item.' . $modHelper->getItemLayout(), array(
                                        'item' => $item,
                                        'params' => $params
                                    ))
                                    ?>
                                </div>
                                <?php
                            }
                            $i++;
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <?php
            } else {
                ?>
                <div class="slick row">
                    <?php
                    foreach ($items as $item) {
                        ?>
                        <div class="col">
                            <?php
                            $renderer = $modHelper->createRenderer('item');
                            echo $renderer->render('item.' . $modHelper->getItemLayout(), array(
                                'item' => $item,
                                'params' => $params
                            ));
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
}
