<?php
/** @var kmucms\uipages\PageEnvelope $this */
?>


<!doctype html>
<html lang="<?= $this->getData('language') ?? 'de' ?>">
  <head>

    <title><?= $this->getData('title') ?? '' ?></title>
    <meta name="author" content="<?= $this->getData('author') ?? '' ?>">
    <meta name="description" content="<?= $this->getData('description') ?? '' ?>">

    <link rel="canonical" href="<?= $this->getData('canonical') ?? '' ?>">

    <!-- Favicons -->
    <link rel="icon" href="/files/kmucms/img/favicon/favicon.png"> 

    <!-- tech -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link href="/files/node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/files/node_modules/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="/files/web/jqueryui/jquery-ui.min.css" rel="stylesheet">

  </head>
  <body class="bg-dark">

    <nav>
      <div class="navbar navbar-dark bg-dark shadow-sm text-white">
        <div class="container">
          <span class="navbar-brand d-flex align-items-center">
            <img class="me-2" src="/files/kmucms/img/favicon/favicon.png" style="max-width: 32px; max-height: 32px;"/>
            <span class="btn-group">
              <a class="btn btn-secondary" href="/">Web</a>
              <a class="btn btn-secondary" href="/service/admin/be">Admin</a>
            </span>
          </span>
          <h1><?= $this->getData('title') ?></h1>
          <div class="btn-group">
  <!--a class="btn btn-secondary" href="/service/admin" title="admin"><i class="fa fa-user"></i></a-->
            <a class="btn btn-secondary" href="/service/person/logout" title="logout"><i class="fa fa-key"></i></a>
          </div>
        </div>
      </div>
    </nav>


    <main class="bg-light">
      <div  class="§-bar">&nbsp;</div>

      <?php if (!empty($this->getData('description'))): ?>
        <header class="py-2 text-center container">
          <div class="row">
            <div class="col-lg-6 col-md-8 mx-auto">
              <p class="lead text-muted"><?= $this->getData('description') ?? '' ?></p>
            </div>
          </div>
        </header>
      <?php endif; ?>

      <div class="bg-light">
        <?= $this->getData('content') ?>  
      </div>



    <div class="§-bar">&nbsp;</div>
    <!-- FOOTER -->
      <div class="bg-dark text-white">
        <footer class="container py-3">
          <p class="float-end"><a class="text-decoration-none btn btn-secondary" href="#" title="Zum Seitenanfang"><i class="fa fa-arrow-up"></i></a></p>
          <p> &middot; &middot; &middot; Administrationsbereich &middot; &middot; &middot;</p>
        </footer>
      </div>
    </main>


    <script src="/files/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/files/web/jqueryui/jquery-ui.min.js"></script>
    <script src="/files/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>


  </body>
</html>

