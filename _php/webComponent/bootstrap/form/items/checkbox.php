<?php /** @var kmucms\uipages\PageComponent $this */ ?>
<div  class="form-group">
  <label>
    <input name="<?= $this->getData('nameHtml') ?>" class="mr-2" type="checkbox" <?= ($this->getData('value') ?? 0)?'checked':'' ?> />
    <?= $this->getData('label') ?? '' ?><?= ($this->getData('mandatory') ?? 0) ? '*' : '' ?>
  </label>
</div>

