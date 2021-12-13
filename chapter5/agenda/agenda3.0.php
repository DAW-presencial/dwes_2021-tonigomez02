<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agenda de contactos</title>
    <style>
        table {
            width: 600px;
            border: 1px solid black;
            border-radius: 20px;
            margin: 40px auto auto;
            border-collapse: collapse;
            border-spacing: 0;
        }

        td {
            text-align: center;
            padding: 10px;
            font-size: 18px;
        }

        th {
            background-color: dodgerblue;
            color: white;
            text-align: center;
            padding: 10px;
            font-size: 18px;
        }

        form{
            padding: 20px;
        }

        label{
            font-size: 16px;
            font-family: Arial, sans-serif;
            width: 70px;
            display: block;
        }

        input{
            padding: 8px;
            margin: 5px;
        }

        input:last-child{
            margin: 0;
        }

        div{
            display: flex;
            align-items: center;
        }

    </style>
</head>
<body>

<?php

spl_autoload_register(function ($clase) {
    include './' . $clase . '.php';
});

$database = new Database();
$db = $database->getConnection();
$utils = new DBUtils();
$errores = [];

if (isset($_POST["enviar"])) {

    $nombre = filter_input(INPUT_POST, "nombre");
    $apellido = filter_input(INPUT_POST, "apellido");
    $telefono = filter_input(INPUT_POST, "telefono");

    if (!empty($nombre)) {
        if (!empty($telefono)) {
            if (!empty($apellido)) {
                if ($utils->find($db, $nombre)) {
                    imprimirFormulario();
                    echo '<p style="text-align: center">Contacto actualizado</p>' . "<br>";
                    $utils->update($db, $nombre, $apellido, $telefono);
                    $utils->read($db);

                } else {
                    $utils->create($db, $nombre, $apellido, $telefono);
                    imprimirFormulario();
                    echo '<p style="text-align: center">Contacto añadido</p>' . "<br>";
                    $utils->read($db);
                }
            } else {
                array_push($errores, 'Introduce un apellido');
            }
        } else if ($utils->find($db, $nombre)) {
            $utils->delete($db, $nombre);
            imprimirFormulario();
            echo '<p style="text-align: center">Contacto eliminado</p>' . "<br>";
            $utils->read($db);
        }else{
            array_push($errores, 'Introduce un telefono');
        }
    } else if (empty($telefono)) {
        array_push($errores, 'Introduce un nombre y un telefono');
    } else {
        array_push($errores, 'Introduce un nombre');
    }
} else {
    imprimirFormulario();
    $utils->read($db);
}


function imprimirFormulario()
{

    ?>
    <form action="" method="post">
        <div>
            <label for="nombre" >Nombre: </label><input name="nombre" type="text" placeholder="nombre..."><br>
        </div>
        <div>
            <label for="apellido" >Apellido: </label><input name="apellido" type="text" placeholder="apellido..."><br>
        </div>
        <div>
            <label for="telefono" >Telefono: </label><input name="telefono" type="text" placeholder="telefono...""><br>
        </div>
        <input name="enviar" type="submit" value="Submit">
    </form>
    <?php
}

?>
</body>
</html>

