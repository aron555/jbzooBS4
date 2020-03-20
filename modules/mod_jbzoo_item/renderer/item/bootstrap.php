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
?>

<div class="card tizer tizer-module hoverable">
    <div class="row pt-3">
        <?php if ($this->checkPosition('image')) : ?>
            <div class="col-md-12">
                <div class="item-image min-height-tizer-image d-flex justify-content-center align-items-center position-relative view overlay zoom">
                    <?php echo $this->renderPosition('image'); ?>
                    <div class="position-absolute top-right d-flex flex-column mx-1 mb-1">
                        <?php if ($this->checkPosition('new')) : ?>
                            <div class="badge badge-success ml-auto" title="Новинка">
                                <?php echo $this->renderPosition('new', array(
                                    'style' => 'block'
                                )); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($this->checkPosition('hit')) : ?>
                            <div class="badge badge-warning ml-auto" title="Хит">
                                <?php echo $this->renderPosition('hit', array(
                                    'style' => 'block'
                                )); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($this->checkPosition('sale')) : ?>
                            <div class="badge badge-danger ml-auto" title="Распродажа">
                                <?php echo $this->renderPosition('sale', array(
                                    'style' => 'block'
                                )); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($this->checkPosition('recomend')) : ?>
                            <div class="badge badge-info ml-auto" title="Рекомендуем">
                                <?php echo $this->renderPosition('recomend', array(
                                    'style' => 'block'
                                )); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($this->checkPosition('pod-zakaz')) : ?>
                            <div class="badge badge-danger ml-auto" title="Под заказ">
                                <?php echo $this->renderPosition('pod-zakaz', array(
                                    'style' => 'block'
                                )); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="card-body">
        <?php if ($this->checkPosition('title')) : ?>
            <h4 class="item-title product-title text-primary"><?php echo $this->renderPosition('title'); ?></h4>
        <?php endif; ?>

        <?php if ($this->checkPosition('category')) : ?>
            <h5 class="item-category product-category">
                <?php echo $this->renderPosition('category'); ?>
            </h5>
        <?php endif; ?>

        <?php if ($this->checkPosition('text')) : ?>
            <div class="item-text row mb-1">
                <div class="col-md-12 text-center">
                    <?php echo $this->renderPosition('text', array(
                        'style' => 'jbblock',
                        'class' => 'sizes-block',
                        'tag' => 'div',
                        'wrapperTag' => 'div'
                    )); ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($this->checkPosition('properties')) : ?>
            <div class="item-properties">
                <ul class="list-unstyled mb-1">
                    <?php echo $this->renderPosition('properties', array('style' => 'list')); ?>
                </ul>
            </div>
            <hr class="my-2">
        <?php endif; ?>


        <?php if ($this->checkPosition('price')) : ?>
            <div class="row mb-3 align-items-center">
                <div class="col-12 product-price-container">
                    <div class="item-price">
                        <?php echo $this->renderPosition('price', array('style' => 'block')); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>



        <?php if ($this->checkPosition('buttons')) : ?>
            <div class="row align-items-center">
                <div class="col-12 item-buttons">
                    <?php echo $this->renderPosition('buttons'); ?>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>
