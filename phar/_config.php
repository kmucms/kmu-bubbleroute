<?php

//class => [values]

$pharPath = __DIR__;
$rootPath = dirname(__DIR__);

return [
  'global' => [
  ],
  'class'  => [
    \kmucms\routing\BubbleRequest::class => [
      'webPath' => $pharPath . '/webpages/web',
    ],
    \kmucms\uipages\common\APage::class  => [
      'templatePath' => $pharPath . '/webpages',
    ],
    kmucms\adminuser\AdminUser::class    => [
      'name'     => 'admin',
      'password' => 'admin',
    ],
    kmucms\files\FilesRuntimeData::class => [
      'pathRuntimeData' => $rootPath . '/_runtime/data/class',
    ],
    kmucms\files\FilesRuntimeWeb::class  => [
      'pathRuntimeWeb' => $rootPath . '/_runtime/web/file/class',
      'webUriPrefix'   => $rootPath . '/file/class',
    ],
    \kmucms\datapool\DataPool::class     => [
      'propertyTypes' => [
        'email',
        'password',
        'hidden',
        'string',
        'checkbox',
        'color',
        'date',
        'html',
        'icon',
        'info',
        'textarea',
        'select',
        'rte',
        'img',
      ],
    ],
  ],
];


