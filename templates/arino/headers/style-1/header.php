<?php
/**
 * @package Helix Ultimate Framework
 * @author JoomShaper https://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2019 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
*/

defined ('_JEXEC') or die();

$data = $displayData;
$offcanvs_position = $displayData->params->get('offcanvas_position', 'right');

$feature_folder_path     = JPATH_THEMES . '/' . $data->template->template . '/features/';

include_once $feature_folder_path.'logo.php';
include_once $feature_folder_path.'social.php';
include_once $feature_folder_path.'contact.php';
include_once $feature_folder_path.'menu.php';

$output  = '';

$output .= '<div id="sp-top-bar">';
$output .= '<div class="container">';
$output .= '<div class="container-inner">';
$output .= '<div class="row">';

$classLogo = 'col-4 col-lg-3';
$classTop1 = 'col-4 col-lg-4';
$classTop2 = 'col-2 col-lg-3';
$classTop3 = 'col-2 col-lg-2';


$output .= '<div id="sp-logo" class="'. $classLogo .'">';
$output .= '<div class="sp-column">';
$logo    = new HelixUltimateFeatureLogo($data->params);
if(isset($logo->load_pos) && $logo->load_pos == 'before')
{
    $output .= $logo->renderFeature();
    $output .= '<jdoc:include type="modules" name="logo" style="sp_xhtml" />';
}
else
{
    $output .= '<jdoc:include type="modules" name="logo" style="sp_xhtml" />';
    $output .= $logo->renderFeature();
}
$output .= '</div>';
$output .= '</div>';


$output .= '<div id="sp-top1" class="'. $classTop1 .'">';
$output .= '<div class="sp-column text-center text-lg-left">';

$output .= '<jdoc:include type="modules" name="top1" style="sp_xhtml" />';

$output .= '</div>';
$output .= '</div>';

$output .= '<div id="sp-top2" class="'. $classTop2 .'">';
$output .= '<div class="sp-column text-center">';
$contact = new HelixUltimateFeatureContact($data->params);
if(isset($contact->load_pos) && $contact->load_pos == 'before')
{
    $output .= $contact->renderFeature();
    $output .= '<jdoc:include type="modules" name="top2" style="sp_xhtml" />';
}
else
{
    $output .= '<jdoc:include type="modules" name="top2" style="sp_xhtml" />';
    $output .= $contact->renderFeature();
}
$output .= '</div>';
$output .= '</div>';

$output .= '<div id="sp-top3" class="'. $classTop3 .'">';
$output .= '<div class="sp-column text-center text-lg-right">';
$output .= '<jdoc:include type="modules" name="top3" style="sp_xhtml" />';
$output .= '</div>';
$output .= '</div>';

$output .= '</div>';
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';

//$output .= '<div class="nav-placeholder" style="height: inherit;"></div>';

$output .= '<header id="sp-header">';
$output .= '<div class="container">';
$output .= '<div class="container-inner">';
$output .= '<div class="row">';

$classMenuLeft = 'col-6 col-lg-2';
$classMenu = 'col-lg-8 d-none d-sm-none d-md-none d-lg-block';
$classMenuRight = 'col-6 col-lg-2';

$output .= '<div id="sp-menu-left" class="'. $classMenuLeft .'">';
$output .= '<div class="sp-column">';
$output .= '<jdoc:include type="modules" name="menu-left" style="sp_xhtml" />';
$output .= '</div>';
$output .= '</div>';

$output .= '<div id="sp-menu" class="'. $classMenu .'">';
$output .= '<div class="sp-column">';
$menu    = new HelixUltimateFeatureMenu($data->params);
//if(isset($menu->load_pos)&& $menu->load_pos == 'before') {}
$output .= $menu->renderFeature();
$output .= '<jdoc:include type="modules" name="menu" style="sp_xhtml" />';
$output .= '</div>';
$output .= '</div>';

$output .= '<div id="sp-menu-right" class="'. $classMenuRight .'">';
$output .= '<div class="sp-column text-center text-lg-righ">';
$output .= '<jdoc:include type="modules" name="menu-right" style="sp_xhtml" />';
$output .= '</div>';
$output .= '</div>';

$output .= '</div>';
$output .= '</div>';
$output .= '</div>';
$output .= '</header>';

echo $output;