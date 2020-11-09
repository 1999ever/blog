<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php
        if (!isset($titulo)|| empty($titulo)){
            $titulo = 'Blog de Ever';
        }
        
        echo "<title>$titulo</title>";
        ?>
        
        <link rel="icon" href="img/mydel.png">
        
        <link href="<?php echo RUTA_CSS ?>bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo RUTA_CSS ?>all.min.css" rel="stylesheet">
        <link href="<?php echo RUTA_CSS ?>estilos.css" rel="stylesheet">
        <link href="<?php echo RUTA_CSS ?>normalize.css" rel="stylesheet">
    </head>
    <body>