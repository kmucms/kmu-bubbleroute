<?php

session_start();

require_once __DIR__ . '/vendor/autoload.php';

kmucms\config\Config::init(__DIR__ . '/_config.php');

/*
$request = ClassRequest::getInstance();

if($request->hasFoundController()){
  (new ClassRequest)->echoPage($request->getClass(), $request->getMethod(), $request->getParameter());
}
 * 
 */

$request = \kmucms\routing\BubbleRequest::getInstance();

if($request->hasFoundController()){
  (new \kmucms\uipages\PageWeb($request->getScriptId()))->echoPage();
}
