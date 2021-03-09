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
php -S "localhost:8000"
```

go to your browser and type

```
localhost:8000
```

# USE

todo: add description

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
also using image libraries and js/css libraries is a good idea.

