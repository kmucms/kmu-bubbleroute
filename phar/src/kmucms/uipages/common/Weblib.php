<?php

namespace kmucms\uipages\common;

/**
 * handle js and css library links
 */
class Weblib{

  private $js     = array();
  private $css    = array();
  private $prefix = ''; // 'http://your.awesomewebsite.com/';

  public function addJs(string $javascriptFile){
    $this->js[] = $javascriptFile;
  }

  public function addJsArray(array $javascriptFiles){
    $this->js = array_merge($this->js, $javascriptFiles);
  }

  public function addCss(string $cssFile){
    $this->css[] = $cssFile;
  }

  public function addCssArray(array $cssFiles){
    $this->css = array_merge($this->css, $cssFiles);
  }

  public function getJs(): array{
    return array_unique($this->js);
  }

  public function getCss(): array{
    return array_unique($this->css);
  }

  public function getJsHtml(): string{
    $js     = array_unique($this->js);
    $result = "";
    foreach($js as $v){
      $result .= '<script src="' . htmlentities($v) . '" '
        . 'type="text/javascript"'
        . '></script>';
    }
    return $result;
  }

  public function getCssHtml(): string{
    $css    = array_unique($this->css);
    $result = "";
    foreach($css as $v){
      $result .= '<link rel="stylesheet" type="text/css" href="' . htmlentities($v) . '">';
    }
    return $result;
  }

  public function setPrefix(string $prefix){
    $this->prefix = $prefix;
  }

  private function addPrefix(string $path): string{
    if($this->prefix != '' && substr($path, 0, 4) != 'http'){
      return $this->prefix . '/' . $path;
    }
    return $path;
  }

  // <editor-fold defaultstate="collapsed" desc="transform path to tag">
  public function pathToJsHtmlTag(string $path): string{
    return '<script src="' . htmlentities($path) . '" '
      . 'type="text/javascript"'
      . '></script>';
  }

  public function pathArrToJsHtmlTag(array $pathArr): string{
    $res = '';
    foreach($pathArr as $v){
      $res .= $this->getJsHtmlTag($v);
    }
    return $res;
  }

  public function pathToCssHtmlTag(string $path): string{
    return '<link rel="stylesheet" type="text/css" href="' . htmlentities($path) . '">';
  }

  public function pathArrtoCssHtmlTag(array $pathArr): string{
    $res = '';
    foreach($pathArr as $v){
      $res .= $this->getCssHtmlTag($v);
    }
    return $res;
  }

  // </editor-fold>
  // <editor-fold defaultstate="collapsed" desc="singleton stuff">
  static private $instance = null;

  /**
   *
   * @return static
   */
  static public function getInstance(){
    if(null === self::$instance){
      self::$instance = new self;
    }
    return self::$instance;
  }

  private function __construct(){
    
  }

  private function __clone(){
    
  }

  // </editor-fold>
}
