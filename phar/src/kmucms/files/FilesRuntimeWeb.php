<?php

namespace kmucms\files;

class FilesRuntimeWeb extends DirectoryFiles{

  /**
   * 
   * @var \kmucms\config\Config
   */
  private $config;

  public function __construct(string $className){
    $this->config = new \kmucms\config\Config(self::class);
    parent::__construct($this->config->getConf('pathRuntimeWeb') . '/' . $className);
  }

  public function getPathForWeb(string $filePath): string{
    return $this->config->getConf('webUriPrefix') . '/' . $filePath;
  }

}
