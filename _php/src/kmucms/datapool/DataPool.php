<?php

namespace kmucms\datapool;

class DataPool{

  /**
   * 
   * @var \kmucms\files\FilesRuntimeData
   */
  private $filesRepo;
  private $model;

  public function getModel(): array{
    if(!isset($this->model)){
      if(!$this->filesRepo->isFile('description.json')){
        $this->filesRepo->setFileContent(
          'description.json',
          json_encode(\Symfony\Component\Yaml\Yaml::parseFile(__DIR__ . '/default_model.yml'))
        );
      }
      $this->model = json_decode($this->filesRepo->getFileContent('description.json'), true);
    }
    return $this->model;
  }

  public function setModel(array $meta){
    $this->filesRepo->setFileContent('description.json', json_encode($meta));
  }

  public function hasObject(string $name): bool{
    return isset($this->getModel()['model']['objects'][$name]);
  }
  
  public function getObjectModel($objectName){
    return $this->getModel()['model']['objects'][$objectName]??[];
  }

  public function getPropertyTypes(){
    $types = \kmucms\config\Config::getInstanceByClass(self::class)->getConf('propertyTypes');
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
