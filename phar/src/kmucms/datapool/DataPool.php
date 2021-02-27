<?php

namespace kmucms\datapool;

class DataPool{

  public function getModel(){
    return $model = \Symfony\Component\Yaml\Yaml::parseFile(__DIR__ . '/default_model.yml');
  }

  public function setModel(array $meta){
    //todo: code
  }

  public function getPropertyTypes(){
    $types = explode(',', 'string,checkbox,textarea');
    return array_combine($types, $types);
  }

  // <editor-fold defaultstate="collapsed" desc="singleton stuff">
  static private $instance = null;

  /**
   *
   * @return static
   */
  static public function getInstance(): self{
    if(null === self::$instance){
      self::$instance = new self;
    }
    return self::$instance;
  }

  private function __construct(){
    
  }

  private function __clone(){
    
  }

  // </editor-fold>
}
