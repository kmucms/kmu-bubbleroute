<?php
/** @var \kmucms\uipages\PageComponent $this */
?>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <?php foreach($this->getData('crumb') as $k => $v): ?>
      <li class="breadcrumb-item"><a href="<?= $v ?>"><?= $k ?></a></li>
    <?php endforeach; ?>
    <?php if($this->getData('current')): ?> 
      <li class="breadcrumb-item active" aria-current="page"> <?= $this->getData('current') ?> </li>
      <?php endif; ?>
  </ol>
</nav>