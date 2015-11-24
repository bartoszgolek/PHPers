<?php

interface IDiskAccess {
  function read($file);
  function write($file, $content);
}

interface DiskAccess {
  function read($file){
      return file_get_contents($file);
  }

  function write($file, $content){
    file_put_contents($file, $content);
  }
}

class FileTemplateContentProvider {
  function __construct($file_name, IDiskAccess $disk_access)
  {
    $this->disk_access = $disk_access;
  }

  function getContent()
  {
    return $this->disk_access->read($file_name);
  }
}
