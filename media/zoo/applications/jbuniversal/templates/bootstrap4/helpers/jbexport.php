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

/**
 * Class JBExportHelper
 */
class JBExportHelper extends AppHelper
{
    const STEP_SIZE = 500;
    const EXPORT_PATH = 'jbzoo-export';

    /**
     * @var JBCSVMapperHelper
     */
    protected $_mapper = null;

    /**
     * @param App $app
     */
    public function __construct($app)
    {
        parent::__construct($app);

        $this->app->jbenv->maxPerformance();
        $this->_mapper = $this->app->jbcsvmapper;
    }

    /**
     * Categories to CSV
     * @param null $appId
     * @param array $options
     * @return bool|string
     * @throws AppException
     */
    public function categoriesToCSV($appId = null, $options = array())
    {
        $files = array();
        $offset = 0;

        $options['limit'] = array($offset, self::STEP_SIZE);

        while ($categories = $this->_getCategoryList($appId, $options)) {

            $categoriesByApp = $this->app->jbarray->groupByKey($categories, 'application_id');

            foreach ($categoriesByApp as $appId => $categories) {
                $application = $this->app->table->application->get($appId);
                $files[$appId] = $this->_exportCategoryToFile($categories, $application->alias, $options);
            }

            // shift the offset
            $offset += self::STEP_SIZE;
            $options['limit'] = array($offset, self::STEP_SIZE);
        }

        return $files;
    }

    /**
     * Items to CSV
     * @param       $appId
     * @param       $typeId
     * @param null $catId
     * @param array $options
     * @return bool|string
     * @throws AppException
     */
    public function getTotalItems($appId = null, $catId = null, $typeId = null, $options = array())
    {
        return JBModelItem::model()->getTotal($appId, $typeId, $catId);
    }

    /**
     * Items to CSV
     * @param       $appId
     * @param       $typeId
     * @param null $catId
     * @param array $options
     * @return bool|string
     * @throws AppException
     */
    public function itemsToCSV($appId = null, $catId = null, $typeId = null, $options = array())
    {

        $items = $this->_getItemList($appId, $catId, $typeId, $options);
        $itemsByTypes = $this->app->jbarray->groupByKey($items, 'type');

        // convert items group to csv
        $files = array();
        foreach ($itemsByTypes as $itemType => $items) {
            $files[$itemType] = $this->_exportTypeToFile($items, $itemType, $options);
        }

        return $files;
    }

    /**
     * Export data to CSV file by item type
     * @param array $items
     * @param string $typeId
     * @param array $options
     * @return bool|string
     */
    protected function _exportTypeToFile(array $items, $typeId, $options)
    {
        $maxima = $data = array();


        /*START CUSTOM*/
        /*В пользовательских полях уровеь доступа Гость - 5
        В jbcsvmapper.php стоит ограничение, чтобы эти поля не экспорторовать
         */
        $nbsp = '';// символ для создания ячейки
        $max = $maxUser = $maxCore = [];

        // найдем максимальное количество значений массива поля
        foreach ($items as $item) {

            $IU = $this->_mapper->getItemUser($item);
            $IC = $this->_mapper->getItemCore($item);

            foreach ($IU as $kIts => $its) {
                $countItsUser[$kIts][] = count($IU[$kIts]);
                $maxUser[$kIts] = max($countItsUser[$kIts]);
            }

            foreach ($IC as $kIts => $its) {
                $countItsCore[$kIts][] = count($IC[$kIts]);
                $maxCore[$kIts] = max($countItsCore[$kIts]);
            }

            $max = array_merge($maxUser, $maxCore);

        }

        $superCat = $options->find("maxCat", 0);
        $maxCat = ($superCat > $max['category']) ? $superCat : $max['category'];
        $options->set("maxCat", $maxCat);


        foreach ($items as $item) {

            $data[$item->id] = $this->_mapper->getItemBasic($item);

            if ((int)$options->get('fields_user')) {

                $IU = $this->_mapper->getItemUser($item);

                foreach ($IU as $kIts => $its) {

                    //$nbsp = $kIts;

                    // пустой массов
                    if (empty($IU[$kIts])) {

                        $empty = array_fill(0, 1, $nbsp);
                        $IU[$kIts] = array_merge($IU[$kIts], $empty);
                        //echo "<pre>";var_dump($empty, $IU[$kIts], $kIts);echo "</pre>";
                    } else {
                        $count = count($IU[$kIts]);

                        $dob = array_fill($count, ($max[$kIts] - $count), $nbsp);
                        $IU[$kIts] = array_merge($IU[$kIts], $dob);
                        // массив с одним пустым значением
                        foreach ($its as $kIt => $it) {
                            if ($IU[$kIts][$kIt] == "") {
                                $IU[$kIts] = array_fill(0, 1, $nbsp);
                            }
                        }
                    }

                }

                //echo "<pre>";var_dump($IU);echo "</pre>";
                $data[$item->id] = array_merge($data[$item->id], $IU);
            }

            if ((int)$options->get('fields_price')) {

                $IP = $this->_mapper->getItemPrice($item);

                foreach ($IP as $kIts => $its) {

                    //$nbsp = $kIts;

                    // пустой
                    if ($IP[$kIts] == "") {
                        $IP[$kIts] = $nbsp;
                    }
                    //echo "<pre>";var_dump($its);echo "</pre>";
                }


                $data[$item->id] = array_merge($data[$item->id], $IP);
            }

            if ((int)$options->get('fields_config')) {
                $IC = $this->_mapper->getItemMeta($item);

                foreach ($IC as $kIts => $its) {

                    //$nbsp = $kIts;

                    // пустой
                    if ($IC[$kIts] == "") {
                        $IC[$kIts] = $nbsp;
                    }
                }
                //echo "<pre>";var_dump($IC);echo "</pre>";
                $data[$item->id] = array_merge($data[$item->id], $IC);
            }

            if ((int)$options->get('fields_meta')) {

                $IM = $this->_mapper->getItemMeta($item);
                foreach ($IM as $kIts => $its) {

                    //$nbsp = $kIts;

                    // пустой
                    if ($IM[$kIts] == "") {
                        $IM[$kIts] = $nbsp;
                    }
                }
                //echo "<pre>";var_dump($IM);echo "</pre>";

                $data[$item->id] = array_merge($data[$item->id], $IM);
            }

            if ((int)$options->get('fields_core')) {

                $IC = $this->_mapper->getItemCore($item);

                foreach ($IC['category'] as $kIts => $its) {
                    //$nbsp = $kIts;
                    // массив с множеством значений
                    $count = count($IC['category']);
                    if ($maxCat >= $count) {
                        $dob = array_fill($count, ($maxCat - $count), $nbsp);
                        $IC['category'] = array_merge($IC['category'], $dob);
                    }

                }
                //echo "<pre>";var_dump($IC);echo "</pre>";
                $data[$item->id] = array_merge($data[$item->id], $IC);
            }

            /*if ((int)$options->get('fields_item_url', 0)) {
                $data[$item->id] = array_merge($data[$item->id], $this->_mapper->getItemUrl($item));
            }*/

            /*END CUSTOM*/
        }


        $offset = $options->find('limit.0', 0);
        $addHeader = $offset == 0 ? true : false;
        $file = 'items__' . $typeId . '__' . $offset;

        return $this->app->jbcsv->toFile($data, $file, $maxima, $addHeader);
    }

