<?php

namespace kmucms\person;

class PersonFe extends APerson {

  /**
   * 
   * @var \kmucms\dbsqlite\DbSqlite
   */
  private $db;

  public function __construct(\kmucms\dbsqlite\DbSqlite $db) {
    $this->db = $db;
  }

  public function doLogin($email, $password): bool {
    $person = $this->db->getRowByColumn('person', 'email', $email);
    if (($person['password'] ?? '') == $password) {
      $_SESSION[self::class]['user'] = $person;
      return true;
    }
    return false;
  }

  public function getCurrentPerson() {
    return $_SESSION[self::class]['user'];
  }

  public function addPerson(array $person): array {
    $person['email'] = trim($person['email']);
    if (!filter_var($person['email'], FILTER_VALIDATE_EMAIL)) {
      return ['error' => 'Keine gültige Email'];
    }
    $euser = $this->db->getRowByColumn('person', 'email', $person['email']);
    if (count($euser) > 0) {
      return ['error' => 'Nutzer existiert bereits'];
    }
    $person['name'] = trim($person['name']);
    $euser = $this->db->getRowByColumn('person', 'name', $person['name']);
    if (count($euser) > 0) {
      return ['error' => 'Der Name existiert bereits'];
    }
    $personClean = array_intersect_key($person, ['email' => '1', 'name' => 'john doe']);
    $personClean['state'] = 'new';
    $personClean['registertoken'] = bin2hex(random_bytes(20));
    $personClean['password'] = bin2hex(random_bytes(20));
    $this->db->addRow('person', $personClean);
    return $personClean;
  }

  public function setNewRegisterToken(string $email): string {
    $newToken = bin2hex(random_bytes(20));
    $id = $this->db->getRowByColumn('person', 'email', $email);
    $this->db->updateRow('person', $id, ['registertoken' => $newToken]);
    return $newToken;
  }

}
