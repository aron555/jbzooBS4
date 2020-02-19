<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_search
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('bootstrap.tooltip');

$lang       = JFactory::getLanguage();
$upperLimit = $lang->getUpperLimitSearchWord();

$app = App::getInstance('zoo');

$category = plgSearchZooCategory::getCategory();

$application  = $app->zoo->getApplication();


$this->total = plgSearchZooCategory::getTotal($this->results);

$categoryList = $app->html->_('zoo.categorylist',
    $application,
    array($app->html->_('select.option', '0', JText::_('JBZOO_ALL'))), 'areas',
    '', 'value', 'text', $category, false, false, 0, '<sup>|_</sup>&nbsp;', '.&nbsp;&nbsp;&nbsp;', ''
);

?>
<form action="<?php echo JRoute::_('index.php?option=com_search'); ?>" method="post" >

    <?php echo $categoryList; ?>

    <input type="search" name="searchword" placeholder="<?php echo JText::_('COM_SEARCH_SEARCH_KEYWORD'); ?>"
           id="search-searchword" size="30" maxlength="<?php echo $upperLimit; ?>"
           value="<?php echo $this->escape($this->origkeyword); ?>" />

    <input type="submit" name="Search" value="<?php echo JHtml::tooltipText('COM_SEARCH_SEARCH'); ?>"
           class="button btn btn-primary" />

    <input type="hidden" name="task" value="search" />
    <input type="hidden" name="searchphrase" value="all" />
    <input type="hidden" name="limit" value="40" />
    <input type="hidden" name="start" value="0" />
    <input type="hidden" name="Itemid" value="<?php echo (int)$app->jbrequest->get('Itemid'); ?>" />

</form>

<p>
    Если по вашему запросу нечего не нашлось, обязательно позвоните +7 (495) 644-35-48, наши менеджеры подберут вам все необходимое.
</p>