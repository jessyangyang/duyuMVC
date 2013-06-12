<?php
/**
 * Test Controllers
 *
 * @package     DuyuMvc
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.com/duyuMvc
 */
use local\EPub;

class TestController extends \Yaf\Controller_Abstract 
{

    public function testAction() 
    {
        $content_start = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n"
            . "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\"\n"
            . "    \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">\n"
            . "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n"
            . "<head>"
            . "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n"
            . "<link rel=\"stylesheet\" type=\"text/css\" href=\"styles.css\" />\n"
            . "<title>Test Book</title>\n"
            . "</head>\n"
            . "<body>\n";

        $bookEnd = "</body>\n</html>\n";

        $tStart = gettimeofday();
        $tLast = $tStart;

        $fileDir = './PHPePub';

        include_once("EPub.php");

        $option = array(
            'opf_path' => 'OEBPS/',
            'ncx_path' => 'OEBPS/');
        $book = new EPub();

        $book->setTitle("Test book");
        $book->setIdentifier("http://JohnJaneDoePublications.com/books/TestBook.html", EPub::IDENTIFIER_URI); // Could also be the ISBN number, prefered for published books, or a UUID.
        $book->setLanguage("cn"); // Not needed, but included for the example, Language is mandatory, but EPub defaults to "en". Use RFC3066 Language codes, such as "en", "da", "fr" etc.
        $book->setDescription("This is a brief description\nA test ePub book as an example of building a book in PHP");
        $book->setAuthor("John Doe Johnson", "Johnson, John Doe"); 
        $book->setPublisher("John and Jane Doe Publications", "http://JohnJaneDoePublications.com/"); // I hope this is a non existant address :) 
        $book->setDate(time()); // Strictly not needed as the book date defaults to time().
        $book->setRights("Copyright and licence information specific for the book."); // As this is generated, this _could_ contain the name or licence information of the user who purchased the book, if needed. If this is used that way, the identifier must also be made unique for the book.
        $book->setSourceURL("http://JohnJaneDoePublications.com/books/TestBook.html");

        $book->setCoverImage("Cover.jpg", file_get_contents("demo/cover-image.jpg"), "image/jpeg");

        $cover = $content_start . "<h1>Test Book</h1>\n<h2>By: John Doe Johnson</h2>\n" . $bookEnd;
        $book->addChapter("Notices", "Cover.html", $cover);

        $chapter1 = $content_start . $bookEnd;

        $book->addChapter("Chapter 1: Lorem ipsum", "Chapter001.html", $chapter1, true, EPub::EXTERNAL_REF_ADD);
        $book->addChapter("Chapter 2: Vivamus bibendum massa", "Chapter002.html", $chapter2);
        $book->addChapter("Chapter 3: Vivamus bibendum massa again", "Chapter003.html", $chapter3);

        // Autosplit a chapter:
        $book->setSplitSize(15000); // For this test, we split at approx 15k. Default is 250000 had we left it alone.
        $book->addChapter("Chapter 4: Vivamus bibendum massa split", "Chapter004.html", $chapter4, true);

        require_once 'EPubChapterSplitter.php';

        $splitter = new EPubChapterSplitter();
        $splitter->setSplitSize(15000); // For this test, we split at approx 15k. Default is 250000 had we left it alone.

        $html2 = $splitter->splitChapter($chapter4, true, "Chapter ");/* '#^<.+?>Chapter \d*#i'); */  

        $idx = 0;
        while (list($k, $v) = each($html2)) {
            $idx++;
            // Because we used a string search in the splitter, the returned hits are put in the key part of the array.
            // The entire HTML tag of the line matching the chapter search.
             
            // find the text inside the tags
            preg_match('#^<(\w+)\ *.*?>(.+)</\ *\1>$#i', $k, $cName);
             
            // because of the back reference, the tag name is in $cName[1], and the content is in $cName[2]
            // Change any line breakes in the chapter name to " - "
            $cName = preg_replace('#<br.+?>#i', " - ", $cName[2]);
            // Remove any other tags
            $cName = preg_replace('#<.+?>#i', " ", $cName);
            // clean the chapter name by removing any double spaces left behind to single space. 
            $cName = preg_replace('#\s+#i', " ", $cName);
            
            $book->addChapter($cName, "Chapter005_" . $idx . ".html", $v, true);
        }

        $book->addChapter("Chapter 7: Local Image test", "Chapter007.html", $chapter2, false, EPub::EXTERNAL_REF_ADD, $fileDir);

        $log .= "\n</pre>" . $bookEnd;
        $book->addChapter("Log", "Log.html", $log);

        $book->finalize();

        $book->saveBook('epub-filename', '.');

        // Send the book to the client. ".epub" will be appended if missing.
        $zipData = $book->sendBook("Example1Book");

        $this->getView()->assign("title", "Hello Wrold");
        exit();
    }


}

?>