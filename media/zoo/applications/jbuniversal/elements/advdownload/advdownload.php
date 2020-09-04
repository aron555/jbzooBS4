<?php
/**
 * @package   com_zoo
 * @author    YOOtheme http://www.yootheme.com
 * @copyright Copyright (C) YOOtheme GmbH
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
 */

// register ElementFile class
App::getInstance('zoo')->loader->register('ElementFile', 'elements:file/file.php');

/*
	Class: ElementDownload
		The file download element class
*/

class ElementAdvDownload extends ElementFile implements iSubmittable
{

    /*
       Function: Constructor
    */
    public function __construct()
    {

        // call parent constructor
        parent::__construct();

        // set callbacks
        $this->registerCallback('download');

        if ($this->app->system->application->isAdmin()) {
            $this->registerCallback('reset');
            $this->registerCallback('files');
        }
    }

    public function getSearchData()
    {
        $hits = $this->get('hits', 0);
        return $hits;
    }

    /*
        Function: getSize
            Gets the download file size.

        Returns:
            String - Download file with KB/MB suffix
    */
    public function getSize()
    {
        return $this->app->filesystem->formatFilesize($this->get('size', 0));
    }

    /*
        Function: getSize
            Gets the download file size.

        Returns:
            String - Download file with KB/MB suffix
    */
    public function isDownloadLimitReached()
    {
        return ($limit = $this->get('download_limit')) && $this->get('hits', 0) >= $limit;
    }

    /*
        Function: getLink
            Gets the link to the download.

        Returns:
            String - link
    */
    public function getLink($file)
    {

        // init vars
        $download_mode = $this->config->get('download_mode');

        // create download link
        $query = array('task' => 'callelement', 'format' => 'raw', 'item_id' => $this->_item->id, 'element' => $this->identifier, 'method' => 'download', 'file' => $file);

        if ($download_mode == 1) {
            return $this->app->link($query);
        } else if ($download_mode == 2) {
            $query['args[0]'] = $this->filecheck();
            return $this->app->link($query);
        } else {
            return $this->get('file');
        }

    }

    /*
        Function: render
            Renders the element.

       Parameters:
               $params - render parameter

        Returns:
            String - html
    */
    public function render($params = array())
    {

        // init vars
        $params = $this->app->data->create($params);
        $files = explode(',', $this->get('files'));

        if ($layout = $this->getLayout()) {
            foreach ($files as $file) {
                $desc = 'description_' . str_replace(array('/', '.'), '_', $file);
                $filename = $this->get($desc) ? $this->get($desc) : basename($file);

                //$html .= '<div class="description">' . $this->get($desc) . '</div>';
                $html .= '<div class="mb-2 adv-description">';
                $html .= $this->renderLayout($layout,
                        array(
                            'file' => $file,
                            'filename' => $filename,
                            'size' => $this->getSize(),
                            'hits' => (int)$this->get('hits', 0),
                            'download_name' => $this->app->string->str_ireplace('{filename}', $filename, $params->get('download_name', '')),
                            'download_link' => $this->getLink($file),
                            'filetype' => $this->getExtension(),
                            'display' => $params->get('display', null),
                            'limit_reached' => $this->isDownloadLimitReached(),
                            'download_limit' => $this->get('download_limit')
                        )
                    ) . '</div>';
            }
        }
        return $html;
    }

    /*
        Function: download
            Download the file.

        Returns:
            Binary - File data
    */
    public function download($check = '')
    {

        // init vars
        $file = $this->app->request->get('file', 'string');
        $filepath = $this->app->path->path('root:' . $file);
        $download_mode = $this->config->get('download_mode');

        // check access
        if (!$this->canAccess()) {
            header('Content-Type: text/html');
            echo JText::_('Unable to access download') . '!';
            return;
        }

        // check limit
        if ($this->isDownloadLimitReached()) {
            header('Content-Type: text/html');
            echo JText::_('Download limit reached') . '!';
            return;
        }

        // trigger on download event
        $canDownload = true;
        $this->app->event->dispatcher->notify($this->app->event->create($this, 'element:download', array('check' => $check, 'canDownload' => &$canDownload)));

        if ($canDownload) {

            // output file
            if ($download_mode == 1 && is_readable($filepath) && is_file($filepath)) {
                $this->set('hits', $this->get('hits', 0) + 1);
                $this->app->filesystem->output($filepath);
            } else if ($download_mode == 2 && $this->filecheck() == $check && is_readable($filepath) && is_file($filepath)) {
                $this->set('hits', $this->get('hits', 0) + 1);
                $this->app->filesystem->output($filepath);
            } else {
                header('Content-Type: text/html');
                echo JText::_('Invalid file') . '!';
            }

            // save item
            $this->app->table->item->save($this->getItem());

        }

    }

