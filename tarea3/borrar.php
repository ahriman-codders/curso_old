<?php

    /*  borrar.php. Será una página php con el código necesario para borrar el producto seleccionado desde "listado.php" un 
        mensaje de información y un botón volver para volver a "listado.php". 
    */

    if(!isset($_POST['id'])){
        header('Location: listado.php');
    }

    require('conexion.php');

    // TODO: Utilizar try catch
    // TODO: Hacerlo con consultas preparadas
    // TODO: Avisar si un id no existe, no dejar la página en blanco

    $id = $_POST['id'];

    $consulta = "DELETE FROM productos WHERE id = $id";

    // echo $consulta . '<br>';

    $borrado = false;

    try {
        $resultado = $conexion->exec($consulta);
        if ($resultado == 1) $borrado = true;
    } catch (PDOException $e) {
        // TODO: Mejorar mensajes de error y ser específico
        echo "Error al borrar el producto: " . $e->getMessage();
    } finally {
        // if ($conexion != null) {
        //     $conexion = null;
        // }
    }

?>





<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title TODO: as -->
    <?php require('css/bootstrap.php') ?>
</head>
<body>

    <div>
        <?php if ($borrado) : ?>
            <strong>Producto de Código: <?=$id?> Borrado correctamente.</strong>
        <?php else : ?>
            <strong>No existe ningún producto con el ID <?=$id?>.</strong><!-- En caso de que se recargue la página (POST) -->
        <?php endif ?>
        <a href="listado.php"><button type="button" class="btn btn-outline-dark btn-sm">Volver</button></a>
    </div>
    
</body>
</html>