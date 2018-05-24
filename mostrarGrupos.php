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
                    
                    <div id="izquierda">

                        <form>
                        <input type="button" class= "unirsebtn" value="<?=$grupo->getNombre()?>" onclick="window.location.href='vistaGrupo.php?idGrupo=<?=$grupo->getId()?>'"/>
                        </form>
                    
                    </div>
                    <div id="derecha">
                        <span>Dirección: </span>  <?=$grupo->getDireccion()?>
                        <span>Ciudad: </span> <?=$grupo->getCiudad()?>
                        <p><span>Creado por: </span><?=$grupo->getCreador()?></p>
                    </div>
                </fieldset>
                <?php } ?>
        </div>

        <?php require('includes/comun/footer.php'); ?>

    </div> <!-- Fin del contenedor -->

</body>
</html>