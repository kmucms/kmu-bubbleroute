<?php

namespace kmucms\uipages\common;

class APage{

  use TPageData;

  const type = '';

  protected $templateId             = '';
  protected static $usedTemplateIds = [];
  protected $templatePath = [];
  protected $tpath;

  /** @var \kmucms\weblib\JsLib */
  public $js;

  /** @var \kmucms\weblib\CssLib */
  public $css;


  public function __construct($templateId, $data = [], string $tpath = '') {
    $this->templateId = trim($templateId);
    $this->data = $data;
    $this->tpath = $tpath;
    static::$usedTemplateIds[static::type][$templateId] = 1;
    $this->templatePath = [
      'web' => $tpath . '/web',
      'envelope' => $tpath . '/webEnvelope',
      'component' => $tpath . '/webComponent',
    ];
    $this->js = \kmucms\weblib\JsLib::getInstance();
    $this->css = \kmucms\weblib\CssLib::getInstance();
  }

  public function getComponent(string $componentId, array $data = []): string{
    $component = new \kmucms\uipages\PageComponent(trim($componentId), $data, $this->tpath);
    return $component->getHtml();
  }
  
  private function replaceJoker($type, $templateId, $text) {
    return str_replace('§-', $type . '-' . str_replace('/', '_', $templateId) . '-', $text);
  }

  public function isComponent(string $componentId): bool{
    return is_file($this->templatePath[\kmucms\uipages\PageComponent::type] . '/' . trim($componentId) . '.php');
  }

  public function getComponents(array $componentIdAnddata = []): string{
    $res = [];
    foreach($componentIdAnddata as $componentId => $data){
      $component = new \kmucms\uipages\PageComponent($componentId, $data);
      $res[]     = $component->getHtml();
    }
    return implode('', $res);
  }

  public function getHtml(){
    ob_start();
    require $this->templatePath[static::type] . '/' . $this->templateId . '.php';
    $res = ob_get_clean();
    $res = $this->replaceJoker($this::type, $this->templateId, $res) ;
    return $res;
  }

  public function redirect(string $dest){
    header('Location: ' . $dest);
    exit;
  }

}
