<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_search
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;


$cols     = 4;

$app         = App::getInstance('zoo');
$application = $app->zoo->getApplication();
$template    = $application->getTemplate();

/** @var JBLayoutHelper $jblayout */
$jblayout = $app->jblayout;

$this->params->set('template.item_cols', $cols);
$this->params->set('template.item_order', 0);
$this->application = $application;
$this->renderer    = $app->renderer->create('item')->addPath(array(
    $app->path->path('component.site:'),
    $template->getPath(),
));

$jblayout->setView($this);
$isCategory = plgSearchZooCategory::getCategory();
$currentUrl = $app->jbenv->getCurrentUrl();


$itemIds = array();
foreach($this->results as $result) {
    if (isset($result->item_id)) {
        $itemIds[$result->item_id] = $result->item_id;
    }
}

if ($itemIds) {
    $items = plgSearchZooCategory::createItems($itemIds);
    ?>
    <h1 class="h3">Вот, что мы нашли по запросу: "<?= $this->escape($this->origkeyword) ?>"</h1>
<?php
    echo $jblayout->render('items', $items);
} ?>

<h3>
    Если вы не смогли найти интересующий вас товар на нашем сайте, обязательно позвоните нашим менеджерам
</h3>


<!--<div class="pagination">
    <?php /*echo $this->pagination->getPagesLinks(); */?>
</div>-->



