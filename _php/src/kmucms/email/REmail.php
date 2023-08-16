<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace kmucms\email;

/**
 * Description of REmail
 *
 * @author HUSTI
 */
class REmail {

  /** @var \kmucms\dbsqlite\DbSqlite */
  private $db;

  public function __construct(\kmucms\dbsqlite\DbSqlite $db) {
    $this->db = $db;
  }

  public function submit($toEmail, $subject, $message) {
    $fromEmail = 'service@gosalsa.de';
    //$headers[] = 'From: ' . $_SERVER['HTTP_HOST'] . ' <' . $fromEmail . '>';
    //mail($toEmail, $subject, $message, implode("\r\n", $headers));
    $this->db->addRow('email', [
      'emailFrom' => $fromEmail,
      'emailTo' => $toEmail,
      'subject' => $subject,
      'message' => $message,
    ]);
  }

}
