<?php
class  Menu
{
	private id;
	private nombre;
	private descripcion;
	private dependencia;

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
