<?php

/** @var \kmucms\uipages\PageTemplate $this */
$regions = json_decode($this->getData('regions') ?? '[]', true)??[];
?>


<?php foreach ($regions as $reg): ?>
 <div class="my-5">
  <?= $this->getTemplate($reg['id'], $reg['templateid']) ?>
</div>
<?php endforeach; ?>
  