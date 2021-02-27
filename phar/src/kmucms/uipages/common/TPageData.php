<?php

namespace kmucms\uipages\common;

trait TPageData{

  protected $data = [];

  public function setData(string $key, $value){
    $this->data[$key] = $value;
  }

  public function getData($key){
    return $this->data[$key] ?? null;
  }
  
  public function getDataAll():array{
    return $this->data;
  }

}
