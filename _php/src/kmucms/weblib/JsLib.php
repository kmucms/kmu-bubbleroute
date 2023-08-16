<?php

namespace kmucms\weblib;

/**
 * handle js and css library links
 */
class JsLib extends AWebLib{

  public function getHtml(): string{
    $js     = array_unique($this->paths);
    $result = "";
    foreach($js as $v){
      $result .= '<script src="' . htmlentities($v) . '" '
        . 'type="text/javascript"'
        . '></script>';
    }
    $result .= "<script>$this->inline</script>";
    return $result;
  }

  public function pathToHtmlTag(string $path): string{
    return '<script src="' . htmlentities($path) . '" '
      . 'type="text/javascript"'
      . '></script>';
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
