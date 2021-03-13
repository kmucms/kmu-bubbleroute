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

  </head>
  <body class="bg-dark">

    <nav>
      <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
          <a href="/" class="navbar-brand d-flex align-items-center">
            <img src="/files/kmucms/cmsmedia/favicon/favicon.png" style="max-width: 32px; max-height: 32px;"/>
            <strong>&nbsp;&nbsp;&nbsp;Home</strong>
          </a>
        </div>
      </div>
      <div style="font-size: 10px; background-image: repeating-linear-gradient(45deg,yellow,yellow 22px, black 22px, black 44px); border:1px solid black;">&nbsp;</div>
    </nav>


    <main class="bg-white">

      <header class="py-2 text-center container">
        <div class="row">
          <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-light"><?= $this->getData('title') ?></h1>
            <p class="lead text-muted"><?= $this->getData('description') ?? '' ?></p>
          </div>
        </div>
      </header>

      <div class="bg-light py-5 pb-5">
        <?= $this->getData('content') ?>  
      </div>



      <div style="font-size: 10px; background-image: repeating-linear-gradient(45deg,yellow,yellow 22px, black 22px, black 44px); border:1px solid black;">&nbsp;</div>
      <!-- FOOTER -->
      <div class="bg-dark text-white">
        <footer class="container py-3">
          <p class="float-right"><a class="text-decoration-none btn btn-light" href="#" title="Zum Seitenanfang"><i class="bi-triangle-fill"></i></a></p>
          <p> &middot; &middot; &middot; Administrationsbereich &middot; &middot; &middot;</p>
        </footer>
      </div>
    </main>


    <script src="/files/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/files/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>


  </body>
</html>

