<?php

namespace kmucms\files;

class FilesRuntimeData extends DirectoryFiles{

  public function __construct(string $className){
    parent::__construct((new \kmucms\config\Config(self::class))->getConf('pathRuntimeData') . '/' . $className);
  }

}
