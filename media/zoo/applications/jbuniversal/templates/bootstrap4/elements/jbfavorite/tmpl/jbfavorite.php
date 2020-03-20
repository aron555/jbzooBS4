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

$this->app->jbassets->favorite();

$uniqId    = $this->app->jbstring->getId('favorite-');
$bootstrap = $this->app->jbbootstrap;
$wrapAttrs = array(
    'id'    => $uniqId,
    'class' => array(
        'jsJBZooFavorite',
        'jbfavorite-buttons',
        $isExists ? ' active ' : 'unactive'
    )
);

?>
<!--noindex-->
<div <?php echo $this->app->jbhtml->buildAttrs($wrapAttrs); ?>>
    <div class="jbfavorite-active">
        <a rel="nofollow" href="<?php echo $favoriteUrl; ?>" class="btn btn-primary"
           data-toggle="tooltip" data-placement="top" title="<?php echo JText::_('JBZOO_FAVORITE_ITEMS'); ?>">
            <i class="fa fa-heart"></i>
            <?php //echo JText::_('JBZOO_FAVORITE'); ?>
        </a>

        <!--<span class="btn btn-danger jsFavoriteToggle" title="<?php /*echo JText::_('JBZOO_FAVORITE_REMOVE_ITEM'); */?>">
            <i class="fa fa-trash"></i>
        </span>-->
    </div>

    <div class="jbfavorite-unactive">
        <span class="btn btn-outline-primary waves-effect jsFavoriteToggle" data-toggle="tooltip" data-placement="top"
              title="<?php echo JText::_('JBZOO_FAVORITE_ADD'); ?>">
            <i class="fas fa-heart"></i>
        </span>
    </div>
</div><!--/noindex-->

<?php echo $this->app->jbassets->widget('#' . $uniqId, 'JBZooFavoriteButtons', array(
    'url_toggle' => $ajaxUrl,
), true); ?>
