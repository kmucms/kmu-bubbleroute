<?php

namespace kmucms\paths;


class Paths {

  private $paths = [];

  public function __construct($root) {
    $root = $root . '/';
    $this->paths['root'] = $root . '/';
    $this->paths['php'] = dirname(__DIR__, 3) . '/';
    $this->paths['rw'] = $root . '_runtime/web/';
    $this->paths['rd'] = $root . '_runtime/data/';
    $this->paths['fw'] = $root . '_files/web/';
    $this->paths['fd'] = $root . '_files/data/';
  }

  public function getRoot() {
    return $this->paths['root'];
  }

  public function getPhp() {
    return $this->paths['php'];
  }

  public function getRuntimeWeb() {
    return $this->paths['rw'];
  }

  public function getRuntimeData() {
    return $this->paths['rd'];
  }

  public function getFilesWeb() {
    return $this->paths['fw'];
  }

  public function getFilesData() {
    return $this->paths['fd'];
  }

}
