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

//$align = $this->app->jbitem->getMediaAlign($item, $layout);
$tabsId = $this->app->jbstring->getId('tabs');
//$bootstrap = $this->app->jbbootstrap;
//$rowClass = $bootstrap->getRowClass();
?>

    <div class="clearfix full-block">
        <div class="row full-row">
            <div class="col-md-4 full-left">
                <?php if ($this->checkPosition('image')) : ?>
                    <div class="item-image">
                        <?php echo $this->renderPosition('image'); ?>
                    </div>
                <?php endif; ?>
                <?php if ($this->checkPosition('image2')) : ?>
                    <div class="item-image2">
                        <?php echo $this->renderPosition('image2'); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="col-md full-right">

                <?php if ($this->checkPosition('title')) : ?>
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="item-title"><?php echo $this->renderPosition('title'); ?></h1>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($this->checkPosition('choose')) : ?>
                    <div class="row">
                        <div class="col-md-12 item-choose">
                            <?php echo $this->renderPosition('choose', array('style' => 'block')); ?>
                        </div>
                    </div>
                <?php endif; ?>


                <div class="row">
                    <?php if ($this->checkPosition('price')) : ?>
                        <div class="col-md-4 col-12 item-price">
                            <?php echo $this->renderPosition('price'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($this->checkPosition('quantity')) : ?>
                        <div class="col-md-4 col-auto item-quantity">
                            <?php echo $this->renderPosition('quantity', array('style' => 'block')); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($this->checkPosition('buttons')) : ?>
                        <div class="col-md-4 col-auto item-buttons">
                            <?php echo $this->renderPosition('buttons', array('style' => 'block')); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="row align-items-center">

                    <?php if ($this->checkPosition('sku')) : /*Артикул*/?>
                        <div class="col-4 item-sku">
                            <?php echo $this->renderPosition('sku', array('style' => 'block')); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($this->checkPosition('favorite')) : ?>
                        <div class="col-auto item-favorite">
                            <?php echo $this->renderPosition('favorite', array('style' => 'block')); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($this->checkPosition('social')) : /*Сравнить*/?>
                        <div class="col-auto item-social">
                            <?php echo $this->renderPosition('social', array('style' => 'block')); ?>
                        </div>
                    <?php endif; ?>

                </div>

                <?php if ($this->checkPosition('text')) : ?>
                <div class="row">
                    <div class="col-md item-text">
                        <?php echo $this->renderPosition('text', array('style' => 'block')); ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ($this->checkPosition('brand')) : ?>
                    <div class="row">
                        <div class="col-md-12 item-brand">
                            <?php echo $this->renderPosition('brand', array('style' => 'block')); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>

    <div class="item-tabs">
        <ul id="<?php echo $tabsId; ?>" class="nav nav-tabs" role="tablist">
            <?php if ($this->checkPosition('description')) : ?>
                <li class="nav-item">
                    <a class="nav-link active" href="#item-desc" id="desc-tab" data-toggle="tab" aria-selected="true">
                        <?php echo JText::_('JBZOO_ITEM_TAB_DESCRIPTION'); ?>
                    </a>
                </li>
            <?php endif; ?>

            <?php if ($this->checkPosition('properties')) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="#item-prop" id="prop-tab" data-toggle="tab" aria-selected="false">
                        <?php echo JText::_('JBZOO_ITEM_TAB_PROPS'); ?>
                    </a>
                </li>
            <?php endif; ?>

        </ul>
        <div id="<?php echo $tabsId; ?>Content" class="tab-content">
            <?php if ($this->checkPosition('description')) : ?>
                <div class="tab-pane show active" id="item-desc" role="tabpanel" aria-labelledby="item-desc-tab">
                    <div class="item-desc">
                        <?php echo $this->renderPosition('description', array('style' => 'block')); ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($this->checkPosition('properties')) : ?>
                <div class="tab-pane" id="item-prop" role="tabpanel" aria-labelledby="item-prop-tab">
                    <table class="table table-hover">
                        <?php echo $this->renderPosition('properties', array(
                            'tooltip' => true,
                            'style' => 'jbtable',
                        )); ?>
                    </table>
                </div>
            <?php endif; ?>

        </div>
    </div>

<?php if ($this->checkPosition('related')) : ?>
    <div class="related-row">
        <h4 class="h3 my-3">Похожие товары</h4>
            <?php echo $this->renderPosition('related', array(
                'style' => 'default',
                'class' => '',
            )); ?>
    </div>
<?php endif; ?>