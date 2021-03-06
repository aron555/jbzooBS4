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
 * Class JBBootstrapHelper
 */
class JBBootstrapHelper extends AppHelper
{

    /**
     * Grid columns.
     *
     * @var int
     */
    protected $_grid = 12;

    /**
     * Get bootstrap version by app params.
     *
     * @return int
     */
    public function version()
    {
        return (int)$this->app->zoo->getApplication()->params->get('global.template.version', 4);
    }

    /**
     * Get row class by bootstrap version.
     *
     * @return string
     */
    public function getRowClass()
    {
        return 'row';
    }

    /**
     * Get column number.
     *
     * @param int $cols
     * @return float
     */
    public function getColsNum($cols = 2)
    {
        $cols   = (int)$cols;
        $output = $this->_grid / $cols;

        if ($cols == 5) {
            $output = '1-' . $cols;
        }

        return $output;
    }

    /**
     * Get grid class by version.
     *
     * @param $col
     * @return string
     */
    public function gridClass($col)
    {
        $output  = $this->_getColPrefix();
        $output .= $col;

        return $output;
    }

    /**
     * Get grid class for JBZoo content columns.
     *
     * @param int $cols
     * @return string
     */
    public function columnClass($cols = 2)
    {
        $output  = $this->_getColPrefix();
        $output .= $this->getColsNum($cols);

        return $output;
    }

    /**
     * Create bootstrap icon.
     *
     * @param string $icon
     * @param array $attrs
     * @return string
     */
    public function icon($icon = 'home', $attrs = array())
    {
        if (isset($attrs['class'])) {
            unset($attrs['class']);
        }

        $attrs['class'] = ' fa fa-' . $icon;


        return '<i ' . $this->app->jbhtml->buildAttrs($attrs) . '></i>';
    }

    /**
     * Bootstrap pagination.
     *
     * @param $pagination
     * @param $url
     * @return string
     */
    public function paginate($pagination, $url)
    {
        $html = '';

        if ($pagination->pages() > 1) {

            $rangeStart = max($pagination->current() - $pagination->range(), 1);
            $rangeEnd   = min($pagination->current() + $pagination->range() - 1, $pagination->pages());

            if ($pagination->current() > 1) {
                $link = $url;
                $html .= '<li class="page-item"><a class="page-link" href="' . JRoute::_($link) . '">' . JText::_('JBZOO_BOOTSTRAP_PAGINATE_FIRST') . '</a></li>';
                $link = $pagination->current() - 1 == 1 ? $url : $pagination->link($url, $pagination->name() . '=' . ($pagination->current() - 1));
                $html .= '<li class="page-item"><a class="page-link" href="' . JRoute::_($link) . '">&laquo;</a></li>';
            }

            for ($i = $rangeStart; $i <= $rangeEnd; $i++) {
                if ($i == $pagination->current()) {
                    $html .= '<li class="page-item active"><span class="page-link">' . $i . '</span></li>';
                } else {
                    $link = $i == 1 ? $url : $pagination->link($url, $pagination->name() . '=' . $i);
                    $html .= '<li class="page-item"><a class="page-link" href="' . JRoute::_($link) . '">' . $i . '</a></li>';
                }
            }

            if ($pagination->current() < $pagination->pages()) {
                $link = $pagination->link($url, $pagination->name() . '=' . ($pagination->current() + 1));
                $html .= '<li class="page-item"><a class="page-link" href="' . JRoute::_($link) . '">&raquo;</a></li>';
                $link = $pagination->link($url, $pagination->name() . '=' . ($pagination->pages()));
                $html .= '<li class="page-item"><a class="page-link" href="' . JRoute::_($link) . '">' . JText::_('JBZOO_BOOTSTRAP_PAGINATE_LAST') . '</a></li>';
            }

        }

        return $html;
    }

    /**
     * Get bootstrap grid class prefix by version.
     *
     * @return string
     */
    protected function _getColPrefix()
    {
        return 'col-md-';
    }

}
