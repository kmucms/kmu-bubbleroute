<?php

namespace kmucms\weblib;

/**
 * handle js and css library links
 */
abstract class AWebLib{

  protected $paths  = array();
  protected $inline = '';
  protected $prefix = ''; // 'http://your.awesomewebsite.com/';

  public function addPath(string $path){
    $this->paths[] = $path;
  }

  public function addPaths(array $pathArr){
    $this->paths = array_merge($this->paths, $pathArr);
  }

  public function getPathArray(): array{
    return array_unique($this->paths);
  }

  public function addInline(string $text){
    $this->inline .= "\n" . $text;
  }

  abstract public function getHtml(): string;

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

  abstract public function pathToHtmlTag(string $path): string;


  // </editor-fold>
}
