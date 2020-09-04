<?php
/**
 * Created by Zhukov Sergey.
 * Email: zom688@gmail.com
 * Website: http://websiteprog.ru
 * Date: 04.11.14, 21:51
 */
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) ||
    empty($_SERVER['HTTP_X_REQUESTED_WITH']) ||
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
    echo json_encode(array('status'=> 'ERR', 'msg'=> 'Доступ запрещен'));
    exit();
}

define('_JEXEC', 1);
define('JPATH_BASE', dirname(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__))))))) );
define('DS', DIRECTORY_SEPARATOR);
require_once(JPATH_BASE.DS.'includes'.DS.'defines.php');
require_once(JPATH_BASE.DS.'includes'.DS.'framework.php');
$app = JFactory::getApplication('site');
$app->initialise();


if (isset($_FILES['files']))
{

    jimport( 'joomla.filesystem.folder' );
    jimport( 'joomla.filesystem.file' );
    $path = $app->input->getString('path','');
    $dir = JPATH_SITE .DS. $path .DS. 'uploads';
    JFolder::create($dir);
    $files = $_FILES['files'];
    $uploads = array();
    foreach ($files['tmp_name'] as $key => $tmpname)
    {

        $sitelang = JComponentHelper::getParams('com_languages')->get('site');
        $lang = JLanguage::getInstance($sitelang);

        $arr = explode('.', $files['name'][$key]);
        $name = $lang->transliterate($arr[0]);
        $ext = $arr[1];
        $filename = $name.'.'.$ext;

        if(strtolower($ext) != 'php' && strtolower($ext) != 'js')
        {
            JFile::copy($tmpname, $dir . DS . $filename);
            $uploads[] = $path . '/uploads/' . $filename;
        }
    }
    if (!empty($uploads))
    {
        echo json_encode(array('status'=> 'OK', 'files'=> implode(',', $uploads)));
    } else {
        echo json_encode(array('status'=> 'ERR', 'msg'=> 'Файлы не прошли проверку'));
    }
} else {
    echo json_encode(array('status'=> 'ERR', 'msg'=> 'Ошибка загрузки файлов'));
}
