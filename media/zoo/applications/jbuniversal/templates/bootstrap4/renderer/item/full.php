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


/*item meta hack*/
$document = JFactory::getDocument();
$document->setGenerator('');
$document->setMetadata('author', '');

$city = 'Подольске';
$tel = '+7 (999) 395-40-43';
$nameSite = 'Двери Вам';
$descPosition = 'description';
$titleLow = mb_strtolower($item->name); // для материала
$descFull = "Заказать " . $titleLow . " с доставкой по выгодной цене в " . $city . " в интернет магазине " . $nameSite . ". " . $tel;
$descCat = !empty($this->renderPosition($descPosition)) ? ' ' . strip_tags($this->renderPosition($descPosition)) : '';
$descTrim = mb_strimwidth($descFull . $descCat, 0, 250, "...");
if (empty($item->getParams()->get('metadata.title'))) {
    $document->setTitle("Купить " . $titleLow . " с доставкой по выгодной цене в " . $city); // заголовок
}
if (empty($item->getParams()->get('metadata.description'))) {
    $document->setDescription($descTrim); // описание
}
if (empty($item->getParams()->get('metadata.keywords'))) {
    $document->setMetaData('keywords', "Заказать " . $titleLow . ", " . $titleLow . " с доставкой, " . $titleLow . " по выгодной цене, " . $titleLow . " в " . $city);
}// ключевые слова

$document->setMetaData('og:title', $item->name);
$document->setMetaData('og:type', 'website');

//$document->setMetaData( 'og:image', 'http://ssss/images/logo.png');
$document->setMetaData('og:site_name', $nameSite);
$document->setMetaData('og:description', $item->name);

/*EO item meta hack*/
?>


<?php
$imageId = '';
$descriptionId = '';
$pricePlainId = '';
if ($imageId != '' && $descriptionId != '' && $pricePlainId != '') {
    ?>
    <div hidden>
        <?php
        $host = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';

        $image0src = $item->getElement($imageId)->data()[0]['file'];
        ?>
        <div itemscope itemtype="http://schema.org/Product">
            <span itemprop="name"><?= $item->name; ?></span>
            <?php
            if ($image0src) {
                ?>
                <img src="<?= $host . $image0src; ?>" itemprop="image" alt="<?= $item->name; ?>">
                <?php
            } else {
                ?>
                <img src="<?= $host; ?>images/nophoto.webp" itemprop="image" alt="<?= $item->name; ?>">
                <?php
            }
            ?>
            <?php if ($this->checkPosition('description')) : ?>
                <?php
                $desc = strip_tags($item->getElement($descriptionId)->data()[0]['value']);
                ?>

                <meta itemprop="description" content="<?= $desc; ?>">
            <?php endif; ?>

            <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                <?php
                $itemUrl = $this->app->route->item($item);
                $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $itemUrl;
                ?>
                <meta itemprop="url" content="<?= $url; ?>">
                <?php
                $data = $item->getElement($pricePlainId)->getIndexData();
                //echo "<pre>";var_dump($data[$item->id.'__'.$pricePlainId.'__0___value']["value_s"], $data, $item->id);echo "</pre>";
                $pr = $data[$item->id . '__' . $pricePlainId . '__0___value']["value_s"];
                ?>
                <?php
                if ($pr) {
                    ?>
                    <meta itemprop="price" content="<?= $pr; ?>">
                    <?php
                } else {
                    ?>
                    <meta itemprop="lowPrice" content="100">
                    <?php
                }
                ?>
                <meta itemprop="priceCurrency" content="RUB">
                <link itemprop="availability" href="http://schema.org/InStock"/>
                <meta itemprop="priceValidUntil"
                      content="<?= date('Y-m-d', strtotime(date("Y-m-d", mktime()) . " + 365 day")) ?>">

            </div>

        </div>
    </div>
    <?php
} ?>


    <div class="full-block">
        <div class="row full-row">
            <div class="col-md-4 full-left">
                <?php if ($this->checkPosition('image')) : ?>

                    <div class="item-image position-relative overflow-hidden">
                        <?php echo $this->renderPosition('image'); ?>
                        <div class="position-absolute top-right d-flex flex-column mx-1 mb-1">
                            <?php if ($this->checkPosition('new')) : ?>
                                <div class="badge badge-success ml-auto">
                                    <?php echo $this->renderPosition('new', array(
                                        'style' => 'jbblock',
                                        'tag' => 'span',
                                        'wrapperTag' => 'span'
                                    )); ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($this->checkPosition('hit')) : ?>
                                <div class="badge badge-warning ml-auto">
                                    <?php echo $this->renderPosition('hit', array(
                                        'style' => 'jbblock',
                                        'tag' => 'span',
                                        'wrapperTag' => 'span'
                                    )); ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($this->checkPosition('sale')) : ?>
                                <div class="badge badge-danger ml-auto">
                                    <?php echo $this->renderPosition('sale', array(
                                        'style' => 'jbblock',
                                        'tag' => 'span',
                                        'wrapperTag' => 'span'
                                    )); ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($this->checkPosition('recomend')) : ?>
                                <div class="badge badge-info ml-auto">
                                    <?php echo $this->renderPosition('recomend', array(
                                        'style' => 'jbblock',
                                        'tag' => 'span',
                                        'wrapperTag' => 'span'
                                    )); ?>
                                </div>
                            <?php endif; ?>
                        </div>
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
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <h1 class="item-title"><?php echo $this->renderPosition('title'); ?></h1>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($this->checkPosition('choose')) : ?>
                    <div class="row mb-3">
                        <div class="col-md-12 item-choose">
                            <?php echo $this->renderPosition('choose', array('style' => 'block')); ?>
                        </div>
                    </div>
                <?php endif; ?>


                <div class="row mb-3">
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

                <div class="row align-items-center mb-3">

                    <?php if ($this->checkPosition('sku')) : /*Артикул*/ ?>
                        <div class="col-4 item-sku">
                            <?php echo $this->renderPosition('sku', array('style' => 'block')); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($this->checkPosition('favorite')) : ?>
                        <div class="col-auto item-favorite">
                            <?php echo $this->renderPosition('favorite', array('style' => 'block')); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($this->checkPosition('social')) : /*Сравнить*/ ?>
                        <div class="col-auto item-social">
                            <?php echo $this->renderPosition('social', array('style' => 'block')); ?>
                        </div>
                    <?php endif; ?>

                </div>

                <?php if ($this->checkPosition('text')) : ?>
                    <div class="row mb-3">
                        <div class="col-md item-text">
                            <?php echo $this->renderPosition('text', array('style' => 'block')); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($this->checkPosition('brand')) : ?>
                    <div class="row mb-3">
                        <div class="col-md-12 item-brand">
                            <?php echo $this->renderPosition('brand', array('style' => 'block')); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>

    <div class="item-tabs">
        <ul id="<?php echo $tabsId; ?>" class="nav nav-tabs mb-3" role="tablist">
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