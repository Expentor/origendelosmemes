<?php
    include("conexion.php");
    $con=conectar();

    $idarticulos=$_GET['idarticulos'];

    $sql="DELETE FROM articulos WHERE idarticulos = '$idarticulos'";
    //$sql="DELETE FROM articulos WHERE idarticulos='$idarticulos'";
    $query=mysqli_query($con,$sql);

    if($query){
        Header("Location: articulo.php");
    }
?>