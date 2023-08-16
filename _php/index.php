<?php

session_start();

require_once __DIR__ . '/vendor/autoload.php';

$uri = explode('?', $_SERVER['REQUEST_URI'], 2)[0];
$uriParts = explode('/', $uri);

if (($uriParts[1] ?? '') == 'service') {
    $request = new \kmucms\routing\BubbleRequest(\kmucms\App::getInstance()->getPaths()->getPhp() . '/web/');

    \kmucms\App::getInstance()->setup('urlinfo', $request);

    if ($request->hasFoundController()) {
        (new \kmucms\uipages\PageWeb(trim(substr($request->getScript(), 0, -4), '/'), [], \kmucms\App::getInstance()->getPaths()->getPhp(), kmucms\App::getInstance()->getDb()))->echoPage();
    }
} else {
    //optimierbar
    $request = new \kmucms\routing\BubbleRequest(\kmucms\App::getInstance()->getPaths()->getPhp() . '/web/');
    \kmucms\App::getInstance()->setup('urlinfo', $request);

    (new \kmucms\uipages\PageWeb(
            trim(substr($request->getScript(), 0, -4), '/'), //'index',
            [],
            \kmucms\App::getInstance()->getPaths()->getPhp(),
            kmucms\App::getInstance()->getDb(),
            ['requestUri'=>$_SERVER['REQUEST_URI']])
    )->echoPage();
}