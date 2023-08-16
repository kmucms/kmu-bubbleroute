<?php

namespace kmucms\files;

/**
 * in constructor you provide a base path. this directory is threated as a own drive.
 */
class Files {

  protected $path;

  public function __construct($path) {
    $this->path = $path;
    if (!is_dir($path)) {
      $this->addDir('');
    }
  }

  public function getFileContent(string $filePath): string {
    $filePathA = $this->getAbsolutePath($filePath);
    if (is_file($filePathA)) {
      return file_get_contents($filePathA);
    }
    return '';
  }

  public function setFileContent(string $filePath, string $content): void {
    $this->addFile($filePath);
    file_put_contents($this->getAbsolutePath($filePath), $content);
  }

  public function isFile(string $filePath): bool {
    return is_file($this->getAbsolutePath($filePath));
  }

  public function addImportFile(string $fromAbsolutePath, string $toFilePath): void {
    if ($this->isDirectory($toFilePath)) {
      $toFilePath .= '/' . pathinfo($fromAbsolutePath, PATHINFO_BASENAME);
    } else {
      $this->addFileDir($toFilePath);
    }
    copy($fromAbsolutePath, $this->getAbsolutePath($toFilePath));
  }

  public function getAbsolutePath(string $filePath): string {
    $path = $this->path . '/' . $filePath;
    return preg_replace('/[\\\\\/]+/i', '/', $path);
  }

  public function addDir(string $filePath): void {
    $dir = $this->getAbsolutePath($filePath);
    if (!is_dir($dir)) {
      mkdir($dir . '/', 0777, TRUE);
    }
  }

  private function addFile(string $filePath): void {
    $fpAbs = $this->getAbsolutePath($filePath);
    if (is_file($fpAbs)) {
      return;
    }
    $dir = dirname($fpAbs);
    if (!is_dir($dir)) {
      mkdir($dir . '/', 0777, TRUE);
    }
    file_put_contents($filePath, '');
  }

  public function isDir(string $path): bool {
    return is_dir($this->getAbsolutePath($path));
  }

  private function beautifyPath(string $path): string {
    return str_replace('\\', '/', $path);
  }

}
