<?php /** @var kmucms\uipages\PageComponent $this */ ?>
<div  class="form-group §-" data-options="<?= htmlentities(json_encode($this->getData('options'))) ?>">
  todo: formular
  <label><?=$this->getData('label')??''?><?=($this->getData('mandatory')??0)?'*':''?></label>
  <div style="display:none;">
    <textarea class="§-input" name="<?=$this->getData('nameHtml')?>" class="form-control"><?= htmlentities($this->getData('value')??'')?></textarea>
  </div>
  <ul class="§-area list-group">
    editarea
  </ul>
  <div class="btn btn-primary §-add w-100"><i class="fa fa-plus"></i></div>

  <select class="§-default_options"  data-name="templateid" style="display: none;" >
      <?php foreach($this->getData('options')??[] as $koption => $option): ?>
        <option value="<?= $koption ?>" ><?= $option ?></option>
      <?php endforeach; ?>
    </select>
</div>

