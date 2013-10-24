<?php
/**
* BookControllers  Class 
*
* @package     DuyuMvc
* @author      Jess
* @version     1.0
* @license     http://wiki.duyu.com/duyuMvc
*/

namespace lib\dao;

use \lib\models\Members;
use \lib\models\BookMenu;
use \lib\models\Books;
use \lib\dao\ImageControl;

use \lib\models\BookInfo;
use \lib\models\BookRecommend;
use \lib\models\BookRecommendMenu;

use \local\file\Files;
use \local\epub\EPub;
use \local\zip\Zip;
use \local\epub\EPubChapterSplitter;

class BookControllers
{
    const VERSION = 1.0;
    const PATH_FOLDER = '/files/book';

    const BOOK_NONE_STATE = 0;
    const BOOK_WATTING_PUBLISH_STATE = 1;
    const BOOK_PUBLISHING_STATE = 2;
    const BOOK_UNPUBLISHED_STATE = 3;
    const BOOK_PUBLISHED_STATE = 4;
    
    // mobile type in book_recommend_menu table.
    const MOBILE_TYPE = 10;

    private $epub;
    private $splitter;
    private $files;
    private $zip;

    private $book;
    private $bookinfo;
    private $bookRecommend;
    private $bookRecommendMenu;

    private $member;
    private $menu;
    private $images;

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
        $this->images = new ImageControl();
        $this->bookRecommend = BookRecommend::instance();
        $this->bookRecommendMenu = BookRecommendMenu::instance();

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
     * Add Cover to EPub
     *
     * @param  Array
     */
    public function addCover($bid = false)
    {
        if (!$bid) return false;
        $image = $this->images->getImagesForBookid($bid,3);
        if ($image) {
            $this->epub->setCoverImage("Cover.png", file_get_contents(FILES_PATH . '/files' . $image[0]['path']), "image/png");
        }
        return false;
    }

    /**
     * Add Chapter to EPub 
     *
     * @param string $chapter_title
     * @param string $html_name , allow include folderPath and fileName , "content/chapter1.html"
     * @param string or array $content,if book have subChapter,allow $content set array. $content
     */
    public function addChapter($chapterTitle,$htmlName,$content,$autoSplit = FALSE, $externalReferences = EPub::EXTERNAL_REF_REPLACE_IMAGES, $baseDir = "")
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
        // $images = $this->images->getImagesForBookid($bid,4);

        if (!$books or !$menus) return false;
        $this->addMetaData($books['title'],'urn:uuid:'.$books['isbn'] ? $books['isbn'] : md5($books['bid']),'zh-cn',$books['summary'],$books['author'],'蠹鱼有书',$books['pubtime'],'http://www.duyu.cc');

        $this->addCover($bid);

        foreach ($menus as $key => $value) {
            switch ($value['type']) {
                case 1:
                    $title = 'chapter' . $value['sort'];
                    break;
                case 2:
                    break;
                    $title = 'cover';
                case 3:
                    break;
                    $title = 'title-page';
                default:
                    $title = 'chapter' . $value['sort'];
                    break;
            }
            $this->chapterTitle = $value['title'];
            $header = $this->header;

            $this->addChapter($this->chapterTitle,'content/'.$title, $header . "<h1>" . $value['title'] . "</h1>" . $value['body'] . $this->footer,false,EPub::EXTERNAL_REF_ADD,'/OEBPS/content');
        }

        // if($images)
        // {
            // $paths = array();
            // foreach ($images as $key => $value) {
            //     $paths[]= ImageControl::getRelativeImage($value['path']);
            // }
            // $this->epub->addImages($paths);
        // }
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

    /////////////////////////
    // Database Management //
    /////////////////////////
        
    /**
     * Get BookRow Row
     *
     * @param Array , $option
     * @return Array
     */
    public function getBooksRow($option = array())
    {
        if (!is_array($option) or !$option) return false;

        $sql = '';
        $i = 1;
        $count = count($option);
        foreach ($option as $key => $value) {
            if($i == $count) $sql .= "$key='" . $value . "'";
            else $sql .= "$key='" . $value . "' AND ";
            $i ++;
        }

        $table = $this->book->table;

        $list = $this->book->field("$table.bid,$table.cid,bc.name,$table.title,$table.author,i.path as cover,$table.pubtime,$table.isbn,$table.press,f.apple_price as price,$table.summary,f.tags,f.copyright,f.download_path as path,f.designer,f.proofreader,f.wordcount,f.dateline")
            ->joinQuery("book_info as f","$table.bid=f.bid")
            ->joinQuery('book_image as p',"$table.bid=p.bid")
            ->joinQuery('images as i','i.pid=p.pid')
            ->joinQuery('book_fields as bf',"$table.bid=bf.bid")
            ->joinQuery('book_category as bc',"$table.cid=bc.cid")
            ->where($sql)->limit(1)->fetchList();

        if (is_array($list)) {
            if (isset($list[0]['cover']) and $list[0]['cover']) {
                    $list[0]['cover'] = ImageControl::getRelativeImage($list[0]['cover']);
            }
            return $list[0];
        }

        return false;
    }

