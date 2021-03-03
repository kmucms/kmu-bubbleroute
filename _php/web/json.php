<?php

/** @var kmucms\easy\Page $this */
$this->setPageEnvelope('_json');
$this->setData('title', 'meintitel');


echo json_encode([
  'bla'  => 'bla',
  'blub' => 'blub',
]);

?>
