<?php
/** @var \kmucms\uipages\PageWeb $this */
$ressort = $this->getUrlInfo()->getRessort(1);
$dp      = kmucms\datapool\DataPool::getInstance();
if($dp->hasObject($ressort)){
  var_dump($dp->getObjectModel($ressort));
  var_dump($this->getUrlInfo()->getRessort(2));
  exit;
}

$this->setPageEnvelope('index');
$this->setData('title', 'Homepage');
?>

<div class="container mb-5">

  <h2>
    Hallo world, hallo peopple.
  </h2>

</div>