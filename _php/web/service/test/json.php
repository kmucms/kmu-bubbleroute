<?php

/** @var kmucms\easy\Page $this */
$this->setEnvelope('_json');
$this->setData('title', 'meintitel');


echo json_encode([
  'bla'  => 'bla',
  'blub' => 'blub',
]);

?>
