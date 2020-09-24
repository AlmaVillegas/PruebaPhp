<?php
class Menu
{
	private $id;
	private $Nombre;
	private $Descripcion;
	private $Dependencia;

	public function __GET($k)
	{
		return $this->$k;
	}
	public function __SET($k, $v)
	{
		return $this->$k =$v;
	}
}
?>
