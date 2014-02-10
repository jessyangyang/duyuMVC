<?php
/**
 * BaiduRss
 *
 * @package     DuyuMvc
 * @author      Jess
 * @version     1.0
 * @license     http://wiki.duyu.com/duyuMvc
 * 
 */

namespace local\rss;

class BaiduRss
{
    const VERSION = 1.0;
    const TYPE = '.xml';

    const CHANGEFREQ_ALWAYS = 'always';
    const CHANGEFREQ_HOURLY = 'hourly';
    const CHANGEFREQ_DAILY = 'daily';
    const CHANGEFREQ_WEEKLY = 'weekly';
    const CHANGEFREQ_MONTHLY = 'monthly';
    const CHANGEFREQ_YEARLY = 'yearly';
    const CHANGEFREQ_NEVER = 'never';

    const DISPLAY_HEADER = '<![CDATA[';
    const DISPLAY_FOOTER = ']]>';

    private $_fileName;
    private $_doc;
    private $_dataSource = array();

    private $_xmlLoc;
    private $_xmlLastMod;
    private $_xmlChangefreq;
    private $_xmlPriority;
    private $_xmlDisplayName;
    private $_xmlDisplayUrl;
    private $_xmlDisplayProvider;
    private $_xmlDisplayDescriptionl;
    private $_xmlDisplayArticleBody;
    private $_xmlDisplayKeywords;
    private $_xmlDisplayBreadcrumb;
    private $_xmlDisplayImage;
    private $_xmlDisplayVideo;
    private $_xmlDisplayRelatedLink;
    private $_xmlDisplayDatePublished;
    private $_xmlDisplayCopyrightHolderSiteName;
    private $_xmlDisplayCopyrightHolderSiteUrl;
    private $_xmlDisplayCopyrightYear;
    private $_xmlDisplayCategory;

    private $_element_urlset;

    /**
     * [__construct description]
     */
    public function __construct($fileName = 'baiduRss') 
    {
        $this->_fileName = $fileName;
        $this->_xmlLoc = '';
        $this->_xmlLastMod = '1970-01-01';
        $this->_xmlChangefreq = self::CHANGEFREQ_ALWAYS;
        $this->_xmlPriority = '1.0';
        $this->_xmlDisplayName = '';
        $this->_xmlDisplayUrl = '';
        $this->_xmlDisplayProvider = '';
        $this->_xmlDisplayDescriptionl = '';
        $this->_xmlDisplayArticleBody = '';
        $this->_xmlDisplayKeywords = '';
        $this->_xmlDisplayBreadcrumb = '';
        $this->_xmlDisplayImage = '';
        $this->_xmlDisplayVideo = '';
        $this->_xmlDisplayRelatedLink = '';
        $this->_xmlDisplayDatePublished = '';
        $this->_xmlDisplayCopyrightHolderSiteName = '';
        $this->_xmlDisplayCopyrightHolderSiteUrl = '';
        $this->_xmlDisplayCopyrightYear = '';
        $this->_xmlDisplayCategory = '';

        $this->_doc = new \DOMDocument('1.0', 'utf-8');
        $this->_doc->formatOutput = true;

        $this->_element_urlset = $this->_doc->createElement("urlset");
        $this->_doc->appendChild( $this->_element_urlset);

        $this->_dataSource = array();
    }

    public function __destruct()
    {
        $this->_doc = NULL;
    }

    public function addLoc($data)
    {
        $this->_xmlLoc = $data;
    }

    public function addLastMod($data)
    {
        $this->_xmlLastMod = $data;
    }

    public function addChangefreq($data)
    {
        $this->_xmlChangefreq = $data;
    }

    public function addPriority($data)
    {
        $this->_xmlPriority = $data;
    }

    public function addDisplayName($data)
    {
        $this->_xmlDisplayName = $data;
    }

    public function addDisplayUrl($data)
    {
        $this->_xmlDisplayUrl = $data;
    }

