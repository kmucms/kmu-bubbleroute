<?php

/** @var \kmucms\uipages\PageTemplate $this */
//src="https://www.youtube.com/embed/kj3eYq4Pja4"



$yt = '<iframe class=" §-yt "
    width="100%" 
    height="100%" 
    src="' . \kmucms\Format::getYouTubeEmbedLink($this->getValue('link')) . '"
    title="YouTube video player" 
    frameborder="0" 
    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
    allowfullscreen
    rel="0"
    ></iframe>';

?>




<div class="row  <?= $this->getValue('align') == 'right' ? 'flex-row-reverse' : '' ?> ">
    <div class="col-lg text-center">
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
    </div>
    <div class="col-lg  align-self-center">
        <h3 class="text-center"><?= $this->getValue('title')??'' ?></h3>
        <?= nl2br($this->getValue('text')) ?>
        <?= $this->getButton('title,text,img,link,align') ?>
    </div>
</div>