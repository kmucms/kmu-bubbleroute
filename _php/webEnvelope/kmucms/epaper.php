<?php
/** @var kmucms\uipages\PageEnvelope $this */
/*
if(!isset($_COOKIE['epaper_legal'])){
  $_SESSION['backurl'] = $_SERVER['REQUEST_URI'];
  $this->redirect('/cookiemonster');
}
 * 
 */

$this->setEnvelope('kmucms/index');
$this->js->addPaths([
  '/files/node_modules/prismjs/prism.min.js',
]);
$this->css->addPaths([
  '/files/node_modules/prismjs/themes/prism-coy.css'
]);
?>


<?=$this->getData('content')?>

