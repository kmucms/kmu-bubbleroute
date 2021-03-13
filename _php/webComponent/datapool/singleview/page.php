<?php
/** @var \kmucms\uipages\PageComponent $this */
?>

<div class="container">
  <?= (new Parsedown())->text($this->getData('data'));?>
</div>