    public function addDispalyProvider($data)
    {
        $this->_xmlDisplayProvider = $data;
    }

    public function addDisplayDescription($data)
    {
        $this->_xmlDisplayDescriptionl = $data;
    }

    public function addDisplayArticleBody($data)
    {
        $this->_xmlDisplayArticleBody = $data;
    }

    public function addDisplayKeywords($data)
    {
        $this->_xmlDisplayKeywords = $data;
    }

    public function addDisplayBreadcrumb($data)
    {
        $this->_xmlDisplayBreadcrumb = $data;
    }

    public function addDisplayImage($data)
    {
        $this->_xmlDisplayImage = $data;
    }

    public function addDisplayVideo($data)
    {
        $this->_xmlDisplayVideo = $data;
    }

    public function addDisplayRelatedLink($data)
    {
        $this->_xmlDisplayRelatedLink = $data;
    }

    public function addDisplayDatePublished($data)
    {
        $this->_xmlDisplayDatePublished = $data;
    }

    public function addDisplayCopyrightHolder($siteName = '',$siteUrl = '')
    {
        $this->_xmlDisplayCopyrightHolderSiteName = $siteName;
        $this->_xmlDisplayCopyrightHolderSiteUrl = $siteUrl;
    }

    public function addDisplayCopyrightYear($data)
    {
        $this->_xmlDisplayCopyrightYear = $data;
    }

    public function addDisplayCategory($data)
    {
        $this->_xmlDisplayCategory = $data;
    }

    public function addDatasource()
    {
        $this->_dataSource[] = array(
            'loc' => $this->_xmlLoc,
            'lastmod' => $this->_xmlLastMod,
            'changefreq' => $this->_xmlChangefreq,
            'priority' => $this->_xmlPriority,
            'name' => self::DISPLAY_HEADER . $this->_xmlDisplayName . self::DISPLAY_FOOTER,
            'url' => $this->_xmlDisplayUrl,
            'provider' => self::DISPLAY_HEADER . $this->_xmlDisplayProvider . self::DISPLAY_FOOTER,
            'description' => self::DISPLAY_HEADER . $this->_xmlDisplayDescriptionl . self::DISPLAY_FOOTER,
            'articleBody' => self::DISPLAY_HEADER . $this->_xmlDisplayArticleBody . self::DISPLAY_FOOTER,
            'keywords' => self::DISPLAY_HEADER . $this->_xmlDisplayKeywords . self::DISPLAY_FOOTER,
            'breadcrumb' => self::DISPLAY_HEADER . $this->_xmlDisplayBreadcrumb . self::DISPLAY_FOOTER,
            'image' => $this->_xmlDisplayImage,
            'video' => $this->_xmlDisplayVideo,
            'relatedLink' => $this->_xmlDisplayRelatedLink,
            'datePublished' => $this->_xmlDisplayDatePublished,
            'siteName' => self::DISPLAY_HEADER . $this->_xmlDisplayCopyrightHolderSiteName . self::DISPLAY_FOOTER,
            'siteUrl' => $this->_xmlDisplayCopyrightHolderSiteUrl,
            'copyrightYear' => $this->_xmlDisplayCopyrightYear,
            'category' => self::DISPLAY_HEADER . $this->_xmlDisplayCategory . self::DISPLAY_FOOTER
        );
    }

