<?php
/** @var \kmucms\uipages\PageWeb $this */
$this->setEnvelope('kmucms/index');
$this->setData('title', 'Cookies');
$this->setData('description', 'Cookies auf /epaper/* Unterseiten.');
if(isset($_POST['setzen'])){
  setcookie("epaper_legal", "confirmed", [
    'expires' => strtotime('+60 days'),
    'path'    => '/docs/',
  ]);
  if(isset($_SESSION['backurl'])){
    $this->redirect($_SESSION['backurl']);
  }
}
?>

<div class="container">
  <p>Diese Seite verwendet Cookies.</p> 
  <p>Es gibt einen seiteneigenen Cookie, der sich merkt, ob Sie Cookies mögen.</p>
  <p>Und es gibt Cookies von folgenden Anbietern:</p>
  <ul>
    <li></li>
  </ul>
  <p>
    In Klammern steht, wozu die Cookies auf dieser Seite plaziert sind.
    Was die Fremdanbieter mit den Cookies machen wissen nur die Fremdabieter.
  </p>
  <?php if(!isset($_COOKIE['epaper_legal']) && !isset($_POST['setzen'])): ?>
    <form method="post">
      <button class="btn btn-primary" name="setzen" value="1">
        Ich habe verstanden, dass Cookies plaziert werden.
      </button>
    </form>
  <?php else: ?>
    <p>
      <i class="bi-check2-circle"></i> Ich habe verstanden, dass Cookies plaziert werden.
    </p>
  <?php endif; ?>
</div>

