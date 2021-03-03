<?php

namespace kmucms\uipages;

class PageWeb extends common\APage{

  const type = 'web';

  private $envelopeId = '';

  public function setPageEnvelope(string $envelopeId = 'index'){
    $this->envelopeId = $envelopeId;
  }

  public function getHtml(){
    $res = parent::getHtml();

    if($this->envelopeId != ''){
      $this->data['content'] = $res;
      $parent                = new PageEnvelope($this->envelopeId, $this->data);
      $res                   = $parent->getHtml();
    }
    return $res;
  }

  public function echoPage(){
    echo $this->appendInlineCssAndJs($this->getHtml());
    exit;
  }

  private function appendInlineCssAndJs(string $res): string{
    $classes      = [self::class, PageComponent::class, PageEnvelope::class];
    $css          = '';
    $js           = '';
    $webTemplates = '';
    foreach($classes as $class){
      /** @var \kmucms\uipages\APage $class */
      foreach(array_keys($class::$usedTemplateIds[$class::type] ?? []) as $templateId){
        $file = $this->templatePath[static::type] . '/' . $templateId . '.css';
        $css  .= is_file($file) ? file_get_contents($file) : '';
        $file = $this->templatePath[static::type] . '/' . $templateId . '.js';
        $js   .= is_file($file) ? file_get_contents($file) : '';
        $file = $this->templatePath[static::type] . '/' . $templateId . '.web.php';
        $js   .= is_file($file) ? file_get_contents($file) : '';
      }
    }
    $weblibCss = $this->weblib()->getCssHtml();
    $weblibJs  = $this->weblib()->getJsHtml();

    $res = str_replace('</head>', "$weblibCss<style>$css</style></head>", $res);
    $res = str_replace('</body>', "$webTemplates $weblibJs<script>$js</script></body>", $res);
    return $res;
  }

  public function redirect(string $dest){
    header('Location: ' . $dest);
    exit;
  }

}
