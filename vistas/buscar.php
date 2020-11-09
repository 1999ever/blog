<?php
error_reporting(0);
//header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
//header("Control-Cache: post-check=0, pre-check=0, false");
//header("Pragma: no-cache");

include_once 'app/EscritorEntradas.inc.php';
include_once 'app/RepositorioEntrada.inc.php';

$busqueda = null;
$resultados = null;

$buscar_titulo = false;
$buscar_contenido = false;
$buscar_tags = false;
$buscar_autor = false;

$ordenar_antiguas = false;

if (isset($_POST['buscar']) && isset($_POST['termino-buscar']) && !empty($_POST['termino-buscar'])) {
    $busqueda = $_POST['termino-buscar']; //validar ese if, por ejemplo si la entrada es correcta, si se pulso el boton,etc
    
    Conexion::abrir_conexion();
    $resultados = RepositorioEntrada::buscar_entradas_todos_los_campos(Conexion::obtener_conexion(), $busqueda);
    
    Conexion::cerrar_conexion();
}

if (isset($_POST['busqueda-avanzada']) && isset($_POST['campos'])) {
    
    if (in_array("titulo", $_POST['campos'])) {
        $buscar_titulo = true;
    }
    
    if (in_array("contenido", $_POST['campos'])) {
        $buscar_contenido = true;
    }
    
    if (in_array("tags", $_POST['campos'])) {
        $buscar_tags = true;
    }
    
    if (in_array("autor", $_POST['campos'])) {
        $buscar_autor = true;
    }
    
    if ($_POST['fecha'] == "recientes") {
        $orden = "DESC";
    }
    
    if ($_POST['fecha'] == "antiguas") {
        $orden = "ASC";
    }
    
    if (isset($_POST['termino-buscar']) && !empty($_POST['termino-buscar'])) {
        $busqueda = $_POST['termino-buscar']; //validar ese if, por ejemplo si la entrada es correcta, si se pulso el boton,etc

        Conexion::abrir_conexion();
        
        if ($buscar_titulo) {
            $entradas_por_titulo = RepositorioEntrada::buscar_entradas_por_titulo(Conexion::obtener_conexion(), $busqueda, $orden);
        }
        
        if ($buscar_contenido) {
            $entradas_por_contenido = RepositorioEntrada::buscar_entradas_por_contenido(Conexion::obtener_conexion(), $busqueda, $orden);
        }
        
        if ($buscar_tags) {
            //echo "Todavia no implementado";
        }
        
        if ($buscar_autor) {
            $entradas_por_autor = RepositorioEntrada::buscar_entradas_por_autor(Conexion::obtener_conexion(), $busqueda, $orden);
        }
    }
}

$titulo = "Buscar en blog de Ever";

include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar.inc.php';
//ajustar para que las estradas tengan el mismo tamaño, es decir que tenga un numero limitaedo de caracteres
?>

