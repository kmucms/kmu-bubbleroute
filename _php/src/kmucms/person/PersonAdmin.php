<?php

namespace kmucms\person;

class PersonAdmin extends APerson {

  /** @var \kmucms\files\Files Description */
  private $files;

  public function __construct(\kmucms\files\Files $files) {
    $this->files = $files;
  }

  public function doLogin(string $name, string $password) {
    $pw = $this->files->getFileContent('pw.txt');
    if ('admin' == $name && $pw == $password && $pw != '') {
      $_SESSION[static::class]['user'] = ['name' => 'admin'];
      return true;
    }
    return false;
  }

  public function setEditMode(bool $enabled = true) {
    $_SESSION[self::class]['editMode'] = $enabled;
  }

  public function toggleEditMode() {
    $_SESSION[self::class]['editMode'] = !$_SESSION[self::class]['editMode'];
  }

  public function isEditMode() {
    return $_SESSION[self::class]['editMode'] ?? 0;
  }


  public function setup(): bool {
    $done = $this->files->isFile('pw.txt');
    if (!$done) {
      $this->files->setFileContent('pw.txt', 'test123');
    }
    return $done;
  }


}
