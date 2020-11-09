<?php

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: ". gmdate("D, d, M, Y, H:i:s") . "GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';
//include_once 'app/config.inc.php';


if (!ControlSesion::sesion_iniciada()){
    Redireccion::redirigir(SERVIDOR);
} else {
    Conexion::abrir_conexion();
    $id = $_SESSION['id_usuario'];
    $usuario = RepositorioUsuario :: obtener_usuario_por_id(Conexion::obtener_conexion(), $id);
}

if (isset($_POST['guardar_imagen']) && !empty($_FILES['archivo_subido']['tmp_name'])) {
    $directorio = DIRECTORIO_RAIZ."/subidas/";
    $carpeta_objetivo = $directorio.basename($_FILES['archivo_subido']['name']);
    $subida_correcta = 1;
    $tipo_imagen = pathinfo($carpeta_objetivo, PATHINFO_EXTENSION);
    
    $comprobacion = getimagesize($_FILES['archivo_subido']['tmp_name']);
    if ($comprobacion !== false) {
        $subida_correcta = 1;
    } else {
        $subida_correcta = 0;
    }
    
    if ($_FILES['archivo_subido']['size'] > 500000) {
        echo "El archivo no puede ocupar mas de 500kb"; //Para informarle al usuaario de que no se pudo subir a imagen no es recomendable haverlo con echo, sino de otra forma
        $subida_correcta = 0;
    }
    
    if ($tipo_imagen != "jpg" && $tipo_imagen != "png" && $tipo_imagen != "jpeg" && $tipo_imagen != "gif") {
        echo "Solo se admiten los formatos JPG, JPEG, PNG Y GIF";
    } else {
        if (move_uploaded_file($_FILES['archivo_subido']['tmp_name'], 
                DIRECTORIO_RAIZ."/subidas/".$usuario -> obtener_id())) {
            //el informe en pantalla de que la subida ha sido correcta se puede utilizar la ventana de notificacion verde con un check de botstrapp de que todo ha ido bien
            //echo "El archivo ".basename($_FILES['archivo_subido']['name'])." ha sido subido.";
        } else {
            echo "Ha ocurrido un error.";
        }
    }
}

$titulo = "Perfil de usuario";

include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

<div class="container perfil">
    <div class="row">
        <div class="col-md-3">
            <?php
            if (file_exists(DIRECTORIO_RAIZ."/subidas/".$usuario->obtener_id())) {
                ?>
                  <img src="<?php echo SERVIDOR.'/subidas/'.$usuario->obtener_id(); ?>" class="img-responsive">
            <?php
            } else {
                ?>
                  <img src="img/mydel.png" class="img-responsive">
            <?php
            }
            ?>
            <br>
            <form class="text-center" action="<?php echo RUTA_PERFIL; ?>" method="post" enctype="multipart/form-data">
                <label for="archivo_subido" id="label_archivo">Sube una imagen de Perfil</label>
                <input type="file" name="archivo_subido" id="archivo_subido" class="boton_subir">
                <br>
                <br>
                <input type="submit" value="Guardar" name="guardar_imagen" class="form-control">
            </form>
        </div>
        <div class="col-md-9">
            <h4><small>Nombre de Usuario</small></h4>
            <h4><?php echo $usuario -> obtener_nombre(); ?></h4>
            <br>
            <h4><small>Email</small></h4>
            <h4><?php echo $usuario -> obtener_email(); ?></h4>
            <br>
            <h4><small>Usuario desde</small></h4>
            <h4><?php echo $usuario -> obtener_fecha_registro(); ?></h4>
        </div>
    </div>
</div>

<?php
include_once 'plantillas/documento-cierre.inc.php';
?>