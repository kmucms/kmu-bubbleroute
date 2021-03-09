<?php

function htaccessEchoFile($file){
  $ext  = strtolower(pathinfo($file, PATHINFO_EXTENSION));
  //https://developer.mozilla.org/en-US/docs/Web/HTTP/Basics_of_HTTP/MIME_types/Common_types
  $mime = [
    'css' => 'text/css',
    'js'  => 'text/javascript',
    'jpg' => 'image/jpg',
    'png' => 'image/png',
    'txt' => 'text/plain',
    'ico' => 'image/x-icon',
    'svg' => 'image/svg+xml',
  ];
  // $fp = fopen($file, 'rb');
  header('Content-Length: ' . filesize($file));
  header('Content-Type: ' . ($mime[$ext] ?? 'application/octet-stream') . '', true);
  // fpassthru($fp);
  ob_clean();
  readfile($file);
  exit;
}

$url         = explode('?', filter_input(INPUT_SERVER, 'REQUEST_URI'), 2)[0];
$urlRessorts = explode('/', $url);
$urlRessort1 = $urlRessorts[1] ?? '';
$ext         = strtolower(pathinfo($url, PATHINFO_EXTENSION));
$dir         = __DIR__;


if($ext != 'php'){
  $file = $dir . '/_runtime/web' . $url;
  if(is_file($file)){
    htaccessEchoFile($file);
  }
  $file = $dir . '/_files/web' . $url;
  if(is_file($file)){
    htaccessEchoFile($file);
  }
  // /phar/webpages/web
}


require_once $dir . '/index.php';
