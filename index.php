<?php



if (is_file('app.phar')) {
  require 'phar://app.phar/index.php';
} else {
  require '_php/index.php';
}
