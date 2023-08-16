<?php

namespace kmucms\weblib;

/**
 * handle js and css library links
 */
class CssLib extends AWebLib{

  public function getHtml(): string{
    $css    = array_unique($this->paths);
    $result = "";
    foreach($css as $v){
      $result .= '<link rel="stylesheet" type="text/css" href="' . htmlentities($v) . '">';
    }
    $result .= "<style>$this->inline</style>";
    return $result;
  }

  public function pathToHtmlTag(string $path): string{
    return '<link rel="stylesheet" type="text/css" href="' . htmlentities($path) . '">';
  }

  // <editor-fold defaultstate="collapsed" desc="singleton stuff">
  static private $instance = null;

  /**
   *
   * @return static
   */
  static public function getInstance(): self{
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
