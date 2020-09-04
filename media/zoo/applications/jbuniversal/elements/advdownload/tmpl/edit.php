<?php
/**
* @package   com_zoo
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

JHtml::_('jquery.framework');
JHtml::_('script', 'system/html5fallback.js', false, true);

$upload_url = $this->app->path->url('elements:advdownload/upload.php');
$upload_directory = trim(trim($this->config->get('upload_directory', 'images/zoo/uploads/')), '\/');
?>

<div id="<?php echo $this->identifier; ?>">

    <div class="row">
		<input type="text" readonly="readonly" name="<?php echo $this->getControlName('files'); ?>" value="<?php echo $this->get('files'); ?>" id="filenames" placeholder="<?php echo JText::_('File'); ?>"/>
    </div>

	<div class="more-options">

		<div class="reset-container">
			<?php echo $info; ?>
			<?php if ($hits) : ?>
				<input name="reset-hits" type="button" class="button" value="<?php echo JText::_('Reset'); ?>"/>
			<?php endif; ?>
			<input name="<?php echo $this->getControlName('hits'); ?>" type="hidden" value="<?php echo $hits; ?>"/>
		</div>

		<div class="trigger">
			<div>
				<div class="advanced button hide"><?php echo JText::_('Hide Options'); ?></div>
				<div class="advanced button"><?php echo JText::_('Show Options'); ?></div>
			</div>
		</div>

		<div class="advanced options">
			<div class="row short download-limit">
				<?php echo $this->app->html->_('control.text', $this->getControlName('download_limit'), $this->get('download_limit'), 'size="6" maxlength="255" title="'.JText::_('Download limit').'" placeholder="'.JText::_('Download Limit').'"'); ?>
			</div>
            <div class="row short descriptions">
                <table id="descriptions">
                <?php
                if(!empty($descriptions)) :
                foreach ($descriptions as $name => $desc) :
                    $path = str_replace(array('/','.'),'_', $name);
                ?>
                    <tr>
                        <td>Имя файла: <span><?php echo $name; ?></span><?php echo $this->app->html->_('control.textarea', $this->getControlName("description_$path"), $desc, 'style="height:60px;width:300px" title="Описание" placeholder="Описание"'); ?></td>
                        <td><button class="remove">удалить</button></td>
                    </tr>
                <?php endforeach; ?>
                <?php endif ?>
                </table>
            </div>
            <div class="row short files">
                <!--  <form id="files" target="<?php /*echo $upload_url; */?>" enctype="multipart/form-data">-->
                <?php echo $this->app->html->_('control.input', 'file', 'fileuploads', null, 'id="fileuploads" multiple style="width:100%"onChange="uploadfiles(this)"'); ?>
                <!--   </form>-->
            </div>
		</div>
	</div>
    <script type="text/javascript">
		jQuery(function($) {
			$('#<?php echo $this->identifier; ?>').ElementDownload( {
				url: "<?php echo $this->app->link(array('controller' => 'item', 'format' => 'raw', 'type' => $this->getType()->id, 'elm_id' => $this->identifier, 'item_id' => $this->getItem()->id), false); ?>"
			});
			$('#<?php echo $this->identifier; ?> input[name="<?php echo $this->getControlName('files'); ?>"]').Folders({
				mode: 'file',
				url: '<?php echo $this->app->link(array('task' => 'callelement', 'format' => 'raw', 'type' => $this->_item->getType()->id, 'item_id' => $this->_item->id, 'elm_id' => $this->identifier, 'method' => 'files'), false); ?>',
				title: '<?php echo JText::_('Files'); ?>',
				msgDelete: '<?php echo JText::_('Delete'); ?>'
			});

            uploadfiles = function(elem) {

               var formData = new FormData(),
                    files = $('#fileuploads')[0].files,
                    url = '<?php echo  $upload_url; ?>';

                for (var i=0; i < files.length; i++) {
                    console.log(files[i]);
                    formData.append('files['+i+']', files[i]);
                    formData.append('path', '<?php echo $upload_directory; ?>') ;
                }

                $.ajax({
                    url : url,
                    type: "POST",
                    data : formData,
                    processData: false,
                    contentType: false,
                    success:function(data, textStatus, jqXHR){
                        response = $.parseJSON(data);
                        if (response['status'] == 'OK') {

                            var value = $('#filenames').val(),
                                newfiles = [],
                                files = response['files'].split(',');

                            for (var i=0; i < files.length; i++) {
                                var file = files[i];
                                if(value.indexOf(file) == -1) {
                                    var name = $('#filenames').attr('name').replace('[files]','[description_'+file.replace(/[.\/]/g,'_')+']');
                                    var html = '<tr><td>Имя файла: <span>' + file +'</span>';

                                    html += '<textarea name="'+ name +'" style="height:60px;width:300px;" title="Описание" placeholder="Описание"></textarea>';
                                    html += '</td><td><button class="remove">удалить</button></td></tr>';
                                    newfiles.push(file);
                                    $('table#descriptions').append(html);
                                }
                            }
                            var text = newfiles.join(',');
                            text = value.length ? value + ','+ text : text;
                            $('#filenames').val(text);
                            $(elem).replaceWith($(elem).clone());

                        } else {
                            alert (response['msg']);
                        }
                    }
                });
            }

            $('table#descriptions').on('click', '.remove', function() {
                var parent = $(this).closest('tr');
                console.log(parent);
                var filename = parent.find('span').text();
                var files = $('#filenames').val().split(',');
                var key = $.inArray(filename, files);
                if(key != -1) {
                    files.splice(key, 1);
                    $('#filenames').val(files.join(','));
                    parent.remove();
                }
            })

		});
    </script>

</div>