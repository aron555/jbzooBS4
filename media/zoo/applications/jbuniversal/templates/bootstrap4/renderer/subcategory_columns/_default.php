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

$this->app->jbdebug->mark('layout::subcategory_columns::start');

if ($vars['count']) {

    $i = 0;
    $bootstrap = $this->app->jbbootstrap;
    $count = $vars['count'];
    $colClass = $bootstrap->columnClass($vars['cols_num']);
    ?>
    <div class="subcategories subcategory-col-<?php echo $vars['cols_num']; ?>">
        <?php

        $rowSubcategories = array_chunk($vars['objects'], $vars['cols_num']);

        foreach ($rowSubcategories as $row) {

            ?>
            <div class="row subcategory-row-<?php echo $i; ?>">
                <?php

                $j = 0;
                $i++;

                foreach ($row as $subcategory) {

                    $classes = array(
                        'subcategory-column', $colClass
                    );

                    $first = ($j == 0) ? $classes[] = 'first' : '';
                    $last = ($j == $count - 1) ? $classes[] = 'last' : '';
                    $j++;

                    $isLast = $j % $vars['cols_num'] == 0 && $vars['cols_order'] == 0;

                    if ($isLast) {
                        $classes[] = 'last';
                    }

                    ?>

                    <div class="<?php echo implode(' ', $classes); ?>">
                        <div class="subcategory-box">
                            <?php echo $subcategory ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php
        }
        ?>
    </div>
    <hr/>
    <?php

}

$this->app->jbdebug->mark('layout::subcategory_columns::finish');