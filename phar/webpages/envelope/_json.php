
<?php

/** @var kmucms\easy\PageEnvelope $this */

header('Content-Type: application/json');
echo $this->getData('content');
?>

