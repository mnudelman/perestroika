<?php
/**
 * Используется для загрузки текстовых элементов web - страниц
 * из имени элемента формируется имя php - файла, из  которого извлекается
 * таблица вида [itemName => ['ru'=> ruText, 'en' => enText] ], из этой таблицы
 * формируется map в зависимости от текущего языка [itemName => value]
 * требуемый элемент задаётся массивом [itemName,itemPartName], где
 * itemPartName - id раздела (может отсутствовать)
 */
namespace app\service ;
use yii\helpers\ArrayHelper ;
use Yii ;
class PageItems {
    private static $_pageItemPath ;
    private static $instance = null ;
    private static $_currentItemName = null ;
    private static $_currentItemTab = [] ;
    private function __construct() {
        self::$_pageItemPath = Yii::$app->basePath .'/appData/pageItems' ;

    }
    /*
     * Загрузка таблицы $_currentItemTab из php - файла
     * с именем '$itemName'.php
     */
    private function uploadItemTab($itemName) {
        if (is_null(self::$instance)) {
            self::$instance = new self() ;
        }
        if (empty(self::$_currentItemName) || ! ($itemName === self::$_currentItemName)) {
            self::$_currentItemTab = [] ;
            self::$_currentItemTab = include  self::$_pageItemPath . '/' . $itemName .'.php' ;
            self::$_currentItemName = $itemName ;
        }
    }
    /*
     * метод, связанный с выдачей тектовых элементов в соответствии с
     * текущим языком приложения
     */
    public static function getItemText(array $itemPath) {
        $itemName = $itemPath[0] ;
        self::uploadItemTab($itemName) ;
        $partName = ( isset($itemPath[1]) ) ? $itemPath[1] : false ;
        $lang = self::getLang() ;
        $pageItemTab = self::$_currentItemTab ;
        $sourceTab = (false === $partName) ? $pageItemTab : $pageItemTab[$partName]  ;
        return self::getMap($sourceTab,'text',$lang) ;
    }
    private function getMap($sourceTab,$attrKey,$lang = null) {
        $result = [] ;
        foreach ($sourceTab as $key => $attrValue) {
            if (isset($attrValue[$attrKey])) {
                $val = (is_null($lang)) ? $attrValue[$attrKey] : $attrValue[$attrKey][$lang] ;
                if (!is_null($val)) {
                    $result[$key] = $val ;
                }
            }elseif (!is_null($lang) && isset($attrValue[$lang])) {
                $val = $attrValue[$lang] ;
                if (!is_null($val)) {
                    $result[$key] = $val ;
                }
            }
        }
        return $result ;
    }
    private function getLang() {
        $arr = explode('-',Yii::$app->language) ;
        return $arr[0] ;
    }
    /**
     * получить атрибут из таблицы $_currentItemTab, не связаный с языком,
     * например, url
     */
    public static function getItemAttr($attrKey,array $itemPath,$langFlag = false) {
        $itemName = $itemPath[0] ;
        self::uploadItemTab($itemName) ;
        $partName = ( isset($itemPath[1]) ) ? $itemPath[1] : false ;
        $pageItemTab = self::$_currentItemTab ;
        $sourceTab = (false === $partName) ? $pageItemTab : $pageItemTab[$partName]  ;

        $lang = ($langFlag) ? self::getLang() : null ;

        return self::getMap($sourceTab,$attrKey,$lang) ;
    }
}