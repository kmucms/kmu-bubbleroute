<?php

/** @var \kmucms\uipages\PageTemplate $this */



$yt = '<iframe class=" §-yt "
    width="100%" 
    height="100%" 
    src="' . \kmucms\Format::getYouTubeEmbedLink($this->getValue('link')) . '"
    title="YouTube video player" 
    frameborder="0" 
    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
    allowfullscreen
    ></iframe>';
?>



<div class="§-" data-yt="<?= htmlspecialchars($yt) ?>">
    <div class="§-container  rounded overflow-hidden shadow">
        <div class="§-cover" style="background-image: url('<?= empty($this->getValue('img')) ? '/img.png' : $this->getValue('img') ?>')">
            <div class="§-center">
                <div><i class="bi bi-play-btn-fill §-icon"></i></div>
                <div><?=\kmucms\Format::getYouTubeType($this->getValue('videoUrl'))?></div>
            </div>
        </div>
    </div>
</div>

<?= $this->getButton('link,img') ?>
