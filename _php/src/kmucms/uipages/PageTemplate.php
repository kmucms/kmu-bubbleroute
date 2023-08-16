<?php

namespace kmucms\uipages;

class PageTemplate {
  
   use common\TPageData;

  const type = "template";

  private string $path;  //trace-path for editing values
  private string $templateId;
  private string $traceId;
  private array $traceData;
  private static $templateDataStatic = [];
  private static $usedTemplateIds = [];
  private $templatePath = '';
  private $configs = [
    //requestUri
  ];
  private $iconPencil = '&#128397;';

  /** @var \kmucms\weblib\JsLib */
  public $js;

  /** @var \kmucms\weblib\CssLib */
  public $css;

  public function __construct(
          string $path, 
          string $templateId, 
          array $data, 
          string $traceId, 
          array $traceData,
          array $configs = []
          ) {
    $this->path = $path;
    $this->templateId = $templateId;
    $this->data = $data;
    $this->traceId = $traceId;
    $this->traceData = $traceData;
    $this->templatePath = \kmucms\App::getInstance()->getPaths()->getPhp().'/webTemplate/';
    $this->configs= $configs;

    if (!isset(self::$usedTemplateIds[$templateId])) {
    /*      $par = [
        'traceid' => $this::type . '-' . $this->templateId . '::',
      ];
      $res = \kmucms\App::getInstance()->getDb()->getRowByCondition('vartrace',
        "traceid=:traceid", $par);

      static::$templateDataStatic[$templateId] = json_decode($res['data'] ?? '[]', true)['vars'] ?? [];
     * 
     */
      self::$usedTemplateIds[$templateId] = 1;
    }
    
    
    $this->js = \kmucms\weblib\JsLib::getInstance();
    $this->css = \kmucms\weblib\CssLib::getInstance();
  }

  public function getHtml() {
    ob_start();
    require $this->templatePath . '/' . $this->templateId . '.php';
    $res = ob_get_clean();
    $res = $this->replaceJoker(self::type, $this->templateId, $res);
    return $res;
  }

  public static function getInputMeta($templateId) {
    $file =  \kmucms\App::getInstance()->getPaths()->getPhp().'/webTemplate/'  . $templateId . '.input.php';
    if (is_file($file)) {
      return require $file;
    }
    return [];
  }

  public function getValue($name) {
    return $this->traceData[$name] ?? null;
  }

  public function getValues() {
    return $this->traceData;
  }
  

  public function getButtonId():array{
    return [
      //um template-var-meta zu holen
      'module' => self::type,
      'templateid' => $this->templateId,
      //zum laden
      'traceid' => $this->traceId, //static => $this::type . '-' . $this->templateId . '::',
      //zum werte bearbeiten
      'path' => $this->path,
      //'vars' => $namesKomaSeparated,
      //zum rücksprung
      'backurl' => $this->configs['requestUri'] //$_SERVER['REQUEST_URI'],
    ];
  }
  

  public function getButton($namesKomaSeparated, $label = '') {
    if(!\kmucms\App::getInstance()->getPersonAdmin()->isEditMode()){
      return '';
    }
    $par = $this->getButtonId();
    $par['vars'] = $namesKomaSeparated;
    $link = '/service/admin/be/template/traceedit?' . http_build_query($par);

    return '<a class="edit_button" href="' . $link . '">' . $label . $this->iconPencil . '</a>';
  }

  private function getValueStatic($name) {
    //var_dump(static::$templateDataStatic,$this->templateId); exit;
    return static::$templateDataStatic[$this->templateId][$name] ?? null;
  }

  private function getButtonStatic($namesKomaSeparated) {
    $par = [
      //um template-var-meta zu holen
      'module' => $this::type,
      'templateid' => $this->templateId,
      //zum laden
      'traceid' => $this::type . '-' . $this->templateId . '::',
      //zum werte bearbeiten
      'path' => 'vars',
      'vars' => $namesKomaSeparated,
      //zum rücksprung
      'backurl' => $_SERVER['REQUEST_URI'],
    ];
    $link = '/service/admin/be/template/traceedit?' . http_build_query($par);
    return '<a href="' . $link . '" class="edit_button">' . $this->iconPencil . '</a>';
  }

  public function getTemplate(string $name, string $templateId, array $data = []): string {
    $name = trim($name);
    $templateId = trim($templateId);
    $ptemplate = new self(
      $this->path . '/' . $name,
      $templateId,
      $data,
      $this->traceId,
      $this->traceData[$name] ?? [],
      $this->configs
    );
    return $ptemplate->getHtml();
  }

  public static function getUsedTemplateIds() {
    return array_keys(self::$usedTemplateIds);
  }

  private function replaceJoker($type, $templateId, $text) {
    return str_replace('§-', $type . '-' . str_replace('/', '_', $templateId) . '-', $text);
  }


  
}
