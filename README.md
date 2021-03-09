Small php-project for custom websites.

# in development, dangerous to use, changes are comming, :P

# INSTALL

needed:
-  php   version >= 8
-  nodejs https://nodejs.org/en/ for npm
-  npm https://www.npmjs.com/get-npm
-  composer https://getcomposer.org/doc/00-intro.md
-  some ide, i use netbeans

pick your console

```
git clone https://github.com/kmucms/kmu-cms.git
cd kmu-cms
cd _php
composer install
cd ..
cd _files
cd web
cd files
npm update
cd ..
cd ..
php -S "localhost:8000" "htaccess.php"
```

go to your browser and type

```
localhost:8000
```


---

# project folders

```
project_root
  _runtime            files that are created on runtime. e.g. uploaded images.
    data              not public data, file-imports, configurations, cache ...
    web/runtime       public data
  _files              non server-code files, css/js libraries, images, fonts, icons ... which are shipped with software
    data              not public data, e.g. admin user manual
    web/files         public data
  _php                all the server-side code (php, cann also be packed to phar-package)
    src               classes/object oriented coding
    web               basic rooting
    vendor            code-libraries
    composer.json     code-libraries
    index.php         central bootstrap
  .htaccess           apache-server redirects
  htaccess.php        .htaccess emulation for php buildin server
  index.php           calls _php/index.php
```

**web** folder are accessible through the browser. the order is **runtime>files>php** (means if something is in runtime/web/example.txt and
files/web/example.txt then runtime/web/example.txt will be the output). 
however subfolders(web/runtime and web/files) should be used to have a better traceability. 

**vendor folder/ composer.json** libraries are a good way to speedup the development. 
also using image libraries and js/css libraries is a good idea - they should be placed in files/web/files/ directory.

# Hallo World

make a file _php/web/test/index.php

```php

Hallo World

```

open the page in browser: localhost:8000/test


## webEnvelope

make file _php/webEnvelope/test.php

```php
<?php
/** @var kmucms\uipages\PageEnvelope $this */
?>

<html>
  <body>
    <div>HEADER: <?= $this->getData('title') ?></div>
    <hr/>
    <?= $this->getData('content') ?>  
    <hr/>
    <div>FOOTER</div>
  </body>
</html>

```

edit _php/web/test/index.php 

```php

<?php
/** @var \kmucms\uipages\PageWeb $this */

$this->setPageEnvelope('test');
$this->setData('title', 'Homepage');
?>

Hallo World

```

refresh the page in browser. you should see the header, content "hallo world" and the footer.
if you create more pages, you can reuse the envelope and don't need to write header and footer in every web-file.
you can forward data by $this->setData to envelope and retrife the data with $this->getData in the envelope.
the content of the page is automatically added to $this->setData('content',...) part.

if you change $this->setPageEnvelope('test'); to $this->setPageEnvelope('index'); you should see Hallo World in
the default envelope, you saw on the start page.


## webComponent

create a file: _php/webComponent/testComment.php

```php

<?php
/** @var \kmucms\uipages\PageComponent $this */
?>

<div class="container">
  <?= $this->getData('person') ?> says: <?= $this->getData('comment') ?>
</div>

```


```php

<?php
/** @var \kmucms\uipages\PageWeb $this */

$this->setPageEnvelope('test');
$this->setData('title', 'Homepage');
?>

two dudes met on the street
<?= $this->getComponent('testComment', ['persor'=>'Max','comment'=>'Hallo, how are u?']?>
<?= $this->getComponent('testComment', ['persor'=>'John','comment'=>'Hi, I'm fine.']?>

```

you can reuse html-parts.