<div class="container">
    <div class="row">
        <div class="jumbotron">
            <h1 class="text-center">Buscar en blog de Ever</h1>
            <br>
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-8">
                    <form role="form" method="post" action="<?php echo RUTA_BUSCAR ?>">
                        <div class="form-group">
                            <input type="search" name="termino-buscar" class="form-control" 
                                   placeholder="Busar en este sitio..." required <?php echo "value='" .$busqueda."'"; ?>>
                        </div>
                        <button type="submit" name="buscar" class="form-control btn btn-primary btn-buscar">
                            Buscar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <button class="btn btn-primary">
                            <a class="letra" data-toggle="collapse" href="#avanzada">Mostrar búsqueda avanzada</a>
                        </button>
                    </h4>
                </div>
                <div id="avanzada" class="panel-collapse collapse">
                    <div class="panel-body">
                        <form role="form" method="post" action="<?php echo RUTA_BUSCAR ?>">
                            <div class="form-group">
                            <input type="search" name="termino-buscar" class="form-control" 
                                   placeholder="Busar en este sitio..." required <?php echo "value='" .$busqueda."'"; ?>>
                        </div>
                            <p>Buscar en los siguientes campos:</p>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="campos[]" value="titulo"
                                       <?php
                                        if (isset($_POST['busqueda-avanzada'])) {
                                            if ($buscar_titulo) {
                                                echo "checked";
                                            }
                                        } else {
                                            echo "checked";
                                        }
                                       ?>
                                       >Título
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="campos[]" value="contenido"
                                       <?php
                                        if (isset($_POST['busqueda-avanzada'])) {
                                            if ($buscar_contenido) {
                                                echo "checked";
                                            }
                                        } else {
                                            echo "checked";
                                        }
                                       ?>
                                       >Contenidos
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="campos[]" value="tags"
                                       <?php
                                        if (isset($_POST['busqueda-avanzada'])) {
                                            if ($buscar_tags) {
                                                echo "checked";
                                            }
                                        }
                                       ?>
                                       >Tags
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="campos[]" value="autor"
                                       <?php
                                        if (isset($_POST['busqueda-avanzada'])) {
                                            if ($buscar_autor) {
                                                echo "checked";
                                            }
                                        }
                                       ?>
                                       >Autor
                            </label>
                            <hr>
                            <p>Ordenar por:</p>
                            <label class="radio-inline">
                                <input type="radio" name="fecha" value="recientes"
                                       <?php
                                       if (isset($_POST['busqueda-avanzada']) && isset($orden) && $orden == 'DESC') {
                                           echo "checked";
                                       }
                                       
                                       if (!isset($_POST['busqueda-avanzada'])){
                                           echo "checked";
                                       }
                                       ?>
                                       >Entradas más recientes
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="fecha" value="antiguas"
                                       <?php
                                       if (isset($_POST['busqueda-avanzada']) && isset($orden) && $orden == 'ASC') {
                                           echo "checked";
                                       }
                                       ?>
                                       >Entradas más antiguas
                            </label>
                            <hr>
                            <button type="submit" name="busqueda-avanzada" class="btn btn-primary btn-buscar">
                                Busqueda avanzada
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        <div class="container" id="resulados">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>
                            Resultados
                            <?php
                            if (isset($_POST['buscar']) && count($resultados, COUNT_RECURSIVE) > 0) {
                                echo " ";
                                ?>
                                <small><?php echo count($resultados, COUNT_RECURSIVE); ?></small>
                                <?php
                            } //else if (isset($_POST['busqueda-avanzada'])) {
                            //pediente
                            //}
                            ?>
                        </h1>
                    </div>
                </div>
            </div>
            <?php
            if (isset($_POST['buscar'])) {
                if (count($resultados, COUNT_RECURSIVE)) {
                    EscritorEntradas::mostrar_entradas_busqueda($resultados);
                } else {
                    ?>
                    <h3>sin coincidencias</h3>
                    <br>
                    <?php
                }
            } elseif (isset($_POST['busqueda-avanzada'])) {
                if (count($entradas_por_titulo, COUNT_RECURSIVE) || count($entradas_por_contenido, COUNT_RECURSIVE) || count($entradas_por_autor, COUNT_RECURSIVE)) {
                    $parametros = count($_POST['campos']); //antes de usar este post tendria que validaorlo, es decir si esta pulsado o si ha seleccionado, que existe que esta inicadas, como hicimos en validaciones
                    $ancho_columnas = 12 / $parametros;
                    ?>

                    <div class="row">
                        <?php
                        for ($i = 0; $i < $parametros; $i++) {
                            ?>

                            <div class="<?php echo 'col-md-' . $ancho_columnas; ?> text-center">
                                <h4 id="prueba"><?php echo 'Coincidencias en ' . $_POST['campos'][$i]; ?></h4>
                                <br>
                                <?php
                                switch ($_POST['campos'][$i]) {
                                    case 'titulo':
                                        EscritorEntradas::mostrar_entradas_busqueda_multiple($entradas_por_titulo);
                                        break;
                                    case 'contenido':
                                        EscritorEntradas::mostrar_entradas_busqueda_multiple($entradas_por_contenido);
                                        break;
                                    case 'tags':
                                        //
                                        break;
                                    case 'autor':
                                        EscritorEntradas::mostrar_entradas_busqueda_multiple($entradas_por_autor);
                                        break;
                                }
                                ?>  
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                } else {
                    ?>
                    <h3>sin coincidencias</h3>
                    <br>
                    <?php
                }
            }
            ?>
        </div>
        
<?php
include_once 'plantillas/documento-cierre.inc.php';
?>