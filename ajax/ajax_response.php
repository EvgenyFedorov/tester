<?php


Class AjaxResponse extends SearchContent{

    public $countsLinkInt  = 0;
    public $countsLinkExt  = 0;
    public $countsAllLinks = 0;
    public $siteName       = 0;
    public $titlePage      = 0;

    public function __construct($url){

        $this->url = strtolower($url);

    }
    public function getAllInfo(){

        $this->siteName = self::convertToUTF(
            $this->getDomainName()
        );

        $this->countsLinkInt = $this->getCountLinksInt(
            $this->getContent(),
            $this->siteName
        );

        $this->countsLinkExt = $this->getCountLinksExt(
            $this->getContent(),
            $this->siteName
        );

        $this->countsAllLinks = count($this->getContent());

        $this->titlePage = self::getTitlePage(
            self::loadContent($this->url)
        );

    }
    public function setDomain(){

        $this->domainName = $this->getDomainName();

    }
    public static function convertToUTF($page){

        return $page;

        //return iconv('windows-1251', 'utf-8', $page);

    }

}

?>