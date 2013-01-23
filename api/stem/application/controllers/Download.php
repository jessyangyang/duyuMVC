<?php
/**
 * Download Controllers
 *
 * @package     DuyuMvc
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.com/duyuMvc
 */

use \local\download\Download;

class DownloadController extends \Yaf\Controller_Abstract 
{

    public function bookAction($bid = 1) 
    {
        $head = array(
            'Content-type: application/epub+zip',
            "Content-disposition:attachment;filename='". time() .".epub'",
            'Content-Transfer-Encoding: binary');

        $path = BASE_PATH."/files/book/guidang.epub";

        // print_r($path);

        Download::download($path,$head);
    }

}

?>