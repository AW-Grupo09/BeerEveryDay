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
    <script type="text/javascript" src="js/javascript.js"></script>
</head>

<body>

    <div id="contenedor">

        <?php require('includes/comun/header.php'); ?>

        <div class="container">
            
            <table>
                <thead>
                    <th>Nombre</th>
                    <th>Direccion</th>
                    <th>Cuidad</th>
                    <th>Creador</th>
                    <th></th>
                </thead>
                <?php
                $grupos = Grupos::getGrupos();
                foreach ($grupos as $grupo) { ?>
                <tr>
                    <td><a href = "vistaGrupo.php?nombreGrupo=<?=$grupo->getNombre()?> "><?=$grupo->getNombre()?> </a></td>
                    <td><?=$grupo->getDireccion()?></td>
                    <td><?=$grupo->getCiudad()?></td>
                    <td><?=$grupo->getCreador()?></td>
                    <td><button onclick="unirse(<?=$grupo->getId()?>)">Unirse</button></td>
                </tr>
                <?php } ?>
            </table>


             <?php
                if (isset($_GET['action']) && $_GET['action'] == 'unirse') {
                    if(!$_SESSION['login']){
                        header('Location: login.php');
                    }
                    else{

                        $misGrupos = Grupos::buscaUsuarioenGrupos($_SESSION['nombreUsuario'], $_GET['id']);
                        if($misGrupos!=true){
                            $gruposUsuarios = Grupos::insetaGrupoUsuarios($_SESSION['nombreUsuario'], $_GET['id'],10);
                        /*hacer las comporbaciones de que no se pueda unir a su mismo grupo*/
                        /*sigueinte modificacion es el numero de unidades de cerveza*/
                            if(isset($gruposUsuarios)){
                                echo" <p> se ha unido correctamente </p>";
                            }
                        }
                    }
                }
            ?>

        </div>

        <?php require('includes/comun/footer.php'); ?>

    </div> <!-- Fin del contenedor -->

</body>
</html>