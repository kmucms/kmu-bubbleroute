<?php
if(!kmucms\App::getInstance()->getPersonAdmin()->isLoggedIn()){
  exit;
}

$webdir = '/runtime/img/';
$imgdir = kmucms\App::getInstance()->getPaths()->getRuntimeWeb().$webdir;
$destfile = time().'-'.$_FILES['file']['name'];
move_uploaded_file($_FILES['file']['tmp_name'], $imgdir. $destfile);

echo $webdir.$destfile;
?>