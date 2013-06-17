<?php
/**
* BookControllers  Class 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace backend\book;

use \backend\dao\Members;
use \backend\dao\BookMenu;
use \backend\dao\Books;


use \local\models\BookInfo;
use \local\file\Files;
use \local\epub\EPub;
use \local\zip\Zip;
use \local\epub\EPubChapterSplitter;

class BookControllers
{
    const VERSION = 1.0;
    const PATH_FOLDER = '/files/book';

    private $epub;
    private $splitter;
    private $files;
    private $zip;
    private $book;
    private $member;
    private $menu;
    private $bookinfo;

    private $chapterTitle = '';
    private $header = '';
    private $footer = '';

    private $title = '';
    private $identifier = '';
    private $language = 'zh-cn'; 
    private $description = '';
    private $author = '';
    private $publisher = '';
    private $date = '';
    private $sourceURL = '';

    private $cssData = '';

    /**
     * Instance construct
     */
    function __construct() {

        $this->header = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n"
        . "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\"\n"
        . " \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">\n"
        . "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n"
        . "<head>"
        . "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n"
        . "<link rel=\"stylesheet\" type=\"text/css\" href=\"styles.css\" />\n"
        . "<title>" . $this->chapterTitle . "</title>\n"
        . "</head>\n"
        . "<body>\n";
        $this->footer = "</body>\n</html>\n";

        $this->epub = new EPub();
        $this->splitter = new EPubChapterSplitter();
        $this->member = Members::instance();
        $this->book = Books::instance();
        $this->menu = BookMenu::instance();
        $this->bookinfo = BookInfo::instance();

    }

    /**
    * Class destructor
    *
    * @return void
    * @TODO make sure elements in the destructor match the current class elements
    */
    function __destruct() {
        $this->zip = NULL;
        $this->splitter = NULL;
        $this->member = NULL;
        $this->book = NULL;
        $this->menu = NULL;
        $this->bookinfo = NULL;
        $this->title = "";
        $this->author = "";
        $this->publisherName = "";
        $this->publisherURL = "";
        $this->date = 0;
        $this->identifier = "";
        $this->opf_manifest = "";
        $this->opf_spine = "";
        $this->ncx_navmap = "";
        $this->opf = "";
        $this->ncx = "";
        $this->chapterCount = 0;
        $this->subject = "";
        $this->coverage = "";
        $this->relation = "";
        $this->generator = "";
    }

    /**
     * Add MetaData
     *
     * @param $title
     * @param $identifier
     * @param $language
     * @param $description
     * @param $author
     * @param $publisher
     * @param $date
     * @param $sourceURL
     *
     * @return void
     */
    public function addMetaData($title = false,$identifier = false,$language = false,$description = false,$author = false,$publisher = false, $date = false ,$sourceURL = false)
    {
        $this->title = $title ? $title : '';
        $this->identifier = $identifier ? $identifier : '';
        $this->language = $language ? $language : '';
        $this->description = $description ? $description : '';
        $this->author = $author ? $author : '';
        $this->publisher = $publisher ? $publisher : '';
        $this->date = $date ? $date : '';
        $this->sourceURL = $sourceURL ? $sourceURL : '';

        $this->title and $this->epub->setTitle($title);
        $this->identifier and $this->epub->setIdentifier($identifier);
        $this->language and $this->epub->setLanguage($language);
        $this->description and $this->epub->setDescription($description);
        $this->author and $this->epub->setAuthor($author,$author);
        $this->publisher and $this->epub->setPublisher($publisher,false);
        $this->date and $this->epub->setDate($date);
        $this->sourceURL and $this->epub->setSourceURL($sourceURL);
    }

    /**
     * Add Guide to EPub
     *
     * @param Array $option , $option[href],$option[type],$option[title]
     * @return void
     */
    public function addGuide($option = array())
    {
        $this->epub->addGuide($option);
    }

    /**
     * Add Chapter to EPub 
     *
     * @param string $chapter_title
     * @param string $html_name , allow include folderPath and fileName , "content/chapter1.html"
     * @param string or array $content,if book have subChapter,allow $content set array. $content
     */
    public function addChapter($chapterTitle,$htmlName,$content,$autoSplit = FALSE, $externalReferences = EPub::EXTERNAL_REF_IGNORE, $baseDir = "")
    {
        $this->epub->addChapter($chapterTitle, $htmlName, $content,$autoSplit,$externalReferences,$baseDir);
    }

    /**
     * 
     */
    public function saveBook($bid = false)
    {
        if (!$bid) return false;

        $books = $this->book->getBookInfo($bid);
        $menus = $this->menu->getMenuAndContentList($bid);

        if (!$books or !$menus) return false;
        $this->addMetaData($books['title'],'urn:uuid:'.$books['isbn'] ? $books['isbn'] : md5($books['bid']),'zh-CN',$books['summary'],$books['author'],'蠹鱼有书',$books['pubtime'],'http://www.duyu.cc');

        foreach ($menus as $key => $value) {
            switch ($value['type']) {
                case 1:
                    $title = 'chapter' . ($key + 1);
                    break;
                case 2:
                    break;
                    $title = 'cover';
                case 3:
                    break;
                    $title = 'title-page';
                default:
                    $title = 'chapter' . ($key + 1);
                    break;
            }
            $this->chapterTitle = $value['title'];
            $header = $this->header;
            $this->addChapter($title,'content/'.$title,$header . $value['body'] . $this->footer,false,EPub::EXTERNAL_REF_IGNORE,'/OEBPS/content');
        }

        $this->epub->finalize();
        $this->epub->saveBook($books['bid'] . '-' . md5($books['title']), FILES_PATH . BookControllers::PATH_FOLDER);

        $this->bookinfo->where("bid=$bid")->update(array(
            'download_path' => $books['bid'] . '-' . md5($books['title']) . ".epub"));
        // $zipData = $this->epub->sendBook(md5($books['title']));

    }

    /**
     * Save book
     *
     * @param string $fileName
     * @param string $filePath
     *
     * @return boolean 
     */
    public function sendBook($fileName,$filePath)
    {
        $zipData =  $this->epub->sendBook($fileName,$filePath);
        return $zipData;
    }



    public function setTitle($title)
    {
        $this->epub->setTitle($title);
    }

    public function setIdentifier($identifier)
    {
        $this->epub->setIdentifier($identifier);
    }

    public function setLanguage($language)
    {
        $this->epub->setLanguage($language);
    }

    public function setDescription($description)
    {
        $this->epub->setDescription($description);
    }

    public function setAuthor($author)
    {
        $this->epub->setAuthor($author,$author);
    }

    public function setPublisher($publisher)
    {
        $this->epub->setPublisher($publisher,false);
    }

    public function setDate($date)
    {
        $this->epub->setDate($date);
    }

    public function setSourceURL($sourceURL)
    {
        $this->epub->setSourceURL($sourceURL);
    }
}