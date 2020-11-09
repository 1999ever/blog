<?php

include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/EscritorEntradas.inc.php';

$titulo = 'My Blog';

include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar.inc.php';
?>
<div class="container">
    <div class="jumbotron">
        <h1><b>MY BLOG</b></h1>
        <p>
            Blog dedicado a compartir ideas y opiniones de ámbito general
        </p>
    </div> 
</div>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>  Busqueda
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post" action="<?php echo RUTA_BUSCAR ?>">
                                <div class="form-group">
                                    <input type="search" name="termino-buscar" class="form-control" 
                                           placeholder="Busar en este sitio...">
                                </div>
                                <button type="submit" name="buscar" class="form-control btn btn-primary">
                                    Buscar
                                </button>
                            </form>    
                        </div>
                    </div>
                </div>       
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span class="glyphicon glyphicon-filter" aria-hidden="true"></span>  Filtro
                        </div>
                        <div class="panel-body">

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>  Archivo
                        </div>
                        <div class="panel-body">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <?php
            EscritorEntradas::escribir_entradas();
            ?>
        </div>
    </div>
</div>


<?php
include_once 'plantillas/piepagina.inc.php';
include_once 'plantillas/documento-cierre.inc.php';
?>