    public function finalize()
    {
        if (!$this->_dataSource) return;
        foreach ($this->_dataSource as $key => $value) {
            $element_url = $this->_doc->createElement( "url");
            $this->_element_urlset->appendChild($element_url);

            $element_loc = $this->_doc->createElement('loc');
            $element_loc->appendChild($this->_doc->createTextNode($value['loc']));
            $element_url->appendChild( $element_loc );

            $element_lastmod = $this->_doc->createElement('lastmod');
            $element_lastmod->appendChild($this->_doc->createTextNode($value['lastmod']));
            $element_url->appendChild( $element_lastmod );

            $element_changefreq = $this->_doc->createElement('changefreq');
            $element_changefreq->appendChild($this->_doc->createTextNode($value['changefreq']));
            $element_url->appendChild( $element_changefreq );

            $element_priority = $this->_doc->createElement('priority');
            $element_priority->appendChild($this->_doc->createTextNode($value['priority']));
            $element_url->appendChild( $element_priority );

            $element_data = $this->_doc->createElement('data');
            $element_url->appendChild($element_data);

            $element_display = $this->_doc->createElement('display');
            $element_data->appendChild($element_display);

            $element_name = $this->_doc->createElement('name');
            $element_name->appendChild($this->_doc->createTextNode($value['name']));
            $element_display->appendChild($element_name);

            $element_url = $this->_doc->createElement('url');
            $element_url->appendChild($this->_doc->createTextNode($value['url']));
            $element_display->appendChild($element_url);

            $element_provider = $this->_doc->createElement('provider');
            $element_provider->appendChild($this->_doc->createTextNode($value['provider']));
            $element_display->appendChild($element_provider);

            $element_description = $this->_doc->createElement('description');
            $element_description->appendChild($this->_doc->createTextNode($value['description']));
            $element_display->appendChild($element_description);

            $element_articleBody = $this->_doc->createElement('articleBody');
            $element_articleBody->appendChild($this->_doc->createTextNode($value['articleBody']));
            $element_display->appendChild($element_articleBody);

            $element_keywords = $this->_doc->createElement('keywords');
            $element_keywords->appendChild($this->_doc->createTextNode($value['keywords']));
            $element_display->appendChild($element_keywords);

            $element_breadcrumb = $this->_doc->createElement('breadcrumb');
            $element_breadcrumb->appendChild($this->_doc->createTextNode($value['breadcrumb']));
            $element_display->appendChild($element_breadcrumb);

            $element_image = $this->_doc->createElement('image');
            $element_image->appendChild($this->_doc->createTextNode($value['image']));
            $element_display->appendChild($element_image);

            $element_video = $this->_doc->createElement('video');
            $element_video->appendChild($this->_doc->createTextNode($value['video']));
            $element_display->appendChild($element_video);

            $element_relatedLink = $this->_doc->createElement('relatedLink');
            $element_relatedLink->appendChild($this->_doc->createTextNode($value['relatedLink']));
            $element_display->appendChild($element_relatedLink);

            $element_datePublished = $this->_doc->createElement('datePublished');
            $element_datePublished->appendChild($this->_doc->createTextNode($value['datePublished']));
            $element_display->appendChild($element_datePublished);

            $element_copyrightHolder = $this->_doc->createElement('copyrightHolder');
            $element_section = $this->_doc->createElement('section');

            $element_siteName = $this->_doc->createElement('siteName');
            $element_siteName->appendChild($this->_doc->createTextNode($value['siteName']));
            $element_section->appendChild($element_siteName);

            $element_siteUrl = $this->_doc->createElement('siteUrl');
            $element_siteUrl->appendChild($this->_doc->createTextNode($value['siteUrl']));
            $element_section->appendChild($element_siteUrl);

            $element_copyrightHolder->appendChild($element_section);
            $element_display->appendChild($element_copyrightHolder);

            $element_copyrightYear = $this->_doc->createElement('copyrightYear');
            $element_copyrightYear->appendChild($this->_doc->createTextNode($value['copyrightYear']));
            $element_display->appendChild($element_copyrightYear);

            $element_category = $this->_doc->createElement('category');
            $element_category->appendChild($this->_doc->createTextNode($value['category']));
            $element_display->appendChild($element_category);

        }
    }

    public function save($path)
    {
        $tmpPath = $path.'/'.$this->_fileName.self::TYPE;
        header("Content-type: text/xml; charset=utf-8"); 
        $this->_doc->save($tmpPath);
    }

    public function printXml()
    {

        echo $this->_doc->saveXML();
    }

}