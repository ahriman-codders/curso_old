<?php

    /*  listado.php. Mostrará en una tabla los datos código y nombre y los botones para crear un nuevo registro, 
        actualizar uno existente, borrarlo o ver todos sus detalles.
    */

    function mostrarProductos(){

        require_once('conexion.php');

        // TODO: Utilizar try catch
        
        $resultado = $conexion->query('SELECT id, nombre FROM productos ORDER BY nombre');

        // var_dump($resultado);

        // $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        while ($producto = $resultado->fetchObject()) : ?>
            <tr>
                <td><a href="detalle.php?id=<?=$producto->id?>"><button type="button" class="btn btn-info">Detalle</button></a></td>
                <td><?=$producto->id?></td>
                <td><?=$producto->nombre?></td>
                <td>
                    <div class="d-inline-flex">
                        <a href="update.php?id=<?=$producto->id?>"><button type="button" class="btn btn-warning">Actualizar</button></a>
                        <form method="POST" action="borrar.php" class="form-inline ms-2">
                            <input type="hidden" value="<?=$producto->id?>" name="id" />
                            <button type="submit" class="btn btn-danger">Borrar</button>
                        </form>
                    </div>
                    
                </td>
            </tr>
        <?php endwhile ?>

        <?php

        $conexion = null;

    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tema 3</title>

    <?php require('css/bootstrap.php') ?>
</head>
<body>

    <div class="container">
        <div class="row mt-2 text-center">

            <h1>Gestión de Productos</h1>

        </div>

        <a href="crear.php"><button type="button" class="btn btn-success">Crear</button></a>

        <table class="table table-dark table-striped mt-2 text-center">
            <thead>
                    
            </thead>
            <tbody>
                <tr>
                    <th scope="col">Detalle</th>
                    <th scope="col">Código</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Acciones</th>
                </tr>
                <?php mostrarProductos() ?>
            </tbody>
        </table>


    </div>
    
</body>
</html>