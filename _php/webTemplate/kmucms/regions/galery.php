<?php
/** @var \kmucms\uipages\PageTemplate $this */
$this->js->addPath('/files/node_modules/@splidejs/splide/dist/js/splide.min.js');
$this->css->addPath('/files/node_modules/@splidejs/splide/dist/css/splide.min.css');
?>

<div> 
    <?= $this->getValue('text') ?> 
</div>


<section class="splide §- shadow mx-auto p-2"  >
    <div class="splide__track">
        <ul class="splide__list">
            <?php foreach (explode("\n", $this->getValue('imgs')) as $k => $url): ?>
                <li class="splide__slide">
                    <div class="splide__slide__container §-img" style="background-image: url(<?= $url ?>);">
                        <!--img src="<?= $url ?>" -->
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="splide__arrows splide__arrows--ltr">
        <button class="splide__arrow splide__arrow--prev" type="button" aria-label="Previous slide" >
            <i class="fa fa-arrow-left"></i>
        </button>
        <button class="splide__arrow splide__arrow--next" type="button" aria-label="Next slide" >
            <i class="fa fa-arrow-right "></i>
        </button>
    </div>
</section>




<?= $this->getButton('text,imgs') ?>
