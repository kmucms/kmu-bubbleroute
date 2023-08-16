<?php

namespace kmucms\routing;

class BubbleRequest{

  private $requestData = null;

  public function __construct(string $webPath = '', string $uri = ''){

    if($webPath == ''){
      $conf    = $_SERVER['DOCUMENT_ROOT'];
    }

    if($uri == ''){
      $uri = explode('?', $_SERVER['REQUEST_URI'], 2)[0];
    }

    $this->requestData['webPath']    = $webPath;
    $this->requestData['uri']        = $uri;
    $this->requestData['found']      = false;
    $this->requestData['slug']       = '';
    $this->requestData['scriptPath'] = '';
    $fileParts                       = explode('/', $uri);
    $this->requestData['uriPart']    = $fileParts;
    $this->requestData['ext']        = strtolower(pathinfo($uri, PATHINFO_EXTENSION));

    if($this->requestData['ext'] == 'php' && is_file($webPath . $uri)){
      $this->requestData['found']      = true;
      $this->requestData['currentUri'] = $uri;
      $this->requestData['scriptPath'] = $uri;
      return;
    }

    $uriParam   = [];
    $scriptPath = rtrim($uri, '/');

    $extensions = ['/index.php', '.php'];

    do{
      foreach($extensions as $vext){
        if(is_file($webPath . $scriptPath . $vext)){
          $this->requestData['found']       = true;
          $this->requestData['currentUri']  = $scriptPath;
          $this->requestData['scriptPath']  = $scriptPath . $vext;
          $slugRessorts                     = array_reverse($uriParam);
          $this->requestData['slugRessort'] = $slugRessorts;
          $this->requestData['slug']        = implode('/', $slugRessorts);
          return;
        }
      }
      $uriParam[] = array_pop($fileParts);
      $scriptPath = implode('/', $fileParts);
    }while(count($fileParts) > 0);
  }

  public function getUri(){
    return $this->requestData['uri'];
  }

  public function getSlug(): string{
    return $this->requestData['slug'];
  }

  /**
   * 
   * @return string something like /my/path/index.php
   */
  public function getScript(): string{
    return $this->requestData['scriptPath'];
  }

  public function getCurrentUri(): string{ //own prefix
    return $this->requestData['currentUri'];
  }

  public function getSlugRessort(int $pos): string{
    return $this->requestData['slugRessort'][$pos - 1] ?? '';
  }

  public function getRessort(int $pos): string{
    return $this->requestData['uriPart'][$pos] ?? '';
  }

  public function hasFoundController(): bool{
    return $this->requestData['found'];
  }

}
