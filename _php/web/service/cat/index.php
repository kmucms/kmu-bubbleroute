<?php
/** @var \kmucms\uipages\PageWeb $this */
$this->setEnvelope('kmucms/index');

$app = kmucms\App::getInstance();
$urlInfo = $app->getUrlInfo();
$object = $urlInfo->getSlugRessort(1);

$id = intval($urlInfo->getSlugRessort(2));

$modelObjects = $app->getDbModel()['model']['objects'];

$model = $app->getDbModel()['model']['objects'][$object] ?? null;

$stat = 'none';
$row = [];
if ($model !== null) {
  $stat = 'cat';
  if ($id > 0) {
    $row = $app->getDb()->getRowById($object, $id); //object is in model, id is int
    if (count($row) > 0) {
      $stat = 'obj';
    }
  }
}
?>

<?php if ($stat === 'none'): ?>
  <div class="container">
    <div class="list-group">
      <?php foreach ($modelObjects as $k => $v): ?>
        <?php if ($v['attributes']['main'] ?? false): ?>
          <a class="list-group-item list-group-item-action" href="<?= $app->getUrlInfo()->getCurrentUri() . '/' . $k ?>"><i class="<?= $v['icon'] ?>"></i> <?= $v['label'] ?></a>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
<?php endif; ?>

<?php if ($stat === 'cat'): ?>
  <div class="container" style="max-width: 800px;">
    <?php if ($app->getPersonAdmin()->isEditMode()): ?>
      <div class="text-center mb-5">

        <a class="btn btn-secondary" href="/service/admin/be/datatable/item/<?= $object ?>"><i class="bi bi-pencil"></i> Neu</a>
      </div>
    <?php endif; ?>
    <?php
    $this->setData('title', $model['label']);

    $count = $app->getDb()->getRowsCount($object);
    $page = $_GET['page'] ?? 1;
    $limit = 30;
    $offset = ($page - 1) * $limit;
    $pagesCount = ceil($count / $limit);
    $cond = "active='1'";
    if($app->getPersonAdmin()->isLoggedIn()){
      $cond = '';
    }
    $items = $app->getDb()->getRowsByCondition($object, $cond, [], $offset, $limit, [], 'date desc');
    ?>
    <?php foreach ($items as $v): ?>
      <div class="card shadow mb-3 text-decoration-none" >
        <div class="row g-0">
          <div class="col-md-4 text-center">
            <?= kmucms\Format::getImage($v['img']) ?>
            <!--img src="<?= empty($v['img']) ? '/img.png' : $v['img'] ?>" class="img-fluid rounded-start" style="<?= empty($v['img']) ? 'opacity:0.15' : '' ?>"-->
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <?php if (!empty($v['url'] ?? '')): ?>
                <a href="<?= $v['url'] ?>" class="btn <?=$v['active']==1?'btn-secondary':'btn-warning'?> stretched-link float-end"><i class="fa  fa-arrow-right "></i></a>
              <?php endif; ?>
              <h5 class="card-title"><?= $v['title'] ?></h5>
              <p class="card-text"><?= nl2br($v['description']) ?></p>
              <?php if ($app->getPersonAdmin()->isEditMode()): ?>
                <p class="card-text"><a class="" href="/service/admin/be/datatable/item/<?= $object ?>/<?= $v['id'] ?>"><i class="bi bi-pencil"></i></a></p>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="card-footer text-muted">
          <div class="text-muted text-center">
            <time><?= $v['date'] ?></time>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
    <?= $this->getComponent('kmucms/bootstrap/pager', ['page' => $page, 'pagesCount' => $pagesCount]) ?>
  </div>
<?php endif; ?>

<?php if ($stat === 'obj'): ?>
  <div class="container">Todo: item anzeigen</div>
<?php endif; ?>
