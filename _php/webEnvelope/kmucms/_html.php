
<?php
/** @var kmucms\easy\PageEnvelope $this */
?>


<!doctype html>
<html lang="<?= $this->getData('language') ?? 'de' ?>">
  <head>

    <title><?= $this->getData('title') ?? '' ?></title>
    <meta name="author" content="<?= $this->getData('author') ?? '' ?>">
    <meta name="description" content="<?= $this->getData('description') ?? '' ?>">

    <?php if($this->getData('canonical') != null): ?>
      <link rel="canonical" href="<?= $this->getData('canonical') ?? '' ?>">
    <?php endif; ?>

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/cmsmedia/favicon/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/cmsmedia/favicon/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/cmsmedia/favicon/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="mask-icon" href="/cmsmedia/favicon/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/cmsmedia/favicon/favicon.ico">

    <!-- tech -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <?= $this->getData('styles') ?? '' ?>

  </head>
  <body>

    <?= $this->getData('content') ?? '' ?>

    <?= $this->getData('script_globals') ?? '' ?>
    <?= $this->getData('script_libs') ?? '' ?>
    <?= $this->getData('script_start') ?? '' ?>

  </body>
</html>

