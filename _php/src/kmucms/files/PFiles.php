<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace kmucms\files;

/**
 * Description of PFiles
 *
 * @author HUSTI
 */
class PFiles {

  private $path = '';

  public function __construct($path) {
    $this->path = $path;
  }

  public function getFilesWeb(): Files {
    return new Files($this->path . '/_files/web/files/');
  }

  public function getFilesData(): Files {
    return new Files($this->path . '/_files/data/');
  }

  public function getRuntimeWeb(): Files {
    return new Files($this->path . '/_runtime/web/runtime/');
  }

  public function getRuntimeData(string $subpath = '', string $type = 'class'): Files {
    return new Files($this->path . '/_runtime/data/' . $type . '/' . $subpath . '/');
  }

}
