<?php
/** @var \kmucms\uipages\PageWeb $this */
$this->setEnvelope('kmucms/index');
$this->setData('title', 'Registrierung');

$item = $_REQUEST['item'] ?? [];
$submitButton = $_REQUEST['submitButton'] ?? '';

$formData = require 'index.form.php';

$errorMsg = '';
if ($submitButton == 'ok') {
    $person = kmucms\App::getInstance()->getPersonUser();
    if ($item['agb'] != 1) {
        $errorMsg .= 'Registrierungsregeln unbestätigt. ';
    } else {
        $agb = $item['agb'];
        unset($item['agb']);
        $p = $person->addPerson($item);
        $item['agb'] = $agb;
        $errorMsg .= $p['error'] ?? '';
        if ($errorMsg === '') {
            $mail = \kmucms\App::getInstance()->getEmail();
            $subject = 'Registrierung auf: ' . $_SERVER['HTTP_HOST'];
            $link = $_SERVER['HTTP_ORIGIN'] . '/service/person/changepw?token=' . $p['registertoken'] . '&name=' . $p['name'];
      $message = "Guten Tag,\n\nSie haben sich bei " . $_SERVER['HTTP_HOST'] . " registriert.\n"
                    . "Um die Registrierung abzuschließen, rufen Sie folgenden Link in Ihrem Browser auf: \n\n  " . $link;
            $mail->submit($p['email'], $subject, $message);
        }
    }
}
?>

<div class="container">
  <?php if ($submitButton == 'ok' && $errorMsg == ''): ?>
    Ihnen wurde eine E-Mail geschickt. Klicken Sie auf den Beschtätigungslink in der E-Mail um die Registrierung abzuschließen.
    <?php else: ?>
          <?php if ($errorMsg != ''): ?>
            <div class="alert alert-danger"><?= $errorMsg ?></div>
          <?php endif; ?>
        <?= $this->getComponent('kmucms/bootstrap/form/form', ['values' => $item,] + $formData) ?>
    <?php endif; ?>
</div>

<div class="container mt-5 text-center">
    <div class="mt-5 p-3 border bg-white rounded col-lg-6 col-md-8 mx-auto">   
        <a class="btn btn-primary" href="/service/person/login">Zum Login</a>
    </div>
</div>