<?php

namespace kmucms\adminuser;

class AdminUser{

  /**
   * 
   * @var \kmucms\config\Config
   */
  private $config;

  public function __construct(){
    $this->config = \kmucms\config\Config::getInstanceClass(self::class);
  }

  public function doLogin(string $name, string $password){
    if($this->config->getConf('name') == $name && $this->config->getConf('password') == $password){
      $_SESSION[self::class]['user'] = ['name' => 'admin'];
      return true;
    }
    return false;
  }

  public function doLogout(){
    unset($_SESSION[self::class]);
  }

  public function isLoggedIn(){
    return isset($_SESSION[self::class]['user']);
  }

  public function setEditMode(bool $enabled = true){
    $_SESSION[self::class]['editMode'] = $enabled;
  }

  public function isEditMode(){
    return $_SESSION[self::class]['editMode'] ?? 0;
  }

}