    /**
     * Get Books List
     *
     * @param Array , $option
     * @param int , $limit
     * @param int , $page
     * @return Array
     */
    public function getBooksList($option = array(),$limit = 10,$page = 1)
    {
        if (!is_array($option) or !$option) return false;

        $sql = '';
        $i = 1;
        $count = count($option);
        foreach ($option as $key => $value) {
            if($i == $count) $sql .= "$key='" . $value . "'";
            else $sql .= "$key='" . $value . "' AND ";
            $i ++;
        }

        $offset = $page == 1 ? 0 : ($page - 1)*$limit; 
        $table = $this->book->table;

        $list = $this->book->field("$table.bid,$table.cid,$table.title,$table.author,i.path as cover,$table.pubtime,$table.isbn,$table.press,f.apple_price as price,$table.summary,f.tags,bi.price,bi.apple_price")
            ->joinQuery("book_info as f","$table.bid=f.bid")
            ->joinQuery('book_image as p',"$table.bid=p.bid")
            ->joinQuery('images as i','i.pid=p.pid')
            ->joinQuery('book_fields as bf',"$table.bid=bf.bid")
            ->joinQuery('book_info as bi',"$table.bid=bi.bid")
            ->where($sql)->order("$table.published")
            ->limit($offset,$limit)->fetchList();

        if (is_array($list)) {
            foreach ($list as $key => $value) {
                if (isset($value['cover']) and $value['cover']) {
                    $list[$key]['cover'] = ImageControl::getRelativeImage($value['cover']);
                }
            }
            return $list;
        }

        return false;
    }
	
    /**
     * Get BookRecommand List 
     * 
     * @param Array, $option
     * @param Int, $limit
     * @param Int, $page
     * @param Int, $type
     * @return Array
     * */
    public function getBookRecommendList($option = array(),$cid = false,$limit = 10,$page = 1)
    {
    	if (!is_array($option) or !$option) return false;
    	
    	$option['br.cid'] = $cid;
    	
    	$sql = '';
    	$i = 1;
    	$count = count($option);
    	foreach ($option as $key => $value) {
    		if($i == $count) $sql .= "$key='" . $value . "'";
    		else $sql .= "$key='" . $value . "' AND ";
    		$i ++;
    	}
    	
    	$offset = $page == 1 ? 0 : ($page - 1)*$limit;
    	$table = $this->book->table;
    	
    	$list = $this->book->field("$table.bid,$table.cid,$table.title,$table.author,i.path as cover,$table.pubtime,$table.isbn,$table.press,f.apple_price as price,$table.summary,f.tags")
	    	->joinQuery("book_info as f","$table.bid=f.bid")
	    	->joinQuery('book_image as p',"$table.bid=p.bid")
	    	->joinQuery('images as i','i.pid=p.pid')
	    	->joinQuery('book_fields as bf',"$table.bid=bf.bid")
	    	->joinQuery('book_recommend as br',"$table.bid=br.bid")
	    	->where($sql)->order("br.sort")
	    	->limit($offset,$limit)->fetchList();
    	
    	if (is_array($list)) {
    		foreach ($list as $key => $value) {
    			if (isset($value['cover']) and $value['cover']) {
    				$list[$key]['cover'] = ImageControl::getRelativeImage($value['cover']);
    			}
    		}
    		return $list;
    	}
 		return false;
    }
    
    /**
     * Get RecommandMenu For Type
     * 
     * @param Int, $type
     * @return Array.
     * */
    public function getRecommendMenuForType($type)
    {
    	return $this->bookRecommendMenu->getRecommendMenuForType($type);
    }

    /**
     * Add Books Table
     *
     * @param Array , fields
     *
     * @return Boolean or Int
     */
    public function addBooks($fields = array())
    {
        if (!is_array($fields) or !$fields) return false;
        return $this->book->insert($fields);
    }

    /**
     * Update Books Table
     *
     * @param Int ,pramary key
     * @param Array , $fields
     * @return Boolean
     */
    public function updateBooks($bid,$fields = array())
    {
        if(!is_array($fields) or isset($fields['bid'])) return false;
        return $this->book->where("bid='$bid'")->update($fields);
    }

    /**
     * Delete Books For Bid
     *
     * @param Int ,$pid
     * @return Boolean
     */
    public function deleteBooksForBid($bid)
    {
        if(!$bid) return false;
        return $this->book->where("bid='$bid'")->delete();
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