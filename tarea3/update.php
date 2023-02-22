<?php

    /* 
        update.php. Nos aparecerá un formulario con los campos rellenos con los valores del producto seleccionado 
        desde "listado.php" incluido el select donde seleccionamos la familia
    */

    if(!isset($_GET['id']) ){
        header('Location: listado.php');
    }

    if (isset($_POST['modificar'])) {

        $id = $_POST['id'];

        $nombre = $_POST['nombre'];
        $nombre_corto = $_POST['nombre_corto'];
        $precio = $_POST['precio'];
        $familia = $_POST['familia'];
        $descripcion = $_POST['descripcion'];

        require('conexion.php');

        // TODO: Utilizar try catch
        // TODO: Hacerlo con consultas preparadas

        $consulta = "UPDATE productos 
                    SET nombre = '$nombre', nombre_corto = '$nombre_corto', pvp = $precio, familia = '$familia', descripcion = '$descripcion'
                    WHERE id = $id";

        echo $consulta . '<br>';

        try {
            $resultado = $conexion->exec($consulta);
            var_dump($resultado); // exec devuelve un entero
        } catch (PDOException $e) {
            # code...
            echo "Error al actualizar el producto: " . $e->getMessage();
        } finally {
            // if ($conexion != null) {
            //     $conexion = null;
            // }
        }

        

        // if ($resultado) { 
            
        //     $conexion = null;
        // }
    }

    $producto = null;

    function mostrarSelectFamilias() {
        require('conexion.php');

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
    <title>Tema 3</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        body {
            background-color: #4dd0e1;
        }

        .btn-info {
            background: #17a2b8;
            color: #fff;
        }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>
<body>

    <div class="container">

        <div class="row mt-2">

            <!-- TODO: Arreglar tamaño -->
            <h1 class="text-center">Modificar Producto</h1>

            <form method="POST" class="row mt-2">

                <?php
                    require_once('conexion.php');

                    // TODO: Utilizar try catch
                    // TODO: Hacerlo con consultas preparadas
            
                    $id = $_GET['id'];
            
                    $consultaProducto = $conexion->query("SELECT * FROM productos WHERE id = $id ORDER BY nombre");
            
                    // var_dump($resultado);
            
                    $producto = $consultaProducto->fetch(PDO::FETCH_OBJ);
            
                    // var_dump($producto);
            
                    // echo $producto->id . '<br>';
                    // echo $producto->nombre . '<br>';
                    // echo $producto->nombre_corto . '<br>';
                    // echo $producto->descripcion . '<br>';
                    // echo $producto->pvp . '<br>';
                    // echo $producto->familia . '<br>';
                
                ?>

                <input type="hidden" class="form-control" name="id" id="id" value="<?=$producto->id?>">

                <div class="col-6">
                    <label class="form-label" for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" value="<?=$producto->nombre?>">
                </div>
                <div class="col-6">
                    <label class="form-label" for="nombre_corto">Nombre Corto</label>
                    <input type="text" class="form-control" name="nombre_corto" id="nombre_corto" value="<?=$producto->nombre_corto?>">
                </div>

                <div class="col-6 mt-3">
                    <label class="form-label" for="precio">Precio (€)</label>
                    <input type="text" class="form-control" name="precio" id="precio" value="<?=$producto->pvp?>">
                </div>

                <div class="col-6 mt-3">
                    <label class="form-label" for="familia">Familia</label>
                    <?php 
                        $consultaFamilias = $conexion->query("SELECT * FROM familias ORDER BY nombre");

                        if ($consultaFamilias) { ?>
                            
                            <select class="form-select" id="familia" name="familia">
                                <?php while ($familia = $consultaFamilias->fetchObject()) : ?>
                                    <option value="<?=$familia->cod?>" <?php if($familia->cod == $producto->familia) echo 'selected'?>><?=$familia->nombre?></option>
                                <?php endwhile ?>
                            </select>
                
                            <?php
                            
                            $conexion = null;
                        }
                    ?>
                </div>

                <div class="col-9 mt-3">
                    <label class="form-label" for="descripcion">Descripción</label>
                    <textarea class="form-control" name="descripcion" id="descripcion" rows="10" cols="50"><?=$producto->descripcion?></textarea>
                </div>

                <div class="mt-3">
                    <button type="submit" name="modificar" class="btn btn-primary btn-lg">Modificar</button>
                    <a href="listado.php"><button type="button" class="btn btn-info btn-lg ms-3">Volver</button></a>
                </div>

            </form>

        </div>

    </div>
    
</body>
</html>