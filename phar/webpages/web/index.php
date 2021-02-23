<?php
/** @var \kmucms\uipages\PageWeb $this */
$this->setPageEnvelope('index');
$this->setData('title', 'meintitel');
?>

<?= ''//$this->initVar('abc'); ?>
<?= ''//$this->getVarValue('xxx') ?? 'default' ?>
<?= ''//$this->getVarButton('some label', 'xxx,yyy,ef'); ?>
<?= ''// $this->getVarWidget('krabbe', 'my/widget'); ?>

<div class="container mb-5">
  some content <?=$this->getUrlInfo()->getRessort(1)?>
  
  <?= ''//$this->getComponent('test/me')?>
  
</div>