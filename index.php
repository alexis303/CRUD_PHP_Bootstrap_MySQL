<?php
    include_once 'conexion.php';


    $sql_leer = 'SELECT * FROM colores';

    $gsent = $pdo->prepare($sql_leer);
    $gsent->execute();

    $resultado = $gsent->fetchAll();


    //agregar

    if($_POST) {
      $color = $_POST['color'];
      $descripcion = $_POST['descripcion'];
      $sql_agregar = 'INSERT INTO colores (color, descripcion) VALUES (?,?)';
      
      if($_POST['color'] !== "" && $_POST['descripcion'] !== "" ){
        echo 'colorasd';
        $sentencia_agregar = $pdo->prepare($sql_agregar);
        $sentencia_agregar->execute(array($color, $descripcion));
        header('location: index.php');

        return;
      }
      echo "<script>alert('Los Campos estan vacios');</script>";

    }


    if($_GET){
      $id = $_GET['id'];
      $sql_unico = 'SELECT * FROM colores WHERE id=?';

      $gsent_unico = $pdo->prepare($sql_unico);
      $gsent_unico->execute(array($id));
  
      $resultado_unico = $gsent_unico->fetch();

      //var_dump($resultado_unico);
    }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/5b5467fb30.js" crossorigin="anonymous"></script>
    <title>Hello, wsorld!</title>
  </head>
  <body>
    <h1>Hello, world!</h1>
    <div class="container mt5">
      <div class="row">
        <div class="col-md-6">
          <?php foreach($resultado as $dato):?>

            <div class="alert alert-<?php  echo  $dato['color'] ?>" role="alert">
              
              <?php  echo  $dato['descripcion'] ?>

              <a href="eliminar.php?id=<?php echo $dato['id'] ?>" class="float-right ml-2">
                <i class="fas fa-trash-alt"></i>
              </a>                

              <a href="index.php?id=<?php echo $dato['id'] ?>" class="float-right ml-2">
                <i class="fas fa-pencil-alt"></i>
              </a>

            </div>
           
          <?php endforeach ?>
        </div>

        <div class="col-md-6">
          <?php if(!$_GET): ?>
            <h2>Agregar Elementos</h2>
            <form method="POST">
              <input type="text" placeholder="Color" class="form-control" name="color">
              <input type="text" placeholder="Descripción" class="form-control mt-3"  name="descripcion">
              <button class="btn btn-primary mt-3" >Agregar</button>
            </form>
          <?php endif ?>

          <?php if($_GET): ?>
            <h2>Editar Elementos</h2>
            <form method="GET" action="editar.php">
              <input type="text" value="<?php echo$resultado_unico['color']?>"  placeholder="Color" class="form-control" name="color">
              <input type="text" value="<?php echo$resultado_unico['descripcion']?>" placeholder="Descripción" class="form-control mt-3"  name="descripcion">
              <input type="hidden" value="<?php echo$resultado_unico['id']?>"name="id">
              <button class="btn btn-primary mt-3" >Editar</button>
            </form>
          <?php endif ?>
        </div>
      
      </div>   
    
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  </body>
</html>