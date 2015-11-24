<?php

interface IDiskReader {
  function read($file);
}

interface IDiskWriter {
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
  function __construct($file_name, IDiskReader $disk_reader)
  {
    $this->disk_reader = $disk_reader;
  }

  function getContent()
  {
    return $this->disk_reader->read($file_name);
  }
}
