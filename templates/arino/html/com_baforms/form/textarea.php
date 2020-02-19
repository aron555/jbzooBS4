<?php
/**
* @package   BaForms
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

$settings = explode('_-_', $element->settings);
$options = explode(';', $settings[3]);
$attr = '';
if (isset($options[3]) && $options[3] == 1) {
    $options[0] .= ' *';
    $attr = ' required';
}
if (!empty($element->options)) {
    $itemOptions = json_decode($element->options);
} else {
    $itemOptions = new stdClass();
}
if (isset($itemOptions->max) && !empty($itemOptions->max)) {
    $attr .= ' maxlength="'.$itemOptions->max.'"';
}
ob_start();
?>
<div class="ba-textarea tool <?php echo $element->custom; ?>">
<?php
if ($options[0] != '' && $options[0] != ' *') { ?>
    <div class="form-group">
    <label for="tm-form-<?php echo $element->id; ?>">
    	<span>
    		<?php echo htmlspecialchars($options[0]);
if (!empty($options[1])) { ?>
	        <span class="ba-tooltip">
	        	<?php echo htmlspecialchars($options[1]); ?>
	    	</span>
<?php
}
?>
    	</span>
    </label>
<?php
}
if (isset($options[5]) && strpos($options[5], 'zmdi') !== false) { ?>
    <div class="container-icon">
<?php
} ?>
	<textarea id="tm-form-<?php echo $element->id; ?>" class="sppb-form-control"
		placeholder='<?php echo htmlspecialchars($options[2], ENT_QUOTES); ?>'
        name="<?php echo $element->id; ?>" <?php echo $attr; ?>></textarea>
<?php
if (isset($options[5]) && strpos($options[5], 'zmdi') !== false) { ?>
    <div class="icons-cell">
    	<i style="font-size: <?php echo $formSettings[11]; ?>px; color: <?php echo $formSettings[12]; ?>"
    		class="<?php echo $options[5]; ?>"></i>
	</div>
</div>
<?php
}
?>
<? if ($options[0] != '' && $options[0] != ' *') { ?>
    </div>
<?php } ?>
<?php
if (isset($itemOptions->max) && !empty($itemOptions->max)) {
?>
    <p class="ba-maxlength">0/<?php echo $itemOptions->max; ?></p>
<?php
}
?>
</div>
<?php
$out = ob_get_contents();
ob_end_clean();