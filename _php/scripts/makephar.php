<?php
$phar = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, dirname(__DIR__, 2) . '/app.phar');
$srcDir = str_replace(['/', '\\'], '/', dirname(__DIR__, 2) . '/_php/');

$ph = new \Phar($phar);
//$ph->startBuffering();
$ph->buildFromDirectory($srcDir);
//$ph->stopBuffering();

