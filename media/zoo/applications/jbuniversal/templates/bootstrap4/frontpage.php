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

include dirname(__FILE__) . '/category.php';

jimport('joomla.application.module.helper');
$moduleJbzooFrontpage = JModuleHelper::getModules('jbzoo-frontpage'); // заполняем массив модулями, опубликованными в позиции

if (!empty($moduleJbzooFrontpage)) {
    ?>
    <div class="my-3">
        <?php
        $attribs['style'] = 'none'; // указываем стиль вывода модуля none (так как при использовании стиля xhtml наблюдается дублирование заголовков модуля)

        foreach ($moduleJbzooFrontpage as $moduleitem) { // перебираем в цикле и выводим по очереди все модули из позиции category-filter
            echo JModuleHelper::renderModule($moduleitem, $attribs);
        }
        ?>
    </div>
    <?php
}