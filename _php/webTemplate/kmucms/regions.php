<?php

/** @var \kmucms\uipages\PageTemplate $this */
$regions = json_decode($this->getData('regions') ?? '[]', true)??[];
?>


<?php foreach ($regions as $reg): ?>
  <?= $this->getTemplate($reg['id'], $reg['templateid']) ?>
<?php endforeach; ?>
  