<?php

include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';

include_once 'app/Usuario.inc.php';
include_once 'app/Entrada.inc.php';
include_once 'app/Comentario.inc.php';

include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/RepositorioEntrada.inc.php';
include_once 'app/RepositorioComentario.inc.php';

Conexion::abrir_conexion();

for ($usuarios = 0; $usuarios < 100; $usuarios++) {
    $nombre = sa(10);
    $email = sa(5) .'@' .sa(3);
    $password = password_hash('123456', PASSWORD_DEFAULT);
    
    $usuario = new Usuario('', $nombre, $email, $password, '', '');
    RepositorioUsuario::insertar_usuario(Conexion::obtener_conexion(), $usuario);
}

for ($entradas = 0; $entradas < 100; $entradas++){
    $titulo = sa(10);
    $url = $titulo;
    $texto = lorem();
    $autor = rand(1, 100);
    
    $entrada = new Entrada('', $autor, $url, $titulo, $texto, '', '');
    RepositorioEntrada::insertar_entrada(Conexion::obtener_conexion(), $entrada);
}

for ($comentarios= 0; $comentarios < 100; $comentarios++){
    $titulo = sa(10);
    $texto = lorem();
    $autor = rand(1, 100);
    $entrada = rand(1, 100);
    
    $comentario = new Comentario('', $autor, $entrada, $titulo, $texto, '');
    RepositorioComentario::insertar_comentario(Conexion::obtener_conexion(), $comentario);
}

function sa($longitud) {
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numero_caracteres = strlen($caracteres);
    $string_aleatorio = '';
    
    for ($i = 0; $i < $longitud; $i++) {
        $string_aleatorio .= $caracteres[rand(0, $numero_caracteres - 1)];
    }
    
    return $string_aleatorio;
}

function lorem(){
    $lorem = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas pulvinar, lacus at mattis vestibulum, velit elit finibus ante, eget laoreet quam massa nec nisi. Phasellus consectetur posuere nisl. In eu dui fringilla, molestie lacus eget, pharetra ipsum. Phasellus metus ante, convallis auctor ullamcorper sit amet, suscipit non ex. Fusce viverra neque pulvinar, scelerisque massa vitae, egestas augue. Aenean tellus libero, scelerisque ac ex at, pharetra placerat eros. Praesent at dui quam. Mauris aliquam turpis nec cursus feugiat. Integer tortor turpis, maximus id sodales in, suscipit volutpat enim. Mauris ac neque ultrices, euismod est eu, facilisis massa. Integer faucibus mollis nisi, id molestie tellus faucibus sit amet. Pellentesque nec nisi in velit viverra pellentesque. Suspendisse nec dui venenatis, imperdiet massa sit amet, scelerisque mauris. Morbi magna augue, laoreet in malesuada eget, luctus ut nisi. Aenean viverra suscipit tellus quis cursus.

Nulla cursus nisl erat, vitae placerat ligula aliquet luctus. Integer quis velit nec elit maximus ornare. Donec consequat tristique hendrerit. Aliquam commodo diam ut nisl vestibulum, id fermentum velit lacinia. Sed mattis magna non augue ultricies molestie. Vivamus tempus malesuada felis vitae dictum. Etiam pretium est vitae orci malesuada malesuada. In sed facilisis nulla, a semper nunc. Quisque ut faucibus leo. Integer non condimentum tortor, nec luctus libero. Fusce ut lacus faucibus leo maximus varius dapibus convallis sapien. Morbi placerat quam id purus semper, sit amet ultricies nisi dictum. Pellentesque in ullamcorper nisi. Pellentesque iaculis diam eu augue varius, sit amet tempus mauris suscipit. Vestibulum in luctus sem. Aliquam ac turpis ut ex condimentum convallis quis eget orci.

Phasellus consequat vulputate dictum. Nam purus nisi, vulputate id suscipit vel, semper at erat. Proin eget sem dignissim, consectetur dolor non, viverra ipsum. Sed ut volutpat leo, vitae cursus eros. Proin ut nulla est. Aenean sed sem lacus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris arcu nibh, facilisis sed rutrum a, pharetra a purus. Proin ornare accumsan odio. In pellentesque nulla eu justo consectetur, fringilla bibendum nibh aliquet. Suspendisse porttitor lorem non fringilla hendrerit. In ac urna porttitor, venenatis quam egestas, aliquet sem.

Nunc dignissim dictum odio et interdum. Fusce ullamcorper risus sed nisl eleifend, quis aliquam nunc consequat. Ut eleifend erat et ullamcorper porta. Ut tincidunt tortor ut odio maximus malesuada. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Duis volutpat ultricies felis sit amet gravida. Nullam sed vestibulum odio.

Phasellus suscipit, erat at molestie placerat, arcu sem vulputate ipsum, eget sollicitudin est magna ut sapien. Aliquam id venenatis eros. Maecenas neque lectus, aliquet id ante finibus, rhoncus rutrum odio. Vivamus malesuada, tortor non imperdiet eleifend, mi quam tincidunt massa, eget imperdiet arcu ex vel lorem. Praesent tellus metus, posuere non orci et, fringilla sagittis purus. Nunc ultrices et orci non hendrerit. Ut odio mi, laoreet sed nulla non, pharetra aliquam est. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Fusce iaculis, lacus vitae commodo condimentum, erat diam ultrices sapien, sed dignissim erat massa non felis. Donec fringilla facilisis enim a porta. Nulla eleifend tempus diam non porttitor. Duis convallis lacus quis erat vehicula rutrum. Etiam pharetra ultrices ipsum, at molestie est lacinia blandit. Etiam sed felis in leo placerat commodo id lobortis nunc. Integer sed interdum quam, tempor egestas neque.';

    return $lorem;
}