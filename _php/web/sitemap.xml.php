<?php
header("content-type: application/xml");
$host = "http://" . $_SERVER['HTTP_HOST'];
//addblockers may modify xml-view
?><?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <?php foreach (\kmucms\App::getInstance()->getDb()->getRows('select title,date,url from page where active=1') as $item): ?>
    <url>
    <loc><?= $host . $item['url'] ?></loc>
      <lastmod><?= $item['date'] ?></lastmod>
      <changefreq>dayly</changefreq>
    </url>
  <?php endforeach; ?>
</urlset>