<?php

namespace kmucms\datatable\lib\modelCompile;

class ModelCompile{

  private $model;
  private $compilePath;
  private $objectMainProperties = 'page_prop.yml';

  public function __construct(string $compilePath){
    $this->compilePath = $compilePath;
    $this->objectMainProperties = __DIR__ . '/page_prop.yml';
  }

  public function setModel(array $meta){
      $this->model = $meta;
  }

  public function setMainPropFile($path) {
    $this->objectMainProperties = $path;
  }

  public function compile(){
      $this->setFileContent('db_orig.json', json_encode($this->model));
      $model = $this->getBeautifiedEditModel($this->model);
      $model   = $this->applyPageDefaultToModel($model);
      $this->setFileContent('db_edit.json', json_encode($model));
      $dbModel = $this->objModelToDbModel($model);
      $this->setFileContent('db_tables.json', json_encode($dbModel));
      $this->setFileContent('db_opt.json', json_encode($this->objModelToOptimizedModel($model)));
    //  var_dump(json_encode($this->objModelToOptimizedModel($model)));exit;
      
      
      
      $file    = $this->compilePath. 'db.sqli';
      $dbs     = new \kmucms\dbsqlite\DbSchemaSqlite($file, $dbModel);
      $dbs->update(false);
  }

  private function setFileContent($name,$data){
    $fileName= $this->compilePath.'/'.$name;
    $dirName = dirname($fileName);
    
    if(!is_dir($dirName)){
      mkdir($dirName, 0777, true);
    }
    file_put_contents($this->compilePath.'/'.$name, $data);
  }



  private function applyPageDefaultToModel(array $model){
    //todo append default
    $prop_m = \Symfony\Component\Yaml\Yaml::parseFile($this->objectMainProperties);
    foreach($model['model']['objects'] as $k => $object){
      if($object['attributes']['main'] ?? 0){
        $object['properties']          = $prop_m + $object['properties'];
        $model['model']['objects'][$k] = $object;
      }
    }
    return $model;
  }

  private function objModelToOptimizedModel(array $ometa): array{
    $objects = [];
    foreach($ometa['model']['objects'] as $ko => $object){
      $properties = [];
      foreach($object['properties'] as $po => $prop){
        $properties[$prop['name'] ?? $po] = $prop;
      }
      $object['properties']            = $properties;
      $objects[$object['name'] ?? $ko] = $object;
    }
    $ometa['model']['objects'] = $objects;
    return $ometa;
  }

  //key to name attribute and anonymize key
  private function getBeautifiedEditModel(array $model): array{
    $objects = [];
    $onames  = [];
    foreach($model['model']['objects'] as $ko => $object){
      $properties = [];
      $pnames     = [];
      foreach(($object['properties'] ?? []) as $po => $prop){
        $prop['name'] = $prop['name'] ?? $po;
        if(!in_array($prop['name'], $pnames)){
          $pnames[]     = $prop['name'];
          $properties[] = $prop;
        }
      }
      $object['properties'] = $properties;
      $object['name']       = $object['name'] ?? $ko;
      if(!in_array($object['name'], $onames)){
        $onames[]  = $object['name'];
        $objects[] = $object;
      }
    }
    $model['model']['objects'] = $objects;
    return $model;
  }

  private function objModelToDbModel(array $ometa): array{
    $res = [];
    foreach($ometa['model']['objects'] as $ko => $object){
      $table = ['name' => $object['name'] ?? $ko, 'columns' => []];
      foreach($object['properties'] as $kp => $prop){
        $table['columns'][$prop['name'] ?? $kp] = ['name' => $prop['name'] ?? $kp];
      }
      $res[$table['name']] = $table;
    }
    return ['tables' => $res];
  }

  public function getPropertyTypes(){
    $types = \kmucms\config\Config::getInstanceByClass(self::class)->getConf('propertyTypes');
    return array_combine($types, $types);
  }

}
