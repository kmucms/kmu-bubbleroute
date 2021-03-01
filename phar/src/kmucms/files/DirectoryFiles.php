<?php

namespace kmucms\files;

/**
 * in constructor you provide a base path. this directory is threated as a own drive.
 */
class DirectoryFiles{

  protected $path;

  public function __construct($path){
    $this->path = $path;
  }

  public function getFileContent(string $filePath): string{
    return file_get_contents($this->getAbsolutePath($filePath));
  }

  public function setFileContent(string $filePath, string $content): void{
    $this->addFileDir($filePath);
    file_put_contents($this->getAbsolutePath($filePath), $content);
  }

  public function isFile(string $filePath): bool{
    return is_file($this->getAbsolutePath($filePath));
  }

  public function getAbsoluteFilePath(string $filePath, bool $createFileIfNotExists = false): string{
    if($createFileIfNotExists && !$this->isFile($filePath)){
      $this->setFileContent($filePath, '');
    }
    return $this->getAbsolutePath($filePath);
  }

  public function importFile(string $fromAbsolutePath, string $toFilePath): void{
    if($this->isDirectory($toFilePath)){
      $toFilePath .= '/' . pathinfo($fromAbsolutePath, PATHINFO_BASENAME);
    }else{
      $this->addFileDir($toFilePath);
    }
    copy($fromAbsolutePath, $this->getAbsolutePath($toFilePath));
  }

  private function getAbsolutePath(string $filePath): string{
    return $this->path . '/' . $filePath; //no recursions, compared to $this->getAbsoluteFilePath
  }

  private function addFileDir(string $filePath): void{
    $dir = dirname($this->getAbsolutePath($filePath));
    if(!is_dir($dir)){
      mkdir($dir . '/', 0777, TRUE);
    }
  }

  private function isDirectory(string $path): bool{
    return is_dir($this->getAbsolutePath($path));
  }

}
