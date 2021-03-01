<?php

namespace kmucms\uipages\common;

trait TPageData{

  protected $data = [];

  public function setData(string $key, $value): void{
    $this->data[$key] = $value;
  }
  public function setDataAll($value): void{
    $this->data = $value;
  }

  public function getData($key): mixed{
    return $this->data[$key] ?? null;
  }

  public function getDataAll(): array{
    return $this->data;
  }

  /*
  public function getDataByPath(string $path, string $delimiter = ','): mixed{
    $pathParts = explode($delimiter, $path);

    $current = &$array;
    foreach($pathParts as $key){
      if(!isset($current[$key])){
        return;
      }
      $current = &$current[$key];
    }

    return $current;
  }
  */

}
