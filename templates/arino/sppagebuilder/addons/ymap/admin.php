<?php
/**
* @package SP Page Builder
* @author JoomShaper http://www.joomshaper.com
* @copyright Copyright (c) 2010 - 2018 JoomShaper
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');


$ymap_config = array(
	'admin_label'=>array(
		'type'=>'text',
		'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
		'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
		'category'=>'General',
		'std'=> ''
	)
);

$ymap_config['map'] = array(
	'type'=>'text',
	'title'=>'Код карты',//JText::_('COM_SPPAGEBUILDER_ADDON_YMAP_CODE')
	'desc'=>'',//JText::_('COM_SPPAGEBUILDER_ADDON_YMAP_CODE_DESC')
    'category'=>'General',
    'std'=> ''
);

$ymap_config['scroll'] = array(
	'type'=>'checkbox',
	'title'=>'Скролл',//JText::_('COM_SPPAGEBUILDER_ADDON_YMAP_SCROLL')
	'desc'=>'',//JText::_('COM_SPPAGEBUILDER_ADDON_YMAP_SCROLL_DESC')
	'values'=>array(
		1=> JText::_('YES'),
		0=> JText::_('NO'),
	),
	'std'=> 0
);

$ymap_config['width'] = array(
    'type'=>'text',
    'title'=>'Ширина',//JText::_('COM_SPPAGEBUILDER_ADDON_YMAP_WIDTH')
    'desc'=>'',//JText::_('COM_SPPAGEBUILDER_ADDON_YMAP_WIDTH_DESC')
    'category'=>'General',
    'std'=> 'auto',
    'depends'=>array(array('map', '!=', ''))
);

$ymap_config['height'] = array(
	'type'=>'slider',
	'title'=>'Высота',//JText::_('COM_SPPAGEBUILDER_ADDON_YMAP_HEIGHT')
	'desc'=>'',//JText::_('COM_SPPAGEBUILDER_ADDON_YMAP_HEIGHT_DESC')
    'category'=>'General',
    'std'=> '400',
    'placeholder'=>'400',
    'max'=>2000,
    'responsive'=>true,
	'depends'=>array(array('map', '!=', ''))
);

$ymap_config['class'] = array(
	'type'=>'text',
	'title'=>'Класс обертки',//JText::_('COM_SPPAGEBUILDER_ADDON_CLASS')
	'desc'=>'',//JText::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC')
	'std'=>''
);

SpAddonsConfig::addonConfig(
	array(
		'type'=>'content',
		'addon_name'=>'sp_ymap',
		'title'=>'Яндекс карта',//JText::_('COM_SPPAGEBUILDER_ADDON_YMAP')
		'desc'=>'',//JText::_('COM_SPPAGEBUILDER_ADDON_YMAP_DESC')
		'attr'=>array(
			'general' => $ymap_config
		),
	)
);
