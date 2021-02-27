<?php
/** @var \kmucms\uipages\PageWeb $this */
$this->setPageEnvelope();

$this->setData('title', 'DataPool');

?>

<div class="container">
  <div class="list-group">
    <a href="/admin/datapool/edit/mainobj" class="list-group-item list-group-item-action">
      <i class="bi-square mr-3"></i> Hauptobjekte (kriegen eine volle Seite mit Titel, Beschreibung, ...)
    </a>
    <a href="#" class="list-group-item list-group-item-action">
      <i class="bi-grid mr-3"></i> Hilfsobjekte
    </a>
    <a href="#" class="list-group-item list-group-item-action">
      <i class="bi-list-ul mr-3"></i> Auswahlfelder
    </a>
  </div>
</div>