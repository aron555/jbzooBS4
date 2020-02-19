<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2018 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

class SppagebuilderAddonYmap extends SppagebuilderAddons {

	public function render() {

		$settings = $this->addon->settings;
		$class = (isset($settings->class) && $settings->class) ? $settings->class : '';

		//Options
		$map = (isset($settings->map) && $settings->map) ? $settings->map : '';
		$width = (isset($settings->width) && $settings->width) ? $settings->width : '';
		$height = (isset($settings->height) && $settings->height) ? $settings->height : '';
		$scroll = (isset($settings->scroll) && $settings->scroll) ? $settings->scroll : '';

		if($map) {
			$output  = '<div id="sppb-addon-map-'. $this->addon->id .'" class="sppb-addon sppb-addon-ymap ' . $class . '">';
			$output .= '<div class="sppb-addon-content">';
			$output .= '<div id="sppb-addon-ymap-'. $this->addon->id .'" class="sppb-addon-ymap-canvas">';
			$output .= '<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%'.$map.'&amp;width='.$width.'&amp;height='.$height.'&amp;lang=ru_RU&amp;scroll='.$scroll.'"></script>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';

			return $output;

		}

		return;
	}


}
