<?php
require_once '../Controlador/ControlArticulo.php';
$controlador = new ControlArticulo();

$valor = $controlador->buscarArticulo("Referencia", $_POST['referencia'], "Todos");
echo $valor[0][8].'/'.$valor[0][4]

?>