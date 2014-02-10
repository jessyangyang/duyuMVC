<?php
/**
 * Rss Controllers
 *
 * @package     DuyuMvc
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.com/duyuMvc
 */

use \local\rss\BaiduRss;
use \lib\dao\BookControllers;

class RssController extends \Yaf\Controller_Abstract 
{

    public function indexAction($action = false)
    {

    }

    public function initAction()
    {
        $books = new BookControllers();

        $datas = $books->getBooksList(array('status' => BookControllers::BOOK_PUBLISHED_STATE,'p.type'=>1));

        $baidu = new BaiduRss();

        foreach ($datas as $key => $value) {
           $baidu->addLoc('http://' . $_SERVER['HTTP_HOST'] . '/book/' .$value['bid']);
           $baidu->addLastMod(date("Y-m-d",$value['pubtime']));
           // $baidu->addChangefreq();
           // $baidu->addPriority();
           $baidu->addDisplayName($value['title']);
           // $baidu->addDisplayUrl();
           $baidu->addDispalyProvider('http://' . $_SERVER['HTTP_HOST']);
           // $baidu->addDisplayDescription(substr($value['summary'],1,20));
           $baidu->addDisplayArticleBody($value['summary']);
           $baidu->addDisplayKeywords($value['tags']);
           $baidu->addDisplayBreadcrumb($value['category']);
           $baidu->addDisplayImage($value['cover']);
           // $baidu->addDisplayRelatedLink();
           $baidu->addDisplayDatePublished($value['pubtime']);
           $baidu->addDisplayCopyrightHolder('蠹鱼有书','http://' . $_SERVER['HTTP_HOST']);
           $baidu->addDisplayCopyrightYear(date("Y",$value['pubtime']));
           $baidu->addDisplayCategory($value['category']);
           $baidu->addDatasource();
        }
        $baidu->finalize();
        $baidu->save(SITE_PATH);
        // $baidu->printXml();
  
        exit();

    }
}