<?php 
/** @var kmucms\uipages\PageComponent $this */ 
//var_dump($this->getData('value'));// exit;
?>
<div  class="form-group §-">
  <label>
    <input class="mr-2 §-checkbox" type="checkbox" <?= ($this->getData('value') ?? 0 == '1')?'checked':'' ?> />
    <input name="<?= $this->getData('nameHtml') ?>" class="mr-2 §-value" type="hidden" value="<?= ($this->getData('value') ?? 0 ) ?>" />
    <?= $this->getData('label') ?? '' ?><?= ($this->getData('mandatory') ?? 0) ? '*' : '' ?>
  </label>
</div>

