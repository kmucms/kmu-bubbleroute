<?php

namespace kmucms\config;
exit;
/**
 * It helps configuring a project.
 * This class need to be init at the beginning. 
 * It and can be used anywhere within an ressource.
 */
class Config{

  /**
   * holds all config data
   * @var array
   */
  private static $data = [];

  /**
   * unique identifier of an ressource which needs to be configuren, e.g. class, php-file, ... 
   * @var string
   */
  private $ressourceId = '';
  /**
   * the type of an configurable-ressource e.g. class, php-file, db-table ...
   * @var string
   */
  private $type      = 'class';

  /**
   * The config file should be a php file like:
   * <?php return ['global'=>[],'class'=>['my\class\MyClass::class=>['myConfigValue_n'=>'abcd...']]];
   * @param string $filePath path to the config file.
   */
  public static function init(string $filePath){
    self::$data = require_once $filePath;
  }


  public function __construct(string $ressouceId, string $ressourceType = 'class'){
    $this->ressourceId = $ressouceId;
    $this->type      = $ressourceType;
  }

  public static function getInstanceClass(string $className): self{
    return new self($className, 'class');
  }

  /**
   * 
   * @param string $name
   * @return mixed | null if not defined
   */
  public function getConf(string $name): mixed{
    if(isset(self::$data[$this->type][$this->ressourceId][$name])){
      return self::$data[$this->type][$this->ressourceId][$name];
    }
    return null;
  }

  /**
   * 
   * @return array|null null if not defined
   */
  public function getConfAll(): array|null{
    if(isset(self::$data[$this->type][$this->ressourceId])){
      return self::$data[$this->type][$this->ressourceId];
    }
    return null;
  }

  public function getGlobal(string $name){
    if(isset(self::$data['global'][$name])){
      return self::$data['global'][$name];
    }
    return null;
  }

}
