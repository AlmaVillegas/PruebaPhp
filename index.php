<?php
require_once './Menu/menu.model.php';
require_once './Menu/menu.controller.php';
// Logica
$menu = new Menu();
$controller = new menuController();


if(isset($_REQUEST['action']))
{ 
  switch($_REQUEST['action'])
  {
      case 'actualizar':
            $menu->__SET('id',         $_REQUEST['id']);
            $menu->__SET('Nombre',     $_REQUEST['Nombre']);
            $menu->__SET('Descripcion',$_REQUEST['Descripcion']);
            $menu->__SET('Dependencia',$_REQUEST['Dependencia']);
            $controller->Actualizar($menu);
            header('Location: index.php');
          break;

      case 'buscar';
            $ven= $controller->Buscar($_REQUEST['id']);
          break;

      case 'registrar':
            $menu->__SET('id',         $_REQUEST['id']);
            $menu->__SET('Nombre',     $_REQUEST['Nombre']);
            $menu->__SET('Descripcion',$_REQUEST['Descripcion']);
            $menu->__SET('Dependencia',$_REQUEST['Dependencia']);
            $controller->Registrar($menu);
            header('Location: index.php');
          break;

      case 'eliminar':
            $controller->Eliminar($_REQUEST['id']);
            header('Location: index.php');
       break;

      case 'editar':
            $menu = $controller->Obtener($_REQUEST['id']);
       break;

      case 'cancelar':
            $menu->__SET('id',   $_REQUEST[' ']);
            $menu->__SET('Nombre', $_REQUEST[' ']);
            $menu->__SET('Descripcion', $_REQUEST[' ']);
            $menu->__SET('Dependencia', $_REQUEST[' ']);
            break;
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<SCRIPT Language=Javascript >
function soloLetras(e) {
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toLowerCase();
        letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
        especiales = [8, 37, 39, 46];

        tecla_especial = false
        for(var i in especiales) {
            if(key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla) == -1 && !tecla_especial)
            return false;
    }

function limpia() {

            var val = document.getElementById('Nombre').value;
            var tam = val.length;
            for(i = 0; i < tam; i++) {
                if(!isNaN(val[i]))
                    document.getElementById('Nombre').value = '';
            }

            var val1 = document.getElementById('Descripcion').value;
            var tam = val.length;
            for(i = 0; i < tam; i++) {
                if(!isNaN(val[i]))
                    document.getElementById('Descripcion').value = '';
            }
            
    }
</SCRIPT>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    .modal-header, h4, .close {
    background-color: #0B2161;
    color:white !important;
    text-align: center;
    font-size: 30px;
    }
      .modal-body {
      background-color: #f9f9f9;
    }
  </style>
  <title>Prueba Tecnica</title>
    <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="#">Alma Bolaños</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Menus
              <span class="sr-only">(current)</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</head>

<body>
  <!-- Page Content -->   
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="mt-5">Prueba Tecnica</h1>
          <button type="button" class="btn btn-default btn-lg" id="myBtn">Menu</button>
          <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header" style="padding:35px 50px;" position="center">
               <h4><span class="glyphicon"></span>Menu</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding:40px 50px;">                    
                <form action="?action=<?php echo $menu->__GET('id') > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;" role="form" >
                   <div class="form-group">
                    <input type="hidden" name="id"  value="<?php echo $menu->__GET('id'); ?>" />                          
                        </div>
                         <div class="form-group">
                            <Label style="text-align:left;">Nombre</Label>
                            <input type="text" name="Nombre" value="<?php echo $menu->__GET('Nombre'); ?>" onkeypress="return soloLetras(event)" onblur="limpia()" style="width:100%;" />
                        </div>
                         <div class="form-group">
                            <Label style="text-align:left;">Descripción</Label>
                            <input type="text" name="Descripcion" value="<?php echo $menu->__GET('Descripcion'); ?>" onkeypress="return soloLetras(event)" onblur="limpia()" style="width:100%;" />
                        </div>
                        <div class="form-group">
                            <Label style="text-align:left;">Dependencia</Label>
                            <select name="Dependencia" style="width:100%;">
                            <option value="Sin Dependencia" <?php echo $menu->__GET('Dependencia') == 1 ? 'selected' : ''; ?>>Sin Dependencia</option>
                            <?php foreach($controller->dependencias() as $r): ?>
                            <option value="<?php echo $r->__GET('Nombre'); ?>" <?php echo $menu->__GET('Dependencia') == 1 ? 'selected' : ''; ?>><?php echo $r->__GET('Nombre');?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="modal-footer"> 
                            <button type="submit" class="btn btn-default btn-lg">Guardar</button>
                            <button type="submit" class="btn btn-default btn-lg" action="?action=cancelar">Cancelar</button>
                        </div>
                </form>
            </div>
          </div>
       </div>
   </div>
<script>
$(document).ready(function(){
    $("#myBtn").click(function(){
        $("#myModal").modal();
    });
});
</script>
<br>
<br>
<br>

          <table class="table">
              <thead>
                  <tr>
                      <th style="text-align:left;">Id</th>
                      <th style="text-align:left;">Nombre</th>
                      <th style="text-align:left;">Descripcion</th>
                      <th style="text-align:left;">Dependencia</th>
                      <th style="text-align:center;">Acciones</th>
                      <th></th>
                  </tr>
              </thead>
              <?php foreach($controller->Listar() as $r): ?>
                  <tr>
                      <td><?php echo $r->__GET('Id'); ?></td>
                      <td><?php echo $r->__GET('Nombre'); ?></td>
                      <td><?php echo $r->__GET('Descripcion'); ?></td>
                      <td><?php echo $r->__GET('Dependencia'); ?></td>
                      <td>
                        <a href="?action=editar&id=<?php echo $r->__GET('Id'); ?>" id="edit">Editar</a>
                      </td>
                      <td>
                        <a href="?action=eliminar&id=<?php echo $r->__GET('Id'); ?>">Eliminar</a>
                      </td>
                  </tr>
          <?php endforeach; ?>
        </table>
        </div>
      </div>
     </div>   
  </body>
</html>
