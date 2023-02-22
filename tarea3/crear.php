<?php 

    /*  
        crear.php. Será un formulario para rellenar todos los campos de productos (a excepción del id). 
        Para la familia nos aparecerá un "select" con los nombres de las familias de los productos para 
        elegir uno (lógicamente aunque mostremos los nombres por formulario enviaremos el código).
    */

    // && isset($_POST['nombre_corto']) && isset($_POST['precio']) && isset($_GET['familia']) && isset($_GET['descripcion'])
    if (isset($_POST['crear'])) {
        $nombre = $_POST['nombre'];
        $nombre_corto = $_POST['nombre_corto'];
        $precio = $_POST['precio'];
        $familia = $_POST['familia'];
        $descripcion = $_POST['descripcion'];

        require('conexion.php');

        // TODO: Utilizar try catch

        $consulta = "INSERT INTO productos (nombre, nombre_corto, pvp, familia, descripcion) 
                            VALUES ('$nombre', '$nombre_corto', $precio, '$familia', '$descripcion')";

        echo $consulta . '<br>';

        try {
            $resultado = $conexion->exec($consulta);
        } catch (PDOException $e) {
            echo "\nPDO::errorCode(): ", $conexion->errorCode();
            echo "Error al insertar el producto: " . $e->getMessage();
        }
        

        // if ($resultado) { ?>

        //     <?php
            
        //     $conexion = null;
        // }
    }

    function mostrarSelectFamilias() {
        require('conexion.php');

        // TODO: Utilizar try catch
        // TODO: Comprobar si ya existe el producto por el NOMBRE_CORTO
        // TODO: Hacerlo con consultas preparadas

        $resultado = $conexion->query('SELECT * FROM familias ORDER BY nombre');

        if ($resultado) { ?>
            
            <select class="form-select" id="familia" name="familia">
                <?php while ($familia = $resultado->fetchObject()) : ?>
                    <option value="<?=$familia->cod?>" class="lalo"><?=$familia->nombre?></option>
                <?php endwhile ?>
            </select>

            <?php
            
            $conexion = null;
        }
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
            <h1 class="text-center">Crear Producto</h1>

            <form method="POST" class="row mt-2">

                <div class="col-6">
                    <label class="form-label" for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
                </div>
                <div class="col-6">
                    <label class="form-label" for="nombre_corto">Nombre Corto</label>
                    <input type="text" class="form-control" name="nombre_corto" id="nombre_corto" placeholder="Nombre Corto">
                </div>

                <div class="col-6 mt-3">
                    <label class="form-label" for="precio">Precio (€)</label>
                    <input type="text" class="form-control" name="precio" id="precio" placeholder="Precio (€)">
                </div>

                <div class="col-6 mt-3">
                    <label class="form-label" for="familia">Familia</label>
                    <?php mostrarSelectFamilias() ?>
                </div>

                <div class="col-9 mt-3">
                    <label class="form-label" for="descripcion">Descripción</label>
                    <textarea class="form-control" name="descripcion" id="descripcion" rows="10" cols="50"></textarea>
                </div>

                <div class="mt-3">
                    <button type="submit" name="crear" class="btn btn-primary btn-lg">Crear</button>
                    <button type="reset" class="btn btn-success btn-lg ms-3">Limpiar</button>
                    <a href="listado.php"><button type="button" class="btn btn-info btn-lg ms-3">Volver</button></a>
                </div>

            </form>

        </div>

    </div>
    
</body>
</html>