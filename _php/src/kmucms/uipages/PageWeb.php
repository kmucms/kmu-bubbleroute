<?php

namespace kmucms\uipages;

class PageWeb extends common\APage {

  const type = 'web';

  private $envelopeId = '';
  private $initValue = '';
  private $templateData = [];
  private static $templateDataStatic = [];
  private $path = 'trace';
  private $db;
  private $config = [
    'requestUri'  
  ];
  private $iconPencil = '&#128397;';

  public function __construct($templateId, $data = [], string $tpath = '', \kmucms\dbsqlite\DbSqlite $db = null, $config = []) {
    $this->db = $db;
    parent::__construct($templateId, $data, $tpath);
    $this->config = $config;
  }

  public function setEnvelope(string $envelopeId = 'kmucms/index') {
    $this->envelopeId = $envelopeId;
  }

  public function getHtml() {
    $res = parent::getHtml();

    //$res = $this->replaceJoker($this::type, $this->templateId, $res);

    if ($this->envelopeId != '') {
      $this->data['content'] = $res;
      $parent = new PageEnvelope($this->envelopeId, $this->data, $this->tpath);
      $res = $parent->getHtml();
    }
    return $res;
  }

  private function replaceJoker($type, $templateId, $text) {
    return str_replace('§-', $type . '-' . str_replace('/', '_', $templateId) . '-', $text);
  }

  public function echoPage() {
    echo $this->appendInlineCssAndJs($this->getHtml());
    exit;
  }

  private function appendInlineCssAndJs(string $res): string {
    $classes = [
      self::class,
      PageComponent::class,
      PageEnvelope::class
    ];
    $css = '';
    $js = '';
    $webTemplates = '';
    foreach ($classes as $class) {
      /** @var \kmucms\uipages\common\APage $class */
      foreach (array_keys(static::$usedTemplateIds[$class::type] ?? []) as $templateId) {
        $file = $this->templatePath[$class::type] . '/' . $templateId . '.css';
        $css .= is_file($file) ? $this->replaceJoker($class::type, $templateId, file_get_contents($file)) : '';
        $file = $this->templatePath[$class::type] . '/' . $templateId . '.js';
        $js .= is_file($file) ? $this->replaceJoker($class::type, $templateId, file_get_contents($file)) : '';
        $file = $this->templatePath[$class::type] . '/' . $templateId . '.jstemplate.php';
        $webTemplates .= is_file($file) ? $this->replaceJoker($class::type, $templateId, file_get_contents($file)) : '';
      }
    }
    $weblibCss = $this->css->getHtml();
    $weblibJs = $this->js->getHtml();

    $templatePath = $this->tpath . '/webTemplate/';
    $type = 'template';
    foreach (PageTemplate::getUsedTemplateIds() as $templateId) {
      $file = $templatePath . '/' . $templateId . '.css';
      $css .= is_file($file) ? $this->replaceJoker($type, $templateId, file_get_contents($file)) : '';
      $file = $templatePath . '/' . $templateId . '.js';
      $js .= is_file($file) ? $this->replaceJoker($type, $templateId, file_get_contents($file)) : '';
      $file = $templatePath . '/' . $templateId . '.jstemplate.php';
      $webTemplates .= is_file($file) ? $this->replaceJoker($type, $templateId, file_get_contents($file)) : '';
    }

    $res = str_replace('</head>', "$weblibCss<style>$css</style></head>", $res);
    $res = str_replace('</body>', "<div class='jstemplate' style='display:none;'>$webTemplates</div> $weblibJs<script>$js</script></body>", $res);
    return $res;
  }

  public function initValue($id) {
    $this->initValue = $id;
    $par = [
      'traceid' => $this->getTraceId(),
    ];
    $res = \kmucms\App::getInstance()->getDb()->getRowByCondition('vartrace',
      "traceid=:traceid", $par);
    $this->templateData = json_decode($res['data'] ?? '[]', true)[$this->path] ?? [];
  }

  public function getValue($name) {
    return $this->templateData[$name] ?? null;
  }

  public function getButton($namesKomaSeparated, $label = '') {
    if(!\kmucms\App::getInstance()->getPersonAdmin()->isEditMode()){
      return '';
    }
    $par = [
      //um template-var-meta zu holen
      'module' => self::type,
      'templateid' => $this->templateId,
      //zum laden
      'traceid' => $this->getTraceId(),
      //zum werte bearbeiten
      'path' => $this->path,
      'vars' => $namesKomaSeparated,
      //zum rücksprung
      'backurl' => $_SERVER['REQUEST_URI'],
    ];
    $link = '/service/admin/be/template/traceedit?' . http_build_query($par);
    return '<a href="' . $link . '" class="edit_button">' . $label . $this->iconPencil . '</a>';
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
    return '<a class="edit_button" href="' . $link . '">' . $this->iconPencil . '</a>';
  }

  private function getTraceId() {
    return $this::type . '-' . $this->templateId . '-' . $this->initValue . ':';
  }

  public function getTemplate(string $name, string $templateId, array $data = []): string {
    $name = trim($name);
    $templateId = trim($templateId);
    $ptemplate = new \kmucms\uipages\PageTemplate(
      $this->path . '/' . $name,
      $templateId,
      $data,
      $this->getTraceId(),
      $this->templateData[$name] ?? [],
      $this->config
    );
    return $ptemplate->getHtml();
  }
  
  public function getInputMeta($templateId) {
    return require $this->tpath . '/web/' . $templateId . '.input.php';
  }

}
