<?php
require_once 'menu.model.php';
require_once 'menu.controller.php';
// Logica
$menu = new Menu();
$controller = new menuController();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <title>Prueba Tecnica</title>
</head>
<body>
  <!-- Page Content -->   
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
      	 <?php foreach($controller->dependencias() as $x): ?>
             <h1 class="mt-5"> Prueba Tecnica "<?php echo $x->__GET('Descripcion');?></h1>
         <?php endforeach; ?>
      </div>
    </div>
  </div>
</body>
</html>
