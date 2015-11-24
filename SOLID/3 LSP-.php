<?php
class Rectangle {
	protected $m_width;
	protected $m_height;

	function set_width($width){
		$this->m_width = $width;
	}

	function set_height($height){
		$this->m_height = $height;
	}

	function get_width(){
		return $this->m_width;
	}

	function get_height(){
		return $this->m_height;
	}

	function get_area(){
		return $this->m_width * $this->m_height;
	}
}

class Square extends Rectangle
{
	function set_width($width){
		$this->m_width = $width;
		$this->m_height = $width;
	}

	function set_height($height){
		$this->m_width = $height;
		$this->m_height = $height;
	}
}

class RectangleFactory{
public static function getNewRectangle()
  {
  	return new Square();
  }
}

/** @var $r Rectangle */
$r = RectangleFactory::getNewRectangle();

$r->set_width(5);
$r->set_height(10);

echo $r->get_area();
