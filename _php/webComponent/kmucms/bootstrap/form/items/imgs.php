<?php /** @var kmucms\uipages\PageComponent $this */ ?>
<div  class="form-group  §-" data-upload="/service/admin/be/img/upload">
  <label><?= $this->getData('label') ?? '' ?><?= ($this->getData('mandatory') ?? 0) ? '*' : '' ?></label>
  <div>
    <div class = "§-imgs">
    </div>
    <div class="btn btn-primary §-upload">
      <i class="fa fa-upload"></i>
      Upload
    </div>
    <input class = "§-file" type="file" style="display: none"/>
    <textarea name="<?= $this->getData('nameHtml') ?>" class="form-control §-result"><?= $this->getData('value') ?? '' ?></textarea>

  </div>
</div>






