<?php

$ti = new \kmucms\uipages\TraceIt();
$ti->setAll(['bingo'=>'bongo','rg1'=>['duck'=>'bert']]);


?>


<div>
  bla
</div>
<div>
  blub: <?=$ti->getVar('bingo')?>
</div>
<div>
  <?php $ti->regionEnter('rg1') ?>
  region rg1 <?= $ti->getVar('duck') ?>
  <div>
    <?php $ti->regionEnter('rg3') ?>
    edit: <?=$ti->getPath()?> <?=$ti->getButton('beng')?>
     <?php $ti->regionExit() ?>
  </div>
  <?php $ti->regionExit() ?>
</div>