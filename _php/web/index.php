<?php
/** @var \kmucms\uipages\PageWeb $this */
$this->setPageEnvelope('index');
$this->setData('title', 'meintitel');
?>

<?= ''//$this->initVar('abc'); ?>
<?= ''//$this->getVarValue('xxx') ?? 'default' ?>
<?= ''//$this->getVarButton('some label', 'xxx,yyy,ef'); ?>
<?= ''// $this->getVarWidget('krabbe', 'my/widget'); ?>
<?= ''//$this->getComponent('test/me')?>


<div class="container mb-5">
  <pre>

  <?php
  $ressort = $this->getUrlInfo()->getRessort(1);
  $dp      = kmucms\datapool\DataPool::getInstance();
  if($dp->hasObject($ressort)){
    var_dump($dp->getObjectModel($ressort));
    var_dump($this->getUrlInfo()->getRessort(2));
  }else{
    echo 'seite nicht gefunden.';
  }
  ?>

 </pre>




</div>