<?php /** @var kmucms\uipages\PageComponent $this */ ?>
<div  class="form-group">
  <label><?=$this->getData('label')??''?><?=($this->getData('mandatory')??0)?'*':''?></label>
  <div>
    <input name="<?= $this->getData('nameHtml') ?>" class="form-control" type="date" value="<?= empty($this->getData('value')) ? (new DateTime())->format('Y-m-d') : $this->getData('value') ?>"/>
  </div>
</div>

