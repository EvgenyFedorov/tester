<?php


Class SearchContent{

    public $domainName    = null;
    public $url           = null;
    public $content       = null;
    public $protocol      = null;
    public $links         = null;
    public $listLinksInt  = "";
    public $listLinksExt  = "";

    public function getDomainName(){

        // Присваиваем протокол http или https
        $this->protocol = self::returnHttpsOrHttp($this->url);

        // Тут вызываем статический метод поиска домена в ссылке, в аргументе передаем ссылку
        // В ссылке предварительно реплейсим www и http/https
        return self::getLinkDomain(
            self::replaceWww($this->url),
            $this->protocol
        );

    }
    public function getContent(){

        // Загружаем и присваиваем контент
        $this->content = self::loadContent($this->url);

        // Загружаем из контента все ссылки
        return self::getAllLinks($this->content);

    }
    public function getCountLinksInt($links, $domain){

        $countLinks = 0;

        // Считаем внутренние ссылки
        for($i=0; $i <= (count($links) - 1); $i++){

            // Ищем в ссылке домен, а возвращаемый результат плюсуем к уже имеющемуся
            $countLinks = ($countLinks + self::sumLinksInContent($links[$i], $domain, 1, 0));

            // Записываем список внутренних ссылок
            $link = self::listLinksInContent($links[$i], $domain, $links[$i], "");

            if($link){

                $link = "<a href='".$link."'>".substr($link, 0, 25)."...</a><br/>";
                $this->listLinksInt .= $link;

            }

        }

        return $countLinks;

    }
    public function getCountLinksExt($links, $domain){

        $countLinks = 0;

        // Считаем внешние ссылки
        for($i=0; $i <= (count($links) - 1); $i++){

            // Ищем в ссылке домен, а возвращаемый результат плюсуем к уже имеющемуся
            $countLinks = ($countLinks + self::sumLinksInContent($links[$i], $domain, 0, 1));

            // Записываем список внешних ссылок
            $link = self::listLinksInContent($links[$i], $domain, "", $links[$i]);

            if($link != ""){

                $link = "<a href='".$link."'>".substr($link, 0, 25)."...</a><br/>";
                $this->listLinksExt .= $link;

            }

        }

        return $countLinks;

    }
    public static function listLinksInContent($link, $domain, $ifTrue, $ifFalse){

        // Если в ссылке есть домен, то возвращаем 1, если нет то 0
        // (в зависимости какие ссылки ищем внутренние или внешние)
        return (strpos($link, $domain)) ? $ifTrue : self::listLinksRelative($link, $ifTrue, $ifFalse);

    }
    public static function sumLinksInContent($link, $domain, $ifTrue, $ifFalse){

        // Если в ссылке есть домен, то возвращаем 1, если нет то 0
        // (в зависимости какие ссылки ищем внутренние или внешние)
        return (strpos($link, $domain)) ? $ifTrue : self::sumLinksRelative($link, $ifTrue, $ifFalse);

    }
    public static function listLinksRelative($link, $ifTrue, $ifFalse){

        // Проверяем на возможность относительной ссылки, есди находим то возвращаем 1, если нет то 0
        //(в зависимости какие ссылки ище внутренние или внешние) ifTrue возвращается если ссылка относительны
        return (strpos($link, "ttp://") || strpos($link, "ttps://")) ? $ifFalse : $ifTrue;

    }
    public static function sumLinksRelative($link, $ifTrue, $ifFalse){

        // Проверяем на возможность относительной ссылки, есди находим то возвращаем 1, если нет то 0
        //(в зависимости какие ссылки ище внутренние или внешние) ifTrue возвращается если ссылка относительны
        return (strpos($link, "ttp://") || strpos($link, "ttps://")) ? $ifFalse : $ifTrue;

    }
    public static function getLinkDomain($url, $protocol){

        // Получаем домен из url ссылки и возвращаем результат
        $pattern = '/(?<='.$protocol.':\/\/)[a-zA-Zа-яёА-ЯЁ0-9\?\&\#\/\[\]\=\.\,\_\-\:\s\n\r\t]{1,500}?(?=\/)/';
        preg_match($pattern, $url, $result);

        return ($result) ? $result['0'] : false;

    }
    public static function getAllLinks($content){

        // Получаем список всех имеющихся ссылок и возвращаем результат
        $pattern = '/(?<=href=[\"|\'])[a-zA-Zа-яёА-ЯЁ0-9\?\&\#\/\[\]\=\.\,\_\-\:\s\n\r\t]{1,500}?(?=[\"|\'])/';
        preg_match_all($pattern, $content, $result);

        return ($result['0']) ? $result['0'] : false;

    }
    public static function getTitlePage($content){

        // Получаем title запращиваемой страницы
        $pattern = "/<title>(.*)<\/title>/";
        preg_match($pattern, $content, $result);

        return ($result['1']) ? $result['1'] : false;

    }
    public static function loadContent($url){

        // Загружаем html-код страницы, аргументо принимаем и передаем ссылку
        return file_get_contents($url);

    }
    public static function returnHttpsOrHttp($url){

        // Проверяем какой протокол в ссылке и возвращаем результат
        return (strpos($url, 'https') !== false) ? 'https' : 'http';

    }
    public static function replaceHttpsOrHttp($url){

        // Реплейсим протокол в ссылке и возвращаем результат
        return str_replace(self::returnHttpsOrHttp($url)."://", "", $url);

    }
    public static function replaceWww($url){

        // Реплейсим www в ссылке и возвращаем результат
        return str_replace('www.', "", $url);

    }
    public static function replaceOtherContent($content){

        // Реплейсим ненужные ссылки в тексте и возвращаем результат
        return str_replace('javascript://', "", $content);

    }

}