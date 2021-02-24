<?php

namespace kmucms\uipages;

class VarTrace{

  private $prefix              = '';
  private $breadcrumb          = [];
  private $templatesBreadcrumb = [];
  private $currentTemplate     = '';
  private $values              = [];

  public function setPrefix(string $prefix){
    $this->prefix = $prefix;
  }

  public function pushLevel(string $name, string $currentTemplateId){
    $this->breadcrumb[]          = $name;
    $this->templatesBreadcrumb[] = $currentTemplateId;
    $this->currentTemplate       = $currentTemplateId;
  }

  public function popLevel(){
    array_pop($this->breadcrumb);
    array_pop($this->templatesBreadcrumb);
  }

  public function getValue(string $key){
    return $this->values[$this->getVKey($key)] ?? null;
  }

  //returns prefix:breadcrumb:keys , keys "," seperated
  public function getVKey(string $keys){
    return $this->prefix . ':' . implode('/', $this->breadcrumb) . ':' . $key;
  }

  public function setValues(array $values){
    $this->values = $values;
  }

}
