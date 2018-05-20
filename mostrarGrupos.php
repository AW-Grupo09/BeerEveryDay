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
        if(!$_SESSION['login']){
            header('Location: login.php');
        }
        else{
            $gruposUsuarios = Grupos::insetaGrupoUsuarios($_SESSION['nombreUsuario'], $_GET['id']);
            /*hacer las comporbaciones de que no se pueda unir a su mismo grupo*/
            /*sigueinte modificacion es el numero de unidades de cerveza*/
            if(isset($gruposUsuarios)){
                echo" se ha unido correctamente";
            }
        }
    }
    ?>

    <div id="contenedor">

        <?php require('includes/comun/header.php'); ?>

        <div class="container">
            

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

    <script> /*eset escrip actuliza lanza mediente el metodo GET el id seleccionado*/
        function unirse(id){
            window.location = "mostrarGrupos.php?action=unirse&id=" + id;
        }
    </script>
</body>
</html>