    /*
       Function: filecheck
           Get the file check string.

       Returns:
           String - md5(file + secret + date)
    */
    public function filecheck()
    {
        return $this->app->system->getHash($this->get('file') . date('Y-m-d'));
    }


    public function hasValue($params = array())
    {
        // init vars
        $files = explode(',', $this->get('files'));
        foreach ($files as $path) {
            $file = $this->app->path->path('root:' . $path);
            if (empty($file) || !is_readable($file) || !is_file($file)) {
                return false;
            }
        }
        return true;
    }

    /*
       Function: edit
           Renders the edit form field.

       Returns:
           String - html
    */
    public function edit()
    {

        // create info
        $info[] = JText::_('Size') . ': ' . $this->getSize();
        $info[] = JText::_('Hits') . ': ' . (int)$this->get('hits', 0);
        $info = ' (' . implode(', ', $info) . ')';

        $files = $this->get('files');
        $filenames = explode(',', $files);
        $descriptions = $this->getDescriptions($filenames);

        if ($layout = $this->getLayout('edit.php')) {
            return $this->renderLayout($layout,
                array(
                    'info' => $info,
                    'descriptions' => $descriptions,
                    'hits' => $this->get('hits', 0)
                )
            );
        }

    }

    public function getDescriptions($filenames)
    {
        $desc = array();
        foreach ($filenames as $name) {
            $path = str_replace(array('/', '.'), '_', $name);
            $val = $this->get("description_$path");
            if ($val) {
                $desc[$name] = $this->get("description_$path");
            }
        }
        return $desc;
    }

    /*
        Function: loadAssets
            Load elements css/js assets.

        Returns:
            Void
    */
    public function loadAssets()
    {
        parent::loadAssets();
        $this->app->document->addScript('elements:advdownload/assets/js/download.js');
        $this->app->document->addScript('elements:advdownload/assets/js/folders.js');
    }

    public function reset()
    {

        $this->set('hits', 0);

        //save item
        $this->app->table->item->save($this->getItem());

        return $this->edit();
    }

    /*
        Function: bindData
            Set data through data array.

        Parameters:
            $data - array

        Returns:
            Void
    */
    public function bindData($data = array())
    {
        parent::bindData($data);

        // add size to data
        $this->_updateFileSize();
    }

    /*
        Function: renderSubmission
            Renders the element in submission.

       Parameters:
            $params - AppData submission parameters

        Returns:
            String - html
    */
    public function renderSubmission($params = array())
    {

        // get params
        $trusted_mode = $params->get('trusted_mode');

        // init vars
        $upload = $this->get('file');

        if (empty($upload) && $trusted_mode) {
            $upload = $this->get('upload');
        }

        // is uploaded file
        $upload = is_array($upload) ? '' : $upload;

        // build upload select
        $lists = array();
        if ($trusted_mode) {
            $options = array($this->app->html->_('select.option', '', '- ' . JText::_('Select File') . ' -'));
            if (!empty($upload) && !$this->_inUploadPath($upload)) {
                $options[] = $this->app->html->_('select.option', $upload, '- ' . JText::_('No Change') . ' -');
            }
            foreach ($this->app->path->files('root:' . $this->_getUploadPath()) as $file) {
                $options[] = $this->app->html->_('select.option', $this->_getUploadPath() . '/' . $file, basename($file));
            }
            $lists['upload_select'] = $this->app->html->_('select.genericlist', $options, $this->getControlName('upload'), 'class="upload"', 'value', 'text', $upload);
        }

        if (!empty($upload)) {
            $upload = basename($upload);
        }

        if ($layout = $this->getLayout('submission.php')) {
            return $this->renderLayout($layout,
                compact('lists', 'upload', 'trusted_mode')
            );
        }

    }

