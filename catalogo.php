<?php
    session_start();
    require_once __DIR__.'/includes/TO/TOCervezas.php';
    require_once __DIR__.'/includes/Controller/controllerCervezas.php';
    require_once __DIR__.'/includes/funcionesCatalogo.php';
    global $sql;
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Catálogo</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/common.css">
        <link rel="stylesheet" href="css/catalogo.css">
        <link rel="stylesheet" type="text/css" href="css/footer.css"/>
    </head>
    <body>    
        <div id="contenedor">
            <?php require('./includes/comun/header.php'); ?>
            <div class="container">
            <header>
                <div class="alert-info">
                    <h2>Filtro de Búsqueda </h2>
                    <img src="img/icons/plus.png" alt="" id="expandFilter"></img>
                    <input id="ref" type="image" src="img/icons/refresh.png" onClick="location.href=location.href">
                </div>
            </header>
            <section id="filtros">
                <form action="catalogo.php" method="post">
                <?php
                    $sql = '';
                    $sql = artesanas($sql);
                    $sql = grado($sql);
                    $sql = color($sql);
                    $sql = grano($sql);
                    $sql = tipo($sql);
                    $sqlOrden = orden();
                ?>
                <input type="submit" name="buscar" value="Buscar">
                </form>
            </section>

            <div id="filtro">
                <?php
                $Cervezas = controllerCervezas::getCervezas($sql, $sqlOrden);
                mostrarCervezas($Cervezas);
                $sql='';
                ?>
            </div>

            <script>
                var boton = document.getElementById("expandFilter");
                boton.onclick = function(){
                    var filtros = document.getElementById("filtros");
                    if (filtros.style.display == "block") {
                        filtros.style.display = "none";
                        this.src = "img/icons/plus.png";
                    } else{
                        filtros.style.display = "block";
                        this.src = "img/icons/minus.png";
                    }
                };
            </script>

        </div> <!-- Cierre de container -->

            <?php require('./includes/comun/footer.php'); ?>

        </div> <!-- Cierre de contenedor-->
        
    </body>
</html>
