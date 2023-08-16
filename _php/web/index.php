<?php
/** @var \kmucms\uipages\PageWeb $this */
$this->setEnvelope('kmucms/index');

$db = kmucms\App::getInstance()->getDb();


$activeCond = '';
if (!\kmucms\App::getInstance()->getPersonAdmin()->isLoggedIn()) {
  $activeCond = 'active=1 and';
}
$page = $db->getRowByCondition("page", "$activeCond url=:url", ['url'=>kmucms\App::getInstance()->getUrlInfo()->getUri()]);
if (count($page??[]) < 1) {
  if (kmucms\App::getInstance()->getPersonAdmin()->isEditMode()) {
    $par = [
      "item" => [
        "url" => kmucms\App::getInstance()->getUrlInfo()->getUri()
      ]
    ];
    $this->redirect('/service/admin/be/datatable/newmain/?' . http_build_query($par));
  }
  $page = $db->getRow('select * from page where active=1 order by url asc limit 1');
}

$this->setDataAll($page);
$this->setData('canonical', $page['url']);
if (kmucms\App::getInstance()->getPersonAdmin()->isEditMode()) {
  $this->setData('editButton', '<a class="edit_button" href="/service/admin/be/datatable/item/page/' . $page['id'] . '">&#128397;</a>');
}

$this->initValue('page-' . $page['id']);
?>

<div class="container">
  <?= $this->getButton('regions', 'Bereiche') ?>
  <?= $this->getTemplate('regionsSub', 'kmucms/regionsDist', ['regions' => $this->getValue('regions') ?? '']); ?>
  <?= empty($this->getValue('regions')) ? '' : $this->getButton('regions', 'Bereiche') ?>
</div>


