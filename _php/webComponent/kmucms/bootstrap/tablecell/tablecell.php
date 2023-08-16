<?php
/** @var kmucms\uipages\PageComponent $this */
$field = $this->getData('field') ?? [];

$value = $this->getData('value') ?? '';
?>

<div class="mb-2">
  <?php
  $compName = 'kmucms/bootstrap/tablecell/items/' . $field['type'];
  if (!$this->isComponent($compName)) {
    $compName = 'kmucms/bootstrap/tablecell/items/input';
  }
  echo $this->getComponent($compName, [
    'value' => $value ?? ($field['default'] ?? ''),
    ] + $field)
  ?>
</div>