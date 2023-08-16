<?php
/** @var \kmucms\uipages\PageWeb $this */
$this->setEnvelope('kmucms/index');

$this->initValue('page-' . \kmucms\App::getInstance()->getUrlInfo()->getRessort(2));

$this->setData('title', 'Startseite');


?>

<div class="container">
  <h2> Unterbereiche</h2>
  <?= $this->getValue('regions') ?? '' ?>
  <?= $this->getTemplate('regionsSub', 'kmucms/regions', ['regions'=>$this->getValue('regions') ?? '']); ?>
  <?= $this->getButton('regions,nav') ?>
</div>


<div class="container">
  <h2> Globals</h2>
  <?= kmucms\App::getInstance()->getGlobalVars()->getValue('test') ?><?= kmucms\App::getInstance()->getGlobalVars()->getButton('test') ?>
</div>

<div class="container">
  <h2> url-Info</h2>
  <?= \kmucms\App::getInstance()->getUrlInfo()->getRessort(2) ?>

</div>


<div class="container">
  <h2> Vareablen</h2>
  <div>
    <?= $this->getValue('name') ?? 'irgendwas' ?>
    <?= $this->getButton('name,cde,efg') ?>
  </div>
</div>

<div class="container §-red">
  <h2> Klassenbezeichnungen</h2>
  hallo leute22 §- 
</div>

<div class="container">
  <h2> Subtemplates</h2>
  <?= $this->getTemplate('nametemplate', 'test/text', ['data']); ?>
  <?= $this->getTemplate('nametemplatedos', 'test/text', ['data']); ?>
</div>
