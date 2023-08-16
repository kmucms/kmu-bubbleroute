<?php
/** @var kmucms\uipages\PageEnvelope $this */
$admin = kmucms\App::getInstance()->getPersonAdmin();
$globals = \kmucms\App::getInstance()->getGlobalVars();
?>


<!doctype html>
<html lang="<?= $this->getData('language') ?? 'de' ?>">
  <head>

    <!-- Seo -->
    <title><?= strip_tags($this->getData('title') ?? '') ?></title>
    <meta name="description" content="<?= $this->getData('description') ?? '' ?>">
    <meta name="author" content="<?= $this->getData('author') ?? '' ?>">
    <link rel="canonical" href="<?= $this->getData('canonical') ?? '' ?>">
    <meta name="keywords" content="<?= $this->getData('keywords') ?? '' ?>">

    <!-- Favicons -->
    <link rel="icon" href="/files/kmucms/img/favicon/favicon.png">

    <!-- tech -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link href="/files/node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- link href="/files/node_modules/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" -->
    <link href="/files/node_modules/font-awesome/css/font-awesome.min.css" rel="stylesheet">

  </head>
  <body class="bg-dark">

    <nav>
      <div class="navbar ">
        <div class="container">
          <div>
            <a href="/" class="navbar-brand d-flex align-items-center mr-3">
              <img src="/files/kmucms/img/favicon/favicon.png" style="max-width: 32px; max-height: 32px;"/>
            </a>
          </div>

          <div class="d-flex">
            <div>
              <?php
              $nav = json_decode(\kmucms\App::getInstance()->getGlobalVars()->getValue('nav') ?? '[]', true);
              ?>
              <?php foreach ($nav as $n): ?>
              <a href="<?= $n['url'] ?>" class="btn btn-dark"><?= $n['label'] ?></a>
              <?php endforeach; ?>
              <?= \kmucms\App::getInstance()->getGlobalVars()->getButton('nav', 'Menu') ?>
              <?php if ($admin->isLoggedIn()): ?>
                  <span class="btn-group">
                    <a class="btn btn-dark" href="/service/admin/be/template/toggleedit?backurl=<?= $_SERVER['REQUEST_URI'] ?>" title="Vorschau"><i class="fa fa-pencil-square<?= !$admin->isEditMode() ? '-o' : '' ?>"></i></a>
                      <a class="btn btn-dark" href="/service/admin/be" title="Admin"><i class="fa fa-user"></i></a>
                    <a class="btn btn-dark" href="/service/person/logout" title="logout"><i class="fa fa-key"></i></a>
                  </span>
                <?php endif; ?>
            </div>

            <?php //if(\kmucms\person\PersonFe::getInstance()->isLoggedIn()): ?>
  <!--               <a class="btn btn-secondary rounded-circle nav-link" href="/cms/event"><i class="bi-calendar-check-fill"></i></a>   -->
            <?php //endif; ?>
  <!--  a class="btn btn-secondary rounded-circle nav-link" href="/kmucms/login/me"><i class="bi-person-fill"></i></a-->  
          </div>
        </div>
      </div>
    </nav>


    <main>

      <header class="py-5 text-center container text-light">
        <div class="row py-lg-5">
          <div class="col-lg-6 col-md-8 mx-auto">
            <?php if ($this->getData('img') != ''): ?>
              <?= kmucms\Format::getImage($this->getData('img')) ?>
            <?php endif; ?>
            <h1 class="fw-light"><?= $this->getData('title') ?></h1>
            <p class="lead §-lead"><?= $this->getData('description') ?? '' ?></p>
            <?= $this->getData('editButton') ?>
          </div>
        </div>
      </header>

      <div class="§-mainarea bg-light py-5 mb-5" >
        <div class="container">
          <?php if (!empty($globals->getValue('alert'))): ?>
          <div class="alert alert-primary text-center" role="alert">
              <?= $globals->getValue('alert') ?>
            </div>
          <?php endif; ?>
          <?= $globals->getButton('alert', 'Eilmeldung') ?>
        </div>
        <?= $this->getData('content') ?>
      </div>



      <!-- FOOTER -->
      <footer class="container">
        <div class="float-end"><a class="text-decoration-none btn btn-secondary" href="#" title="Zum Seitenanfang"><i class="fa fa-arrow-up"></i></a></div>
        <p>
          <?= nl2br(\kmucms\App::getInstance()->getGlobalVars()->getValue('footertext')) ?>
          <?= \kmucms\App::getInstance()->getGlobalVars()->getButton('footertext') ?>
        </p>
        <div class="text-center my-5">
          <?php foreach (json_decode(\kmucms\App::getInstance()->getGlobalVars()->getValue('navfooter') ?? '[]', true) as $n): ?>
          <a href="<?= $n['url'] ?>" class="btn btn-secondary"><?= $n['label'] ?></a>
          <?php endforeach; ?>
          <?= \kmucms\App::getInstance()->getGlobalVars()->getButton('navfooter') ?>
        </div>
      </footer>
    </main>


    <script src="/files/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/files/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>



  </body>
</html>

