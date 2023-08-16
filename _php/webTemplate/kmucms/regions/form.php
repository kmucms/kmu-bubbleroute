<?php
/** @var \kmucms\uipages\PageTemplate $this */
?>

<section class="§- container border rounded p-3 overflow-auto shadow" style="max-width: 500px">
  <form class="form" method="post" action="/service/ajax/form">
    <?php foreach (json_decode($this->getValue('form'), true) as $k => $item): ?>
      <div class="mb-2">
        <label class="form-label"><?= $item['label'] ?> <?= $item['mandatory'] ? '*' : '' ?></label>
        <div>
          <?php if ($item['type'] === 'textarea'): ?>
            <textarea name="item[<?= $k ?>]" class="form-control"></textarea>
          <?php elseif ($item['type'] === 'email'): ?>
            <input name="item[<?= $k ?>]" class="form-control" type="email"/>
          <?php elseif ($item['type'] === 'date'): ?>
            <input name="item[<?= $k ?>]" class="form-control" type="date"/>
          <?php elseif ($item['type'] === 'checkbox'): ?>
            <input name="item[<?= $k ?>]" class="form-checkbox" type="checkbox"/>
          <?php elseif ($item['type'] === 'select'): ?>
            <select name="item[<?= $k ?>]" class="form-select">
              <?php foreach (explode(',', $item['options']) as $opt): ?>
                <option value="<?= $opt ?>"><?= $opt ?></option>
              <?php endforeach; ?>
            </select>
          <?php else: ?>
            <input name="item[<?= $k ?>]" class="form-control"/>
          <?php endif; ?>
        </div>
      </div>
    <?php endforeach; ?>
    <div class="mb-2 §-robokumpel">
      <label class="form-label ">robokumpel *</label>
      <div>
        <input name="item[robokumpel]" class="form-control"/>
      </div>
    </div>
    <br/>
    <input type="hidden" name="formId" value="<?= htmlentities(json_encode($this->getButtonId())) ?>" />
    <div class="§-error alert alert-danger" role="alert"  style="display:none">
    </div>
    <button class="§-submit btn btn-primary float-end"><?= $this->getValue('formsubmit') ?? 'Abschicken' ?></button>
  </form>
  <?= $this->getButton('form,formsubmit,tomail,subject,textaftersubmit') ?>
  <div class="§-success alert alert-success" style="display:none">
    <?= $this->getValue('textaftersubmit') ?>
  </div>
</section>