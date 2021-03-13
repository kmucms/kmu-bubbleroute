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
$this->setData('title', 'DataPool: ' . $model['label']);
?>

<div class="container">
  <a href="/admin/datapool/item/<?= $object ?>" class="btn btn-primary">Neu</a>
</div>

<div class="text-center">
  <table class="mx-auto">
    <tr><th>id</th><th>Titel</th><th>Beschreibung</th></tr>
    <?php foreach($db->getRows("select * from $object ") as $obj): ?>
      <tr>
        <td>
          <a href="/admin/datapool/item/<?= $object ?>/<?= $obj['id'] ?>" class="btn btn-primary"><?= $obj['id'] ?></a>
        </td>
        <td><?= $obj['title'] ?></td>
        <td><?= $obj['description'] ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</div>