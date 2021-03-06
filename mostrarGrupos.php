
<?php
    session_start();
    require_once __DIR__.'/includes/FormularioGrupo.php';
     require_once __DIR__.'/includes/TO/TOGrupos.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title> Grupos </title>
    <link rel="stylesheet" type="text/css" href="css/mostrarGrupos.css">
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css"/>
</head>

<body>

    <div id="contenedor">

        <?php require('includes/comun/header.php'); ?>

        <div class="container">
            <h2> ¡Estos son los grupos actualmente activos en BeerEveryDay! </h2>
                <?php
                $grupos = controllerGrupos::getGrupos();
                if(isset($grupos) && empty($grupos)){
                    echo "<div id='noGroups'>";
                    echo "<h3> Vaya, parece que no hay grupos...</h3>";
                    echo "<p> ¡Anímate a crear tú uno propio! </p>";
                    echo "</div>";
                }
                else{
                    foreach ($grupos as $grupo) { ?>

                     <fieldset>
                        <legend> <?php echo $grupo->getNombre(); ?></legend>

                       <div id="izquierda">
                            <span>Dirección: </span>  <?=$grupo->getDireccion()?>
                            <span>Ciudad: </span> <?=$grupo->getCiudad()?>
                            <p><span>Creado por: </span><?=$grupo->getCreador()?></p>
                        </div>

                        <div id="derecha">
                            <form>
                            <input type="button" class= "unirsebtn" value="Ver grupo" onclick="window.location.href='vistaGrupo.php?idGrupo=<?=$grupo->getId()?>'"/>
                            </form>
                        </div>
     
                    </fieldset>
                    <?php } 
                }?>
        </div>

        <?php require('includes/comun/footer.php'); ?>

    </div> <!-- Fin del contenedor -->

</body>
</html>