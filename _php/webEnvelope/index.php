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
    <link rel="icon" href="/files/kmucms/cmsmedia/favicon/favicon.png"> 

    <!-- tech -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link href="/files/node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/files/node_modules/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="/files/node_modules/font-awesome/css/font-awesome.min.css" rel="stylesheet">

  </head>
  <body>

    <nav>
      <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
          <a href="/" class="navbar-brand d-flex align-items-center">
            <img src="/files/kmucms/cmsmedia/favicon/favicon.png" style="max-width: 32px; max-height: 32px;"/>
            <strong class="pl-3">Home</strong>
          </a>
        </div>
      </div>
    </nav>


    <main>

      <header class="py-5 text-center container">
        <div class="row py-lg-5">
          <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-light"><?= $this->getData('title') ?></h1>
            <p class="lead text-muted"><?=$this->getData('description')??''?></p>
          </div>
        </div>
      </header>

      <div class="bg-light py-5 mb-5">
        <?= $this->getData('content') ?>  
      </div>



      <!-- FOOTER -->
      <footer class="container">
        <p class="float-right"><a class="text-decoration-none btn btn-light" href="#" title="Zum Seitenanfang"><i class="bi-triangle-fill"></i></a></p>
        <p> &middot; &middot; &middot; Guten Tag &middot; &middot; &middot;</p>
      </footer>
    </main>


    <script src="/files/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/files/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>


  </body>
</html>

