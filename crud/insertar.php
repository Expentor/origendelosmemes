<?php
    include("conexion.php");
    $con=conectar();

    //$idarticulos=$_POST['idarticulos'];
    $autor=$_POST['autor'];
    $titulo=$_POST['titulo'];
    $contenido=$_POST['contenido'];

    $imagen=$_FILES['imagen']['name'];
    $ruta=$_FILES['imagen']['tmp_name'];
    $destino = "fotos/".$imagen;
    copy($ruta, $destino);

    $fecha=$_POST['fecha'];

    $sql="INSERT INTO articulos (autor, titulo, contenido, imagen, fecha) VALUES ('$autor', '$titulo', '$contenido', '$destino', '$fecha')";
    $query= mysqli_query($con,$sql);

    if($query){
        Header("Location: articulo.php");

    }else{
        
    }

?>