    /*
        Function: validateSubmission
            Validates the submitted element

       Parameters:
            $value  - AppData value
            $params - AppData submission parameters

        Returns:
            Array - cleaned value
    */
    public function validateSubmission($value, $params)
    {

        // init vars
        $trusted_mode = $params->get('trusted_mode');

        // get old file value
        $old_file = $this->get('file');

        $file = '';
        // get file from select list
        if ($trusted_mode && $file = $value->get('upload')) {

            if (!$this->_inUploadPath($file) && $file != $old_file) {
                throw new AppValidatorException(sprintf('This file is not located in the upload directory.'));
            }

            if (!JFile::exists($file)) {
                throw new AppValidatorException(sprintf('This file does not exist.'));
            }

            // get file from upload
        } else {

            try {

                // get the uploaded file information
                $userfile = $value->get('userfile', null);

                // get legal extensions
                $extensions = array_map(create_function('$ext', 'return strtolower(trim($ext));'), explode(',', $this->config->get('upload_extensions', 'png,jpg,doc,mp3,mov,avi,mpg,zip,rar,gz')));

                //get legal mime types
                $mime_types = $this->app->data->create(array_intersect_key($this->app->filesystem->getMimeMapping(), array_flip($extensions)))->flattenRecursive();

                // get max upload size
                $max_size = $this->config->get('max_upload_size', '512') * 1024;
                $max_size = empty($max_size) ? null : $max_size;

                // validate
                $file = $this->app->validator
                    ->create('file', compact('mime_types', 'max_size'))
                    ->addMessage('mime_types', 'Uploaded file is not of a permitted type.')
                    ->clean($userfile);

            } catch (AppValidatorException $e) {

                if ($e->getCode() != UPLOAD_ERR_NO_FILE) {
                    throw $e;
                }

                if (!$trusted_mode && $old_file && $value->get('upload')) {
                    $file = $old_file;
                }

            }

        }

        if ($params->get('required') && empty($file)) {
            throw new AppValidatorException('Please select a file to upload.');
        }

        $download_limit = (string)$this->app->validator
            ->create('integer', array('required' => false), array('number' => 'The Download Limit needs to be a number.'))
            ->clean($value->get('download_limit'));

        // connect to submission beforesave event
        $this->app->event->dispatcher->connect('submission:beforesave', array($this, 'submissionBeforeSave'));

        return compact('file', 'download_limit');
    }

    /*
        Function: submissionBeforeSave
            Callback before item submission is saved

        Returns:
            void
    */
    public function submissionBeforeSave()
    {

        // get the uploaded file information
        if (($userfile = $this->get('file')) && is_array($userfile)) {
            // get file name
            $ext = $this->app->filesystem->getExtension($userfile['name']);
            $base_path = JPATH_ROOT . '/' . $this->_getUploadPath() . '/';
            $file = $base_path . $userfile['name'];
            $filename = basename($file, '.' . $ext);

            $i = 1;
            while (JFile::exists($file)) {
                $file = $base_path . $filename . '-' . $i++ . '.' . $ext;
            }

            if (!JFile::upload($userfile['tmp_name'], $file)) {
                throw new AppException('Unable to upload file.');
            }

            $this->app->zoo->putIndexFile(dirname($file));

            $this->set('file', $this->app->path->relative($file));
            $this->_updateFileSize();
        }
    }

    protected function _inUploadPath($file)
    {
        return $this->_getUploadPath() == dirname($file);
    }

    protected function _getUploadPath()
    {
        return trim(trim($this->config->get('upload_directory', 'images/zoo/uploads/')), '\/');
    }

    protected function _updateFileSize()
    {
        if (is_string($this->get('file'))) {
            $filepath = $this->app->path->path('root:' . $this->get('file'));
            if (is_readable($filepath) && is_file($filepath)) {
                $this->set('size', sprintf('%u', filesize($filepath)));
            } else {
                $this->set('size', 0);
            }
        }
    }

}