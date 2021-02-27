<?php

namespace kmucms\uipages\common;

class APage{

  use TPageData;

  const type = '';

  protected $templateId             = '';
  protected static $usedTemplateIds = [];
  protected $templatePath           = '';

  /** @var \kmucms\config\Config */
  private $config;

  public function __construct($templateId, $data = []){
    $this->templateId                                   = $templateId;
    $this->data                                         = $data;
    static::$usedTemplateIds[static::type][$templateId] = 1;
    $this->config                                       = \kmucms\config\Config::getInstanceClass(self::class);
    $this->templatePath                                 = $this->config->getConf('templatePath');
  }

  public function getComponent(string $componentId, array $data = []): string{
    $component = new \kmucms\uipages\PageComponent($componentId, $data);
    return $component->getHtml();
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
    require $this->templatePath . '/' . static::type . '/' . $this->templateId . '.php';
    $res = ob_get_clean();
    return $res;
  }

  public function urlInfo(): \kmucms\routing\BubbleRequest{
    return \kmucms\routing\BubbleRequest::getInstance();
  }

  public function weblib(): Weblib{
    return Weblib::getInstance();
  }

}
