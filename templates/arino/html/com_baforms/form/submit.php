<?php
/**
* @package   BaForms
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

ob_start();
?>
<div class="row">
	<div class="col text-center"">
		<input class="ba-btn-submit btn btn-primary" type="submit""
			value="<?php echo $button; ?>" <?php echo $embed; ?>>
    </div>
</div>
<?php
$out = ob_get_contents();
ob_end_clean();