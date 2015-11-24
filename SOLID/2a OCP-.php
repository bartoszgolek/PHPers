<?php
class FileTemplateContentProvider
{
  function __construct($file_name){
    $this->file_name = $file_name;
  }

  function getContent()
  {
    return file_get_contents($this->fileName);
  }
}

class Template
{
	function render(FileTemplateContentProvider $content_provider, array $data)
	{
    $template_content = $content_provider->getContent();
		return fill($template_content, $data);
	}
}

$result = (new Template())->render(new FileTemplateContentProvider("file.tmpl"), []);
