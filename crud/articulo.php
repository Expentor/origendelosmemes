<?php
include("conexion.php");
$con=conectar();

$sql="SELECT * FROM articulos";
$query=mysqli_query($con,$sql);

$row=mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title> CRUD DE ARTICULOS </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="http://localhost/crud/estilo.css">
    </head>
    <body>

        <div class="container mt-5">
            <div class="row">
                <div class="col-md-3">
                    <h3>Ingrese datos</h3>
                    <form action="insertar.php" method="POST" enctype="multipart/form-data">
                        <input type="text" class="form-control mb-3" name="autor" placeholder="Autor">
                        <input type="text" class="form-control mb-3" name="titulo" placeholder="Titulo">
                        <input type="text" class="form-control mb-3" name="contenido" placeholder="Contenido">
                        <input value="<?php echo $file['imagen'] ?>" type="file" class="form-control mb-3" name="imagen" placeholder="Imagen">
                        <input type="text" class="form-control mb-3" name="fecha" placeholder="Fecha">

                        <input type="submit" class="btn btn-primary">
                    </form>
                </div>

                <div class="col-md-9">
                    <table class="table">
                        <thead class="table-success table-striped">
                            <tr>
                                <th>id</th>
                                <th>Autor</th>
                                <th>Titulo</th>
                                <th>Contenido</th>
                                <th>Imagen</th>
                                <th>Fecha</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                                <th>Ver</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                while($row=mysqli_fetch_array($query)){
                            ?>
                                <tr>
                                    <th><?php echo $row['idarticulos']?></th>
                                    <th><?php echo $row['autor']?></th>
                                    <th><?php echo $row['titulo']?></th>
                                    <th><?php echo $row['contenido']?></th>
                                    <th><?php echo '<img width="200px" src="'.$row['imagen'].'">' ?></th>
                                    <th><?php echo $row['fecha']?></th>
                                    <th><a href="actualizar.php?id<?php echo $row['idarticulos'] ?>" class="btn btn-info">Editar</a></th>
                                    <th><a href="eliminar.php?id<?php echo $row['idarticulos'] ?>" class="btn btn-danger">Eliminar</a></th>
                                    <th><a href="ver.php?id<?php echo $row['idarticulos'] ?>" class="btn btn-success" class="bi bi-eye-fill">Ver</a></th>
                                </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </body>
</html>