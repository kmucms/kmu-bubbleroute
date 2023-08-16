<?php /** @var kmucms\uipages\PageComponent $this */ ?>
<div  class="form-group  §-" data-upload="/service/admin/be/img/upload">
  <label><?= $this->getData('label') ?? '' ?><?= ($this->getData('mandatory') ?? 0) ? '*' : '' ?></label>
  <div>
    <img class = "§-img" src="<?= $this->getData('value') ?>" style="max-width: 200px; max-height: 200px;"/>
    <div class="btn btn-primary §-upload">
      <i class="fa fa-upload"></i>
      Upload
    </div>
    <input class = "§-file" type="file" style="display: none"/>
    <input name="<?= $this->getData('nameHtml') ?>" class="form-control §-result" value="<?= $this->getData('value') ?? '' ?>"/>

  </div>
</div>






