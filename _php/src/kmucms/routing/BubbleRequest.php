<?php

namespace kmucms\routing;

class BubbleRequest{

  private static $requestData = null;
  private static $instance    = null;

  public static function init(string $webPath = '', string $uri = ''){

    if($webPath == ''){
      $conf    = new \kmucms\config\Config(self::class);
      $webPath = $conf->getConf('webPath') ?? $_SERVER['DOCUMENT_ROOT'];
    }

    if($uri == ''){
      $uri = explode('?', $_SERVER['REQUEST_URI'], 2)[0];
    }

    self::$requestData['webPath']    = $webPath;
    self::$requestData['uri']        = $uri;
    self::$requestData['found']      = false;
    self::$requestData['slug']       = '';
    self::$requestData['scriptPath'] = '';
    $fileParts                       = explode('/', $uri);
    self::$requestData['uriPart']    = $fileParts;
    self::$requestData['ext']        = strtolower(pathinfo($uri, PATHINFO_EXTENSION));

    if(self::$requestData['ext'] == 'php' && is_file($webPath . $uri)){
      self::$requestData['found']      = true;
      self::$requestData['currentUri'] = $uri;
      self::$requestData['scriptPath'] = $uri;
      return;
    }

    $uriParam   = [];
    $scriptPath = rtrim($uri, '/');

    do{
      if(is_file($webPath . $scriptPath . '/index.php')){
        self::$requestData['found']       = true;
        self::$requestData['currentUri']  = $scriptPath;
        self::$requestData['scriptPath']  = $scriptPath . '/index.php';
        $slugRessorts                     = array_reverse($uriParam);
        self::$requestData['slugRessort'] = $slugRessorts;
        self::$requestData['slug']        = implode('/', $slugRessorts);
        return;
      }
      $uriParam[] = array_pop($fileParts);
      $scriptPath = implode('/', $fileParts);
    }while(count($fileParts) > 0);
  }

  public static function getInstance(): self{
    if(self::$instance == null){
      self::$instance = new self();
      if(self::$requestData == null){
        self::init();
      }
    }
    return self::$instance;
  }

  public function getUri(){
    return self::$requestData['uri'];
  }

  public function getSlug(): string{
    return self::$requestData['slug'];
  }

  /**
   * 
   * @return string something like /my/path/index.php
   */
  public function getScript(): string{
    return self::$requestData['scriptPath'];
  }

  public function getCurrentUri(): string{ //own prefix
    return self::$requestData['currentUri'];
  }

  public function getSlugRessort(int $pos): string{
    return self::$requestData['slugRessort'][$pos - 1] ?? '';
  }

  public function getRessort(int $pos): string{
    return self::$requestData['uriPart'][$pos] ?? '';
  }

  public function hasFoundController(): bool{
    return self::$requestData['found'];
  }

}
