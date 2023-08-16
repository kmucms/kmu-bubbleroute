<?php

namespace kmucms\uipages;

/**
 * Description of TraceIt
 *
 * @author User
 */
class TraceIt {

  private $allVars = [];
  private $currentVars = [];
  private $path = [];

  public function setAll(array $vars) {
    $this->allVars = $vars;
    $this->path = [];
    $this->currentVars = &$this->allVars;
  }

  public function getAll(): array {
    return $this->allVars;
  }

  public function regionEnter(string $name) {
    array_push($this->path, $name);
    if (!isset($this->currentVars[$name])) {
      //$this->currentVars[$name] = [":var"=>[]];
      $this->currentVars[$name] = [];
    }
    $this->currentVars = &$this->currentVars[$name];
  }

  public function regionExit() {
    array_pop($this->path);
    $this->regionEnterPath($this->path);
  }

  public function regionEnterPath(array $path) {
    $this->currentVars = &$this->allVars;
    $this->path = [];
    foreach ($path as $region) {
      $this->regionEnter($region);
    }
  }

  public function getPath() {
    return '/' . implode('/', $this->path);
  }

  public function getButton($namesKomaSeparated, $label = ''){
    $par = [
      //um template-var-meta zu holen
      'module' => 'traceIt',
      'templateid' => 'traceIt',
      //zum laden
      'traceid' => 'traceIt' . '-' . 'traceIt' . '::',
      //zum werte bearbeiten
      'path' => $this->getPath(),
      'vars' => $namesKomaSeparated,
      //zum rücksprung
      'backurl' => $_SERVER['REQUEST_URI'],
    ];
    $link = '/service/admin/be/template/traceedit?' . http_build_query($par);

    return '<a class="edit_button" href="' . $link . '">' . $label . '[x]</a>';
  }

  public function setVar($key, $value) {
    //$this->currentVars[':var'][$key] = $value;
    $this->currentVars[$key] = $value;
  }

  public function getVar($key) {
    //return $this->currentVars[':var'][$key];
    return $this->currentVars[$key];
  }
}
