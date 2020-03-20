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
$output .= '<div class="row align-items-center">';

$classLogo = 'col-6 col-lg-3 order-1 order-md-1';
$classTop1 = 'col-4 col-lg-4 order-2 order-md-2 d-none d-md-flex';
$classTop2 = 'col-3 col-lg-4 order-2 order-md-3';
$classTop3 = 'col-3 col-lg-1 order-4 order-md-4 justify-content-center justify-content-md-end';


$output .= '<div id="sp-logo" class="'. $classLogo .'">';
$output .= '<div class="sp-column d-flex flex-row w-100">';
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
$output .= '<div class="sp-column d-flex flex-row justify-content-end justify-content-md-center w-100">';

$output .= '<jdoc:include type="modules" name="top1" style="sp_xhtml" />';

$output .= '</div>';
$output .= '</div>';

$output .= '<div id="sp-top2" class="'. $classTop2 .'">';
$output .= '<div class="sp-column d-flex flex-row justify-content-end justify-content-md-center">';
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
$output .= '<div class="sp-column d-flex justify-content-center justify-content-md-end">';
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
$output .= '<div class="row align-items-center">';

$classMenuLeft = 'col-6 col-lg-2';
$classMenu = 'col-lg-8 d-none d-sm-none d-md-none d-lg-block';
$classMenuRight = 'col-6 col-lg-2';

$output .= '<div id="sp-menu-left" class="'. $classMenuLeft .'">';
$output .= '<div class="sp-column d-flex flex-row justify-content-lg-start">';
$output .= '<jdoc:include type="modules" name="menu-left" style="sp_xhtml" />';
$output .= '</div>';
$output .= '</div>';

$output .= '<div id="sp-menu" class="'. $classMenu .'">';
$output .= '<div class="sp-column d-flex flex-row justify-content-center">';
$menu    = new HelixUltimateFeatureMenu($data->params);
//if(isset($menu->load_pos)&& $menu->load_pos == 'before') {}
$output .= $menu->renderFeature();
$output .= '<jdoc:include type="modules" name="menu" style="sp_xhtml" />';
$output .= '</div>';
$output .= '</div>';

$output .= '<div id="sp-menu-right" class="'. $classMenuRight .'">';
$output .= '<div class="sp-column d-flex flex-row justify-content-lg-end">';
$output .= '<jdoc:include type="modules" name="menu-right" style="sp_xhtml" />';
$output .= '</div>';
$output .= '</div>';

$output .= '</div>';
$output .= '</div>';
$output .= '</div>';
$output .= '</header>';

echo $output;