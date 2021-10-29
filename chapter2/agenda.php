<html>
<head>
    <title>Agenda</title>
    <style>
        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: aliceblue;
            border: 1px solid black;
            border-radius: 15px;
            padding: 25px 50px;
            max-width: 345px;
            min-height: 400px;
        }

        body {
            display: grid;
            justify-content: center;
            align-content: space-between;
            margin-top: 40px;
        }

        * {
            font-family: Arial;
        }

        li {
            margin-top: 5px;
        }

        h4 {
            margin: 3px;
        }

        input {
            margin: 5px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        #enviar {
            align-self: center;
        }

        p {
            margin: 6px;
        }
    </style>
</head>
<body>
<main>
    <h1>Agenda de contactos</h1>
    <form>

        <?php
        error_reporting(0);
        $errores = [];
        $salida = "";

        $agenda = $_GET["agenda"] ?? [];
        $nombre = filter_input(INPUT_GET, "nombre");
        $telefono = filter_input(INPUT_GET, "telefono");

        if (isset($_GET["submit"])) {

            if (!empty($nombre)) {
                if (!empty($telefono)) {
                    if (array_key_exists($nombre, $agenda)){
                        echo 'Contacto actualizado';
                    }else{
                        echo 'Contacto añadido';
                    }
                    $agenda[$nombre] = $telefono;
                } else if (array_key_exists($nombre, $agenda)) {
                    unset($agenda[$nombre]);
                    echo 'Contacto eliminado';
                } else {
                    array_push($errores, 'Introduce un telefono');
                                    }
            } else if (empty($telefono)) {
                array_push($errores, 'Introduce un nombre y un telefono');
            } else {
                array_push($errores, 'Introduce un nombre');
            }

            foreach ($errores as $value) {
                echo "$value <br>";
            }

        }
        ?>

        <p>Nombre: </p><input type="text" name="nombre"/>
        <p>Telefono: </p> <input type="text" name="telefono"/>
        <?php imprimirDatos(); ?>
        <input id="enviar" type="submit" name="submit" value="Enviar"/>
    </form>

    <?php
    if (empty($agenda)) {
        echo '<h4>Lista de contactos vacia</h4>';
    } else {
        echo '<h4>Lista de contactos:</h4>';
    }
    ?>
    <?= $salida ?>

</main>

<?php

function imprimirDatos()
{
    global $salida, $agenda;
    $salida .= "<ul>";
    foreach ($agenda as $nombre => $telefono) {
        $salida .= "<li>$nombre : $telefono</li>";
        echo '<input type="hidden" name="agenda[' . $nombre . ']" value="' . $telefono . '"/>';
    }
    $salida .= '</ul>';
}

?>
</body>
</html>
