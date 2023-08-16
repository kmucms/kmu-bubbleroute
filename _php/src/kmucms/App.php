<?php

namespace kmucms;

class App{
  
  private $config = [];

  public function getDb(): dbsqlite\DbSqlite{
    return new dbsqlite\DbSqlite($this->getPaths()->getRuntimeData().'/db/db.sqli');
  }

  public function getDbModel(): array{
    return json_decode(file_get_contents($this->getPaths()->getRuntimeData().'/db/db_opt.json'), true) ?? [];
  }

  public function getPersonAdmin(): person\PersonAdmin {
    return new person\PersonAdmin($this->getFiles()->getRuntimeData(person\PersonAdmin::class));
  }

  public function getPersonUser(): person\PersonFe{
    return new person\PersonFe($this->getDb());
  }

  public function getPaths(): paths\Paths{
    return new paths\Paths($_SERVER['DOCUMENT_ROOT']);
  }

  public function getUrlInfo(): \kmucms\routing\BubbleRequest{
    return $this->config['urlinfo'];
  }
  
  public function getGlobalVars(): uipages\VarGlobals{
    return new uipages\VarGlobals($this->getPersonAdmin()->isEditMode(), $_SERVER['REQUEST_URI'], $this->getDb());
  }
  
  public function getConfig(){
      return require $this->getPaths()->getPhp().'/_config.php';
  }

  public function getFiles(): files\PFiles {
    return new files\PFiles($this->getPaths()->getRoot());
  }

  public function getUpdate(): update\Update {
    //klasse für allgemeine updates, z.b. datenbankanpassungen
    $repoFiles = $this->getFiles()->getFilesData();
    return new update\Update($this->getFiles()->getRuntimeData(update\Update::class), intval($repoFiles->getFileContent('version.txt')));
  }

  public function getEmail(){
      return new email\REmail($this->getDb());
  }
  
  public function setup($key, $value){
    $this->config[$key] = $value;
  }

  private static $instance = null;
  
  public static function getInstance(): self{
    if(self::$instance === null){
      self::$instance =  new self();
    }
    return self::$instance;
  }

}
