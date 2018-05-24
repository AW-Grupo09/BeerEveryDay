<?php
    require_once __DIR__.'/includes/config.php';
    require_once __DIR__.'/includes/FormularioGrupo.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title> Grupos </title>
    <link rel="stylesheet" type="text/css" href="css/mostrarGrupos.css">
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css"/>
    <script type="text/javascript" src="js/javascript.js"></script>
</head>

<body>

    <div id="contenedor">

        <?php require('includes/comun/header.php'); ?>

        <div class="container">
            <h2> Listado de grupos actuales: </h2>
                <?php
                $grupos = Grupos::getGrupos();
                foreach ($grupos as $grupo) { ?>

                 <fieldset>
                        <legend><a href = "vistaGrupo.php?idGrupo=<?=$grupo->getId()?> "><?=$grupo->getNombre()?> </a></legend>
                        <div id="izquierda">
                            <span>Dirección: </span>  <?=$grupo->getDireccion()?>
                            <span>Ciudad: </span> <?=$grupo->getCiudad()?>
                            <p><span>Creado por: </span><?=$grupo->getCreador()?></p>
                        </div>
                        
                        
                    <div id="derecha">
                        <button class= "unirsebtn" onclick="unirse(<?=$grupo->getId()?>)">Unirse</button>
                    </div>
                </fieldset>
                <?php } ?>
            
             <?php
                if (isset($_GET['action']) && $_GET['action'] == 'unirse') {
                    if(!$_SESSION['login']){
                        header('Location: login.php');
                    }
                    else{

                        $misGrupos = Grupos::buscaUsuarioenGrupos($_SESSION['nombreUsuario'], $_GET['id']);
                        if($misGrupos!=true){
                            $gruposUsuarios = Grupos::insertaGrupoUsuarios($_SESSION['nombreUsuario'], $_GET['id'],10);
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