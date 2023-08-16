<?php

namespace kmucms\person;

abstract class APerson{



  abstract public function doLogin(string $name, string $password);

  public function doLogout(){
    unset($_SESSION[static::class]);
  }

  public function isLoggedIn() {

    return isset($_SESSION[static::class]['user']);
  }


}
