<?php
class Template
{
	protected function render($fileName, array $data)
	{
    $template_content = file_get_contents($fileName);
		return fill($template_content, $data);
	}
}

$result = (new Template())->render("file.tmpl", [])
