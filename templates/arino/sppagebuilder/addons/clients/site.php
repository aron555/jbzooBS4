<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2019 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct accees
defined('_JEXEC') or die ('Restricted access');

class SppagebuilderAddonClients extends SppagebuilderAddons
{

    public function render()
    {

        $settings = $this->addon->settings;
        $class = (isset($settings->class) && $settings->class) ? ' ' . $settings->class : '';
        $alignment = (isset($settings->alignment) && $settings->alignment) ? ' ' . $settings->alignment : '';
        $columns = (isset($settings->count) && $settings->count) ? $settings->count : 2;
        //Carousel
        $create_carousel = (isset($settings->create_carousel) && $settings->create_carousel) ? $settings->create_carousel : 0;
        $carousel_autoplay = (isset($settings->carousel_autoplay) && $settings->carousel_autoplay) ? $settings->carousel_autoplay : 0;
        $carousel_speed = (isset($settings->carousel_speed) && $settings->carousel_speed) ? $settings->carousel_speed : 2000;
        $carousel_item_number = (isset($settings->carousel_item_number) && $settings->carousel_item_number) ? $settings->carousel_item_number : 4;
        $carousel_item_number_sm = (isset($settings->carousel_item_number_sm) && $settings->carousel_item_number_sm) ? $settings->carousel_item_number_sm : 3;
        $carousel_item_number_xs = (isset($settings->carousel_item_number_xs) && $settings->carousel_item_number_xs) ? $settings->carousel_item_number_xs : 2;
        $carousel_bullet = (isset($settings->carousel_bullet) && $settings->carousel_bullet) ? 'true' : 'false';
        $carousel_arrow = (isset($settings->carousel_arrow) && $settings->carousel_arrow) ? 'true' : 'false';

        $output = '<div class="slick sppb-addon sppb-addon-clients d-flex align-items-center' . $alignment . '' . $class . '"  
		data-slick=\'{
             "dots": ' . $carousel_bullet . ',
             "infinite": true,
             "autoplay": ' . $carousel_autoplay . ',
             "autoplaySpeed": ' . $carousel_speed . ',
             "arrows": ' . $carousel_arrow . ',
             "slidesToScroll": 1,
             "slidesToShow": ' . $carousel_item_number . ',
             
             "responsive": [
                 {"breakpoint": 1024,"settings": {"slidesToShow": ' . $carousel_item_number . '}},
                 {"breakpoint": 768,"settings": {"slidesToShow": ' . $carousel_item_number_sm . '}},
                 {"breakpoint": 480,"settings": {"slidesToShow": ' . $carousel_item_number_xs . '}}
             ]
        }\'
		
>';


        if ($create_carousel) {
            if (isset($settings->sp_clients_item) && is_array($settings->sp_clients_item)) {
                foreach ($settings->sp_clients_item as $item_key => $carousel_item) {
                    $output .= '<div class="sppb-carousel-extended-item">';
                    if (isset($carousel_item->url) && $carousel_item->url) $output .= '<a ' . (isset($carousel_item->url_same_window) && $carousel_item->url_same_window ? '' : 'target="_blank" rel="noopener noreferrer"') . ' rel="nofollow" href="' . $carousel_item->url . '">';
                    $output .= '<img class="sppb-img-responsive sppb-addon-clients-image" src="' . $carousel_item->image . '" alt="' . ((isset($carousel_item->title) && $carousel_item->title) ? $carousel_item->title : '') . '" loading="lazy">';
                    if (isset($carousel_item->url) && $carousel_item->url) $output .= '</a>';
                    $output .= '</div>';
                }
            }
        } else {
            $output .= '<div class="sppb-addon-content">';
            $output .= '<div class="sppb-row">';

            foreach ($settings->sp_clients_item as $key => $value) {
                if (isset($value->image) && $value->image) {
                    //Lazyload image
                    $dimension = $this->get_image_dimension($value->image);
                    $dimension = implode(' ', $dimension);

                    if (strpos($value->image, "http://") !== false || strpos($value->image, "https://") !== false) {
                        $value->image = $value->image;
                    } else {
                        $value->image = JURI::base(true) . '/' . $value->image;
                    }
                    $placeholder = $value->image == '' ? false : $this->get_image_placeholder($value->image);

                    $output .= '<div class="' . $columns . '">';
                    if (isset($value->url) && $value->url) $output .= '<a ' . (isset($value->url_same_window) && $value->url_same_window ? '' : 'target="_blank" rel="noopener noreferrer"') . ' rel="nofollow" href="' . $value->url . '">';
                    $output .= '<img class="sppb-img-responsive sppb-addon-clients-image' . ($placeholder ? ' sppb-element-lazy' : '') . '" src="' . ($placeholder ? $placeholder : $value->image) . '" alt="' . ((isset($value->title) && $value->title) ? $value->title : '') . '" ' . ($placeholder ? 'data-large="' . $value->image . '"' : '') . ' ' . ($dimension ? $dimension : '') . ' loading="lazy">';
                    if (isset($value->url) && $value->url) $output .= '</a>';
                    $output .= '</div>';
                }
            }

            $output .= '</div>';
            $output .= '</div>';
        }

