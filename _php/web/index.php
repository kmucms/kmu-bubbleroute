<?php
/** @var \kmucms\uipages\PageWeb $this */
$ressort = $this->getUrlInfo()->getRessort(1);
$dp      = kmucms\datapool\DataPool::getInstance();
if($dp->hasObject($ressort)){
  $slug = $this->getUrlInfo()->getRessort(2);
  $row  = $dp->getObjectBySlug($ressort, $slug);
  $this->setPageEnvelope('index');
  if($this->isComponent('datapool/singleview/' . $ressort)){
    echo $this->getComponent('datapool/singleview/' . $ressort, $row, $dp->getObjectModel($ressort));
  }else{
    echo($row['data']);
  }
  $this->setDataAll($row);
  return;
}

$this->setPageEnvelope('index');
$this->setData('title', 'Homepage');
?>

<div class="container mb-5">

  <h2>
    Hallo world, hallo peopple.
  </h2>

</div>