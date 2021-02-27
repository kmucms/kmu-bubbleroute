<?php

namespace kmucms\uipages;

class PageEnvelope extends common\APage{

  const type                      = 'envelope';

  private $parentEnvelopeId = '';

  public function setPageEnvelope(string $envelopeId = ''){
    $this->parentEnvelopeId = $envelopeId;
  }

  public function getHtml(){
    $res = parent::getHtml();

    if($this->parentEnvelopeId != ''){
      $this->data['content'] = $res;
      $parent                = new PageEnvelope($this->parentEnvelopeId, $this->data);
      $res                   = $parent->getHtml();
    }
    return $res;
  }

}