        $output .= '</div>';

        return $output;
    }


    public static function getTemplate()
    {
        $output = '
		
		<# 
		let carousel_item_number = 4;
        let carousel_item_number_sm = 3;
        let carousel_item_number_xs = 2;
        if(_.isObject(data.carousel_item_number)){
            carousel_item_number = data.carousel_item_number.md
            carousel_item_number_sm = data.carousel_item_number.sm
            carousel_item_number_xs = data.carousel_item_number.xs
		}
		#>
		<div class="sppb-addon sppb-addon-clients {{ data.class }} {{ data.alignment }} {{(data.create_carousel ? \' sppb-carousel-extended\' : \'\')}}" data-left-arrow="fa-angle-left" data-right-arrow="fa-angle-right" data-arrow="{{data.carousel_arrow}}" data-dots="{{data.carousel_bullet}}" data-autoplay="{{data.carousel_autoplay}}" data-speed="{{data.carousel_speed || 2000}}" data-interval="{{data.carousel_interval ||3500}}" data-margin="{{data.carousel_margin}}" data-item-number="{{carousel_item_number || 4}}" data-item-number-sm="{{carousel_item_number_sm || 3}}" data-item-number-xs="{{carousel_item_number_xs || 2}}">
			<# if( !_.isEmpty( data.title ) ){ #><{{ data.heading_selector }} class="sppb-addon-title sp-inline-editable-element" data-id={{data.id}} data-fieldName="title" contenteditable="true">{{ data.title }}</{{ data.heading_selector }}><# } #>
			<# if(data.create_carousel) {
				if(typeof data.sp_clients_item !== "undefined" && _.isArray(data.sp_clients_item)){
					_.each(data.sp_clients_item, function(carousel_item){
			#>
						<div class="sppb-carousel-extended-item">
						<# if(carousel_item.url){ #><a {{(carousel_item.url_same_window ? "" : \'target=_blank\')}} rel="nofollow" href=\'{{carousel_item.url}}\'><# } #>
							<# if(carousel_item.image && carousel_item.image.indexOf("https://") == -1 && carousel_item.image.indexOf("http://") == -1){ #>
								<img class="sppb-img-responsive sppb-addon-clients-image" src=\'{{ pagebuilder_base + carousel_item.image }}\' alt="{{ carousel_item.title }}">
							<# } else if(carousel_item.image){ #>
								<img class="sppb-img-responsive sppb-addon-clients-image" src=\'{{ carousel_item.image }}\' alt="{{ carousel_item.title }}">
							<# } #>
						<# if(carousel_item.url){ #></a><# } #>
						</div>
					<# }); 
				}
			} else { #>
			<div class="sppb-addon-content">
				<div class="sppb-row">
					<# _.each(data.sp_clients_item, function(clients_item, key){ #>
						<# if(clients_item.image){ #>
							<div class="{{ data.count }}">
								<# if(clients_item.url){ #><a {{(clients_item.url_same_window ? "" : \'target=_blank\')}} rel="nofollow" href=\'{{clients_item.url}}\'><# } #>
									<# if(clients_item.image && clients_item.image.indexOf("https://") == -1 && clients_item.image.indexOf("http://") == -1){ #>
										<img class="sppb-img-responsive sppb-addon-clients-image" src=\'{{ pagebuilder_base + clients_item.image }}\' alt="{{ clients_item.title }}">
									<# } else if(clients_item.image){ #>
										<img class="sppb-img-responsive sppb-addon-clients-image" src=\'{{ clients_item.image }}\' alt="{{ clients_item.title }}">
									<# } #>
								<# if(clients_item.url){ #></a><# } #>
							</div>
						<# } #>
					<# }); #>
				</div>
			</div>
			<# } #>
		</div>
		';

        return $output;
    }
}
