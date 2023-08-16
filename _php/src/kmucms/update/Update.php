<?php

namespace kmucms\update;

/**
 * Description of Update
 *
 * @author User
 */
class Update {

  private $updateFiles;
  private $newestVersion;

  public function __construct(\kmucms\files\Files $updateFiles, int $newestVersion) {
    $this->updateFiles = $updateFiles;
    $this->newestVersion = $newestVersion;
  }

  public function go() {
    $currentVersion = intval($this->updateFiles->getFileContent('version.txt'));
    if (true || $currentVersion < $this->newestVersion || $this->newestVersion == 0) { //true || for easy development
      $db_folder = \kmucms\App::getInstance()->getPaths()->getPhp() . '/db/';

      $file = $db_folder . '/db.yml';
      $model = \Symfony\Component\Yaml\Yaml::parseFile($file);
      $modelCompile = new \kmucms\datatable\lib\modelCompile\ModelCompile(
        \kmucms\App::getInstance()->getPaths()->getRuntimeData() . 'db/'
      );
      $modelCompile->setModel($model);
      $modelCompile->setMainPropFile(\kmucms\App::getInstance()->getPaths()->getPhp().'/db/object_main_properties.yml');
      $modelCompile->compile();
      $this->updateFiles->setFileContent('version.txt', $this->newestVersion);
      echo 'updated to version: ' . $this->newestVersion;
    }
  }

}
