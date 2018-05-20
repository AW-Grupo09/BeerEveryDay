<?php
    require_once __DIR__.'/includes/config.php';
    require_once __DIR__.'/includes/FormularioGrupo.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title> Grupos </title>
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css"/>
</head>

<body>
    <?php
    if (isset($_GET['action']) && $_GET['action'] == 'unirse') {
        Grupos::insetaGrupoUsuarios($_SESSION['nombreUsuario'], $_GET['id'], 0);
    }
    ?>

    <div id="contenedor">

        <?php require('includes/comun/header.php'); ?>

        <div class="container">
            <div class="titulo">
                <p><h1> ¡Mis grupos! </h1></p>
            </div>

            <table>
                <thead>
                    <th>Nombre</th>
                    <th>Direccion</th>
                    <th>Ciudad</th>
                    <th>Creador</th>
                </thead>
                <?php
                $grupos = Grupos::getGruposByUser($_SESSION['nombreUsuario']);
                foreach ($grupos as $grupo) { ?>
                <tr>
                    <td><?=$grupo->getNombre()?></td>
                    <td><?=$grupo->getDireccion()?></td>
                    <td><?=$grupo->getCreador()?></td>
                    <td><?=$grupo->getCiudad()?></td>
                </tr>
                <?php } ?>
            </table>

            <?php

                $opciones = array();

                $formulario = new FormularioGrupo("formGrupo", $opciones);
                $formulario->gestiona();

            ?>

            <div class="titulo">
                <p><h1> ¡Otros grupos! </h1></p>
            </div>

            <table>
                <thead>
                    <th>Nombre</th>
                    <th>Direccion</th>
                    <th>Ciudad</th>
                    <th>Creador</th>
                    <th></th>
                </thead>
                <?php
                $grupos = Grupos::getGrupos();
                foreach ($grupos as $grupo) { ?>
                <tr>
                    <td><?=$grupo->getNombre()?></td>
                    <td><?=$grupo->getDireccion()?></td>
                    <td><?=$grupo->getCiudad()?></td>
                    <td><?=$grupo->getCreador()?></td>
                    <td><button onclick="unirse(<?=$grupo->getId()?>)">Unirse</button></td>
                </tr>
                <?php } ?>
            </table>

        </div>


        <?php require('includes/comun/footer.php'); ?>

    </div> <!-- Fin del contenedor -->

    <script>
        function unirse(id){
            window.location = "mostrarGrupos.php?action=unirse&id=" + id;
        }
    </script>
</body>
</html>