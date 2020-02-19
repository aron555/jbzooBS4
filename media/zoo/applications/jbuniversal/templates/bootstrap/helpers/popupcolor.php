<?php
/**
 * JBZoo App is universal Joomla CCK, application for YooTheme Zoo component
 * @package     jbzoo
 * @version     2.x Pro
 * @author      JBZoo App http://jbzoo.com
 * @copyright   Copyright (C) JBZoo.com,  All rights reserved.
 * @license     http://jbzoo.com/license-pro.php JBZoo Licence
 * @coder       Sergey Kalistratov <kalistratov.s.m@gmail.com>
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

/**
 * Class PopupColorHelper
 */
class PopupColorHelper extends JBHtmlHelper
{

    public function colors(
        $inputType = 'checkbox',
        $data,
        $name,
        $selected = null,
        $attrs = array(),
        $width = '100px',
        $height = '100px',
        $titles = array()
    )
    {
        $stringHelper = $this->_string;
        $jbstring     = $this->_jbstring;
        $jbcolor      = $this->app->jbcolor;

        $unique = $jbstring->getId('jbcolor-');

        $attrs['id']    = $unique;
        $attrs['class'] = 'jbzoo-colors';

        $html   = array();
        $html[] = '<div ' . $this->_buildAttrs($attrs) . '>';

        $i = 0;
        foreach ($data as $value => $color) {
            $isFile = false;
            if ($jbcolor->isFile($color)) {
                $isFile = $color;
            }

            $i++;
            $inputId   = $jbstring->getId('jbcolor-input-');
            $inputAttr = array(
                'type'  => $inputType,
                'name'  => $name,
                'id'    => $inputId, 
                'title' => isset($titles[$value]) ? $titles[$value] : $value,
                'value' => $value,
                'class' => 'jbcolor-input'
            );

            $labelAttr = array(
                'for'   => $inputId,
                'title' => isset($titles[$value]) ? $titles[$value] : $value,
                'class' => array(
                    $inputType,
                    'jbcolor-label',
                    'value-' . $stringHelper->sluggify($value),
                    'hasTip'
                ),
                'style' => 'width:' . $width . ';height:' . $height . ';'
            );

            $attr = array(
                'style' => ' background-color: ' . (!$isFile ? '#' . $color . ';' : 'transparent; width:' . $width . ';height:' . $height . ';')
            );

            if ($selected != null && ($selected == $value || is_array($selected) && in_array($value, $selected))) {
                $inputAttr['checked'] = 'checked';
                $inputAttr['class'] .= ' checked';
            }

            $html[] = '<input ' . $this->_buildAttrs($inputAttr) . '/>';
            $html[] = '<div class="odin-cvet"><label ' . $this->_buildAttrs($labelAttr) . '>';
            $html[] = ($isFile ? '<div class="checkIn" style="background: url(\'' . $isFile . '\') center;">' : '');

            $html[] = '<div ' . $this->_buildAttrs($attr) . '></div>';

            $html[] = ($isFile ? '</div>' : '') . '</label>';

            if ($isFile) {
                $popupAttrs = array(
                    'href'  => $isFile,
                    'id'    => 'color-link',
                    'class' => 'color-gallery',
                    'rel'   => 'gallery-' . $unique,
                    'title' => $labelAttr['title']
                );

                //$html[] = '<br/><span class="div-link-color"><a ' . $this->_buildAttrs($popupAttrs) . '>Увеличить</a></span></div>';
            }

        }

        $html[] = '</div>';
        $html[] = $this->_assets->initJBColorHelper($unique, $inputType == 'checkbox' ? 1 : 0, true);

        $html[] = $this->app->jbassets->widget('#' . $unique . ' .color-gallery', 'fancybox', array(
            'helpers' => array(
                'title'   => array('type' => 'outside'),
                'buttons' => array('position' => "top"),
                'thumbs'  => array('width' => 90, 'height' => 90),
                'overlay' => array('locked' => false)
            )
        ), true);

        return implode(PHP_EOL, $html);
    }

}