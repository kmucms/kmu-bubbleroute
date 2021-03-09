
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
$id    = intval($this->getUrlInfo()->getSlugRessort(2) ?? 0);
$this->setData('title', $model['label'] . ': id-' . $id);
$item  = $_REQUEST['item'] ?? ($id > 0 ? $db->getRowById($object, $id) : []);
if(($_REQUEST['submitButton']??'') == 'ok'){
  if($id==0){
    $id = $db->addRow($object, $item);
    $this->redirect('/admin/datapool/item/'.$object.'/'.$id);
  }else{
    $db->updateRow($object, $id, $item);
  }
}
?>

<div class="container">
  <?=
  $this->getComponent('bootstrap/breadcrumb', [
    'crumb'   => [
      'Admin'    => '/admin',
      $model['label'] => '/admin/datapool/table/'.$object,
    ],
    'current' => 'id-' . $id
  ])
  ?>

  <?=
  $this->getComponent('bootstrap/form/form', [
    'fields'        => $dp->getModel()['model']['objects'][$object]['properties'],
    'valueClass'    => 'item',
    'values'        => $item,
    'submitButtons' => ['ok' => ['label' => 'Speichern']],
  ])
  ?>
</div>