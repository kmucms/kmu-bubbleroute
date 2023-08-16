<?php /** @var kmucms\uipages\PageComponent $this */ ?>
<div  class="form-group">
  <label><?= $this->getData('label') ?? '' ?><?= ($this->getData('mandatory') ?? 0) ? '*' : '' ?></label>
  <div>
    <select name="<?= $this->getData('nameHtml') ?>" class="form-select" >
      <?php foreach($this->getData('options')??[] as $koption => $option): ?>
        <option value="<?= $koption ?>" <?=$koption == $this->getData('value')?'selected':''?>><?= $option ?></option>
      <?php endforeach; ?>
    </select>
  </div>
</div>

