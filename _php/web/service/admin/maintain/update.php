<?php
$done = kmucms\App::getInstance()->getPersonAdmin()->setup();
if (!$done) {
  //do install
}
kmucms\App::getInstance()->getUpdate()->go();
?>

OK
