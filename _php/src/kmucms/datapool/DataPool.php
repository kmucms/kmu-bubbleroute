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
      if(!$this->filesRepo->isFile('db_objects.json')){
        $this->filesRepo->setFileContent(
          'db_objects.json',
          json_encode(\Symfony\Component\Yaml\Yaml::parseFile(__DIR__ . '/default_model.yml'))
        );
      }
      $this->model = json_decode($this->filesRepo->getFileContent('db_objects.json'), true);
    }
    return $this->model;
  }

  public function setModel(array $meta){
    $this->filesRepo->setFileContent('description.json', json_encode($meta));
  }

  public function getModelEditVersion(): array{
    if(!isset($this->model)){
      if(!$this->filesRepo->isFile('db_objects_edit.json')){
        $this->filesRepo->setFileContent(
          'db_objects_edit.json',
          json_encode(\Symfony\Component\Yaml\Yaml::parseFile(__DIR__ . '/default_model.yml'))
        );
      }
      $this->model = json_decode($this->filesRepo->getFileContent('db_objects_edit.json'), true);
    }
    return $this->model;
  }

  public function setModelEditVersion(array $meta){
    $this->filesRepo->setFileContent('db_objects_edit.json', json_encode($meta));
  }

  public function compile(){
    $model   = $this->getModelEditVersion();
    $this->filesRepo->setFileContent('db_objects.json', json_encode($model));
    $file    = $this->filesRepo->getAbsoluteFilePath('db.sqli', true);
    $dbModel = $this->objModelToDbModel($model);
    $this->filesRepo->setFileContent('db_tables.json', json_encode($model));
    $dbs     = new \kmucms\dbsqlite\DbSchemaSqlite($file, $dbModel);
    $dbs->update(false);
  }
  
  public function getDb(){
    return new \kmucms\dbsqlite\DbSqlite($this->filesRepo->getAbsoluteFilePath('db.sqli'));
  }

  private function objModelToDbModel(array $ometa): array{
    $res = ['tables' => []];
    foreach($ometa['model']['objects'] as $object){
      $table = ['name' => $object['name'], 'columns' => []];
      foreach($object['properties'] as $prop){
        $table['columns'][$prop['name']] = ['name' => $prop['name']];
      }
      $res['tables'][$table['name']] = $table;
    }
    return $res;
  }

  public function hasObject(string $name): bool{
    return isset($this->getModel()['model']['objects'][$name]);
  }

  public function getObjectModel($objectName){
    return $this->getModel()['model']['objects'][$objectName] ?? [];
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
