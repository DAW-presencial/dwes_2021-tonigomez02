<p>Array original:</p>
<?php
error_reporting(0);

$array = array(3, 43, 65, 1, 9, 0, 32, 44, 23);
$ocurrencias = "";
$salida = "";
imprimirArray($array);

while ($ocurrencias !== 0) {
    $ocurrencias = 0;
    for ($i = 0; $i < count($array); $i++) {
        $valorActual = $array[$i];
        $valorSiguiente = $array[$i + 1];
        if ($valorActual > $valorSiguiente && !is_null($valorSiguiente)) {
            $ocurrencias++;
            $array[$i] = $valorSiguiente;
            $array[$i + 1] = $valorActual;
        }

    }
}
?>
<p>Array ordenada: </p>
<?php imprimirArray($array); ?>

<?php
function imprimirArray($array)
{
    global $salida;
    $salida .= "<span>";
    foreach ($array as $value) {
        $salida .= "$value ";
    }
    echo $salida;
    $salida = "";
}

?>