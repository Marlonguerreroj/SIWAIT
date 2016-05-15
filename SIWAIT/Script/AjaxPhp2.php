
<?php
require_once '../Controlador/ControlComparacion.php';
$controlador = new ControlComparacion();

$valor = $controlador->registrarSeriales($_POST['codigo'], $_POST['referencia'], $_POST['sucursal'], $_POST['pedido'], $_POST['descripcion']);
echo $valor;
?>

