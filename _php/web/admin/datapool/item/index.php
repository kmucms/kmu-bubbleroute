
<?php
/** @var \kmucms\uipages\PageWeb $this */
$this->setPageEnvelope('admin');

$this->setData('title', 'DataPool');

$dp = \kmucms\datapool\DataPool::getInstance();
$db = $dp->getDb();

$object = $this->getUrlInfo()->getSlugRessort(1);

if(!$dp->hasObject($object)){
  exit;
}
$model = $dp->getObjectModel($object);
$id    = intval($this->getUrlInfo()->getSlugRessort(2)??0);
$this->setData('title', $model['label'].': id-'.$id);
$item  = $_REQUEST['item'] ?? ($id>0? $db->getRowById($object, $id):[]);
?>

<div class="container">
  <?=
  $this->getComponent('bootstrap/form/form', [
    'fields'        => $dp->getModel()['model']['objects'][$object]['properties'],
    'valueClass'    => 'item',
    'values'        => $item,
    'submitButtons' => ['ok' => ['label' => 'Speichern']],
  ])
  ?>
</div>