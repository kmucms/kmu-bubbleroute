<?php /** @var kmucms\uipages\PageComponent $this */ ?>
<div  class="form-group §-">
  <label><?=$this->getData('label')??''?><?=($this->getData('mandatory')??0)?'*':''?></label>
  <div>
    <textarea class="§-input" name="<?=$this->getData('nameHtml')?>" class="form-control"><?= htmlentities($this->getData('value')??'')?></textarea>
  </div>
  <div class="§-area">
    editarea
  </div>
</div>

