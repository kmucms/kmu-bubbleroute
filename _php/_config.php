<?php

//class => [values]

$phpPath  = __DIR__;
$rootPath = dirname(__DIR__);

return [
  'global' => [
  ],
  'class'  => [
    \kmucms\routing\BubbleRequest::class => [
      'webPath' => $phpPath . '/web',
    ],
    \kmucms\uipages\common\APage::class  => [
      'templatePath' => [
        'web'       => $phpPath . '/web',
        'envelope'  => $phpPath . '/webEnvelope',
        'component' => $phpPath . '/webComponent',
      ],
    ],
    kmucms\adminuser\AdminUser::class    => [
      'name'     => 'admin',
      'password' => 'admin',
    ],
    kmucms\files\FilesRuntimeData::class => [
      'pathRuntimeData' => $rootPath . '/_runtime/data/class',
    ],
    kmucms\files\FilesRuntimeWeb::class  => [
      'pathRuntimeWeb' => $rootPath . '/_runtime/web/runtime/class',
      'webUriPrefix'   => '/runtime/class',
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


