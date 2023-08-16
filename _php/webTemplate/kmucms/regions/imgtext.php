<?php
/** @var \kmucms\uipages\PageTemplate $this */
$temp_buttons = json_decode($this->getValue('links'), true) ?? [];
?>


<div class="row  <?= $this->getValue('align') == 'right' ? 'flex-row-reverse' : '' ?> ">
  <div class="col-lg text-center">
    <img class="img-fluid" src="<?= empty($this->getValue('img')) ? '/img.png' : $this->getValue('img') ?>" />
  </div>
  <div class="col-lg  align-self-center">
    <h3 class="text-center"><?= $this->getValue('title') ?? '' ?></h3>
    <div><?= nl2br($this->getValue('text')) ?></div>
    <?php if (count($temp_buttons) > 0): ?>
    <div class="text-center">
        <div class="btn-group-vertical mt-3">
          <?php foreach ($temp_buttons as $link): ?>
            <a href="<?= $link['url'] ?>" class="btn btn-primary">
                  <?= $link['label'] ?> <i class="fa fa-arrow-right ms-3 "></i>
                </a>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endif; ?>

    <?= $this->getButton('title,text,img,align,links') ?>
  </div>
</div>