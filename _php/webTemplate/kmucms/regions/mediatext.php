<?php
/** @var \kmucms\uipages\PageTemplate $this */
$temp_buttons = json_decode($this->getValue('links'), true) ?? [];

$yt = '<iframe class=" §-yt "
    width="100%"
    height="100%"
    src="' . \kmucms\Format::getYouTubeEmbedLink($this->getValue('videoUrl')) . '"
    title="YouTube video player"
    frameborder="0"
    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
    allowfullscreen
    rel="0"
    ></iframe>';


?>


<div class="row  <?= $this->getValue('align') == 'right' ? 'flex-row-reverse' : '' ?> ">
  <div class="col-lg text-center">
    <?php if (trim($this->getValue('videoUrl')) == ''): ?>
      <img class="img-fluid" src="<?= empty($this->getValue('img')) ? '/img.png' : $this->getValue('img') ?>" />
    <?php else: ?>
      <div class="§-area rounded overflow-hidden shadow" data-yt="<?= htmlspecialchars($yt) ?>">
        <div class="§-container">
          <div class="§-cover" style="background-image: url('<?= empty($this->getValue('img')) ? '/img.png' : $this->getValue('img') ?>')">
            <div class="§-center">
              <div><i class="bi bi-play-btn-fill §-icon"></i></div>
              <div><?=\kmucms\Format::getYouTubeType($this->getValue('videoUrl'))?></div>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
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

    <?= $this->getButton('title,text,img,videoUrl,align,links') ?>
  </div>
</div>