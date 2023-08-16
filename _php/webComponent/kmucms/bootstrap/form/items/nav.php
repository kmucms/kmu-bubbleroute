<?php /** @var kmucms\uipages\PageComponent $this */ ?>
<div  class="form-group §-">
  <label><?=$this->getData('label')??''?><?=($this->getData('mandatory')??0)?'*':''?></label>
  <div style="display:none;">
    <textarea class="§-input" name="<?=$this->getData('nameHtml')?>" class="form-control"><?= htmlentities($this->getData('value')??'')?></textarea>
  </div>
  <ul class="§-area list-group">
    editarea
  </ul>
  <div class="btn btn-primary §-add"><i class=" fa fa-plus"></i></div>
</div>

