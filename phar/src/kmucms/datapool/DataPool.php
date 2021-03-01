<?php

namespace kmucms\datapool;

class DataPool{

  /**
   * 
   * @var \kmucms\files\FilesRuntimeData
   */
  private $filesRepo;

  public function getModel(): array{
    if(!$this->filesRepo->isFile('description.json')){
      $this->filesRepo->setFileContent(
        'description.json',
        json_encode(\Symfony\Component\Yaml\Yaml::parseFile(__DIR__ . '/default_model.yml'))
      );
    }
    return json_decode($this->filesRepo->getFileContent('description.json'), true);
  }

  public function setModel(array $meta){
    $this->filesRepo->setFileContent('description.json', json_encode($meta));
  }

  public function getPropertyTypes(){
    $types = \kmucms\config\Config::getInstanceClass(self::class)->getConf('propertyTypes');
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
    $this->filesRepo = new \kmucms\files\FilesRuntimeData(self::class);
  }

  private function __clone(){
    
  }

  // </editor-fold>
}
