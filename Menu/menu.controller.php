<?php
class menuController
{
	private $pdo;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = new PDO('mysql:host=localhost; port= 3306; dbname=MydataBase', 'root', '' );
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		}
		catch(Exception $e){
			die($e->getMessage());
		}
	}
	public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM menu");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$menu = new Menu();
 				$menu->__SET('Id', $r->id);
				$menu->__SET('Nombre', $r->nombre);
				$menu->__SET('Descripcion', $r->descripcion);
				$menu->__SET('Dependencia', $r->dependencia);	
				$result[] = $menu;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
		public function dependencias()
	{
		try 
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT DISTINCT id, nombre, descripcion, dependencia FROM menu");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$menu = new Menu();
				$menu->__SET('Id', $r->id);
				$menu->__SET('Nombre', $r->nombre);
				$menu->__SET('Descripcion', $r->descripcion);
				$menu->__SET('Dependencia', $r->dependencia);
				$result[] = $menu;
			}

			return $result;
		} 
		catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
		public function ObtenerDependencia($id)
	{
		try 
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM menu WHERE id= ?");
			$stm->execute(array($id));

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$menu = new Menu();
				$menu->__SET('Id', $r->id);
				$menu->__SET('Nombre', $r->nombre);
				$menu->__SET('Descripcion', $r->descripcion);
				$menu->__SET('Dependencia', $r->dependencia);
				$result[] = $menu;
			}

			return $result;
		} 
		catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
	public function Obtener($id)
	{
		try 
		{
			$stm = $this->pdo->prepare("SELECT * FROM menu WHERE id = ?");
			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);
			$menu = new Menu();
			$menu->__SET('Id', $r->id);
			$menu->__SET('Nombre', $r->nombre);
			$menu->__SET('Descripcion', $r->descripcion);
			$menu->__SET('Dependencia', $r->dependencia);	
			return $menu;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM menu WHERE id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}

	}

	public function Actualizar(Menu $data)
	{
		try 
		{
			$sql = "UPDATE menu SET 
						nombre      = ?,
						descripcion = ?, 
						dependencia = ?
				        WHERE    id = ? ";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('Nombre'),
					$data->__GET('Descripcion'), 
					$data->__GET('Dependencia'),
					$data->__GET('id')
					)
				);

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Menu $data)
	{
	   try 
		{
		$sql = "INSERT INTO menu (nombre, descripcion, dependencia) 
		        VALUES (?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('Nombre'), 
				$data->__GET('Descripcion'),
				$data->__GET('Dependencia')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}
?>
