<?php /** @var kmucms\uipages\PageComponent $this */ ?>
<div  class="form-group">
  <label><?=$this->getData('label')??''?><?=($this->getData('mandatory')??0)?'*':''?></label>
  <div>
    <input name="<?=$this->getData('nameHtml')?>" class="form-control" value="<?=$this->getData('value')??''?>" type="password"/>
  </div>
</div>