    /**
     * Export data to CSV file by item type
     * @param array $categories
     * @param int $appId
     * @param array $options
     * @return bool|string
     */
    protected function _exportCategoryToFile(array $categories, $appId, $options = null)
    {
        $data = array();
        foreach ($categories as $category) {
            $data[$category->id] = $this->_mapper->getCategory($category);
        }

        return $this->app->jbcsv->toFile($data, 'categories_' . $appId);
    }

    /**
     * Get item list
     * @param       $appId
     * @param       $typeId
     * @param null $catId
     * @param array $options
     * @return mixed
     */
    protected function _getItemList($appId = null, $catId = null, $typeId = null, $options = array())
    {
        if (!isset($options['order'])) {
            $options['order'] = 'id';
        }

        $options['published'] = $options['state'];

        return JBModelItem::model()->getList($appId, $catId, $typeId, $options);
    }

    /**
     * Get category list
     * @param       $appId
     * @param array $options
     * @return mixed
     */
    protected function _getCategoryList($appId = null, $options = array())
    {
        return JBModelCategory::model()->getList($appId, $options);
    }

    /**
     * Remove old temp files
     */
    public function clean()
    {
        $folder = $this->app->jbpath->sysPath('tmp', '/' . JBExportHelper::EXPORT_PATH . '/');

        if (JFolder::exists($folder)) {
            JFolder::delete($folder);
        }

        JFolder::create($folder);
    }

    /**
     * @return array
     */
    public function splitFiles()
    {
        /** @var JBFileHelper $jfile */
        $jfile = $this->app->jbfile;
        $exportPath = $this->app->jbpath->sysPath('tmp', '/' . self::EXPORT_PATH);
        $files = JFolder::files($exportPath, '\.csv$');

        $filesGroup = array();
        foreach ($files as $file) {
            if (preg_match('#items__(.*?)__(\d*)\.csv#', $file, $matches)) {

                if (!isset($filesGroup[$matches[1]])) {
                    $filesGroup[$matches[1]] = array();
                }

                $filesGroup[$matches[1]][] = $file;
                natsort($filesGroup[$matches[1]]);
            }
        }

        $itemTypesList = array();
        foreach ($filesGroup as $itemType => $group) {

            $content = array();
            foreach ($group as $file) {
                if ($fileContent = $jfile->read($exportPath . '/' . $file)) {
                    $content[] = $fileContent;
                }
            }

            $resultCsv = JPath::clean($exportPath . '/' . $itemType . '.csv');
            $jfile->save($resultCsv, implode("", $content));

            $itemTypesList[] = $resultCsv;
        }

        return $itemTypesList;
    }

}
