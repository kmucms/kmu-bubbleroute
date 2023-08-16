<?php

return [
  'fields'        => [
    'name'   => [
      'label'     => 'Name',
      'type'      => 'input',
      'mandatory' => 1,
    ],
    'description' => [
      'label'     => 'Stellen Sie Sich kurz vor',
      'type'      => 'textarea',
      'mandatory' => 0,
    ],
    /*
      'info1'         => [
      'label' => 'Möchten Sie gefunden werden als:',
      'type'  => 'info',
      ],
      'idancehobby'   => [
      'label' => 'Hobby/Gelegenheitstänzer',
      'type'  => 'checkbox',
      ],
      'idanceprof'    => [
      'label' => 'Showtänzer',
      'type'  => 'checkbox',
      ],
      'idomusic'      => [
      'label' => 'Musiker',
      'type'  => 'checkbox',
      ],
      'ising'         => [
      'label' => 'Sänger',
      'type'  => 'checkbox',
      ],
      'iedj'          => [
      'label' => 'DJ',
      'type'  => 'checkbox',
      ],
      'ieventmanager' => [
      'label' => 'Events/Parties Veranstalter',
      'type'  => 'checkbox',
      ],
      'ieventhelper'  => [
      'label' => 'Events/Parties Aushilfe',
      'type'  => 'checkbox',
      ],
      'city'          => [
      'label'     => 'Aufenthaltsort / näherste Großstadt',
      'type'      => 'input',
      'mandatory' => 1,
      ],
     */
    'password'    => [
      'label'     => 'Passwort (nicht öffentlich)',
      'type'      => 'input',
      'mandatory' => 1,
      'default'   => '',
    ],
  ],
  'valueClass'    => 'item',
  'submitButtons' => ['ok' => ['label' => 'Speichern']],
];
