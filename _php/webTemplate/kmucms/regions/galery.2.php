<?php
/** @var \kmucms\uipages\PageTemplate $this */
$this->js->addPath('/files/node_modules/bootstrap/dist/js/bootstrap.min.js');
?>

<div>
    <?= $this->getValue('text') ?> 
</div>




<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">

    <div class="carousel-inner" style="max-height: 500px;">


        <?php foreach (explode("\n", $this->getValue('imgs')) as $k=> $url): ?>
            <div class="carousel-item <?=$k==0?'active':''?> ">
                <img src="<?= $url ?>" class="d-block w-100" style=" background-size: cover; background-position: center; ">
            </div>
        <?php endforeach; ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>



<?= $this->getButton('text,imgs') ?>
