<?php

    // detalle.php. Mostrará todo los detalles del producto seleccionado. 

    if(!isset($_GET['id'])){
        header('Location: listado.php');
    }

    // if(!isset($_GET['id'])){
    //     header('Location: listado.php');
    // }

    $producto = null;

    function mostrarSelectFamilias() {
        require_once('conexion.php');

        // TODO: Utilizar try catch

        $id = $_GET['id'];

        $consultaProducto = $conexion->query("SELECT * FROM productos WHERE id = $id ORDER BY nombre");

        // var_dump($resultado);

        $producto = $consultaProducto->fetch(PDO::FETCH_OBJ);

        var_dump($producto);

        echo $producto->id . '<br>';
        echo $producto->nombre . '<br>';
        echo $producto->nombre_corto . '<br>';
        echo $producto->descripcion . '<br>';
        echo $producto->pvp . '<br>';
        echo $producto->familia . '<br>';

        
    }

?>




<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle</title>

    <?php require('css/bootstrap.php') ?>
    <style>
        body {
            background-color: #4dd0e1;
        }

        .fondo {
            background: #17a2b8;
            color: #fff;
        }
    </style>
</head>
<body>

    <div class="container">

        <!-- TODO: Arreglar tamaño -->
        <h1 class="mt-2 text-center">Detalle Producto</h1>

        <?php
            require_once('conexion.php');

            // TODO: Utilizar try catch
    
            $id = $_GET['id'];
    
            $consultaProducto = $conexion->query("SELECT * FROM productos WHERE id = $id ORDER BY nombre");
    
            // var_dump($resultado);
    
            $producto = $consultaProducto->fetch(PDO::FETCH_OBJ);
    
            // var_dump($producto);
        
        ?>

        <!-- TODO: Cread una Card -->
        <div class="card fondo mt-5 mb-3 mx-auto fs-5" style="max-width: 70rem;">
            <div class="card-header text-center"><?=$producto->nombre?></div>
            <div class="card-body">
                <p class="card-text text-center"><span class="fs-5">Codigo: <?=$producto->id?></p>

                <p class="card-text">Nombre: <?=$producto->nombre?></p>
                <p class="card-text">Nombre Corto: <?=$producto->nombre_corto?></p>
                <p class="card-text">Codigo Familia: <?=$producto->familia?></p>
                <p class="card-text">PVP (€): <?=$producto->pvp?></p>
                <p class="card-text">Descripción: <?=$producto->descripcion?></p>
            </div>
        </div>

        <div class="mt-5 text-center">
            <a href="listado.php"><button type="button" class="btn fondo btn-lg ms-3">Volver</button></a>
        </div>

    </div>
    
</body>
</html>