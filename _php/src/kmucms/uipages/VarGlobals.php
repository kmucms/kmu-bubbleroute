<?php

namespace kmucms\uipages;

/**
 * Description of VarGlobals
 *
 * @author dimitri
 */
class VarGlobals {

  private $isEditMode;
  private $backUrl;
  private $db;
  private $templateData = [];
  private $initValue = '';
  private $iconPencil = '&#128397;';

  public function __construct(bool $isEditMode, string $backUrl, \kmucms\dbsqlite\DbSqlite $db) {
    $this->isEditMode = $isEditMode;
    $this->backUrl = $backUrl;
    $this->db = $db;
    $this->initValue();
  }

  public function getValue($name) {
    return $this->templateData[$name] ?? null;
  }

  public function getButtonLink($namesKomaSeparated) {
    $par = [
      //um template-var-meta zu holen
      'module' => 'globals',
      'templateid' => 'globals',
      //zum laden
      'traceid' => 'globals',
      //zum werte bearbeiten
      'path' => '',
      'vars' => $namesKomaSeparated,
      //zum rücksprung
      'backurl' => $this->backUrl, // $_SERVER['REQUEST_URI'],
    ];
    $link = '/service/admin/be/template/traceedit?' . http_build_query($par);
    return $link;
  }

  public function getButton($namesKomaSeparated, $label = '') {
    if (!$this->isEditMode) {
      return '';
    }
    $label = empty($label) ? '' : $label . ' ';
    $link = $this->getButtonLink($namesKomaSeparated);
    return '<a href="' . $link . '"  class="edit_button_globals">' . $label . $this->iconPencil . '</a>';
  }

  private function initValue($id = 'globals') {
    $this->initValue = $id;
    $par = [
      'traceid' => 'globals',
    ];
    $res = $this->db->getRowByCondition('vartrace',
      "traceid=:traceid", $par);
    $this->templateData = json_decode($res['data'] ?? '[]', true) ?? [];
  }
}
