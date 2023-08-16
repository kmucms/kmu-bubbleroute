<?php

return [
  'fields' => [
    'email' => [
      'label' => 'E-Mail (nicht öffentlich)',
      'type' => 'input',
      'mandatory' => 1,
    ],
    'name' => [
      'label' => 'Vorname oder "Künstlername" (wird allen angezeigt)',
      'type' => 'input',
      'mandatory' => 1,
    ],
    'agb' => [
      'label' => 'Ich habe die <a href="/info/agbRegister" target="_blank">Registrierungsregeln</a>\'s gelesen und bin damit einverstanden.',
      'type' => 'checkbox',
      'mandatory' => 1,
    ],
    'info2' => [
      'label' => 'Nach dem Absender der Registrierung erhalten sie eine Mail mit Bestätigungslink. '
      . 'Rufen Sie diesen auf um die Registrierung abzuschließen.',
      'type' => 'info',
    ],
  ],
  'valueClass' => 'item',
  'submitButtons' => ['ok' => ['label' => 'Registrieren']],
];
