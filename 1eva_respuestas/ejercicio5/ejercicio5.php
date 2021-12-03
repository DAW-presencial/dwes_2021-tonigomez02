<?php

if (isset($_POST["enviar"])) {
    $errores = [];
    $salida = "";

    $nombre = filter_input(INPUT_POST, "nombre");
    $apellido = filter_input(INPUT_POST, "apellido");
    $fecha = filter_input(INPUT_POST, "fecha");

    if (!$nombre == "" && strlen($nombre) > 2) {
        if (!$apellido == "" && strlen($apellido) > 2) {
            if (!$fecha == "") {
                $salida .= "<p>Nombre : $nombre</p> <p>Apellido: $apellido</p> <p>Fecha de nacimiento : $fecha</p>";
            } else {
                array_push($errores, "Introduce una fecha valido");
            }
        } else {
            array_push($errores, "Introduce un apellido valido");
        }
    } else {
        array_push($errores, "Introduce un nombre valido");
    }
    if (count($errores) > 0) {
        imprimirErrores($errores);
    } else {
        if (!empty($_FILES)) {
            foreach ($_FILES as $file) {
                if ($file['error'] == 0) {
                    if (move_uploaded_file($file['tmp_name'], __DIR__ . '/archivos/' . $file['name'])) {
                        $salida .= "Tamaño de " . $file['name'] . " = " . $file['size'] . " bytes <br>";
                    }
                } else {
                    array_push($errores, "Error con el archivo");
                    imprimirErrores($errores);
                }
            }
            echo $salida;
        }
    }
} else {
    despliegaFormulario();
}

function imprimirErrores(&$errores)
{
    foreach ($errores as $error) {
        echo $error;
    }
    despliegaFormulario();
}

function despliegaFormulario()
{
    ?>
    <br>
    <form method="post" enctype="multipart/form-data">
        Nombre: <input name="nombre" type="text" placeholder="nombre..."><br>
        Apellido: <input name="apellido" type="text" placeholder="apellido..."><br>
        Fecha de nacimiento: <input name="fecha" type="date"><br>
        Archivo1: <input name="archivo1" type="file"><br>
        Archivo2: <input name="archivo2" type="file"><br>
        <input name="enviar" type="submit" value="Submit">
    </form>
    <?php
}