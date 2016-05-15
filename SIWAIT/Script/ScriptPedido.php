<?php

require_once '../Controlador/ControlPedido.php';
require_once '../Controlador/ControlArticulo.php';
$controlador = new ControlPedido();
$controlador2 = new ControlArticulo();
session_start();
if (isset($_SESSION['usuario'])) {
    $dato = $_SESSION['usuario'];
}
$t = time();
if (isset($_SESSION['tiempo'])) {
    $t0 = $_SESSION['tiempo'];
    $diff = $t - $t0;
    if ($dato[0][0] == "Cajero") {
        if ($diff > 10800 || !isset($t0)) {
            session_unset();
            session_destroy();
        }
    } else {
        if ($diff > 900 || !isset($t0)) {
            session_unset();
            session_destroy();
        }
    }
}

if (!empty($_SESSION)) {
    $_SESSION['tiempo'] = time();

    if (isset($_POST['buscar'])) {
        $tipo = $_POST['sel'];
        $informacion = $_POST['informacion'];
        $valor = $controlador->buscarPedido($tipo, $informacion);
        if ($valor) {
            return $controlador->GuiConsultarPedido($valor);
        } else {
            echo '<script language="javascript">alert("No encontro datos");</script>';
            return $controlador->GuiConsultarPedido("null");
        }
    }

    if (isset($_POST['enviarPedido'])) {
        $codigop = $_POST['codigo0'];
        $proveedor = $_POST['sel1'];
        $fecha = $_POST['fecha'];
        $notas = $_POST['notas'];
        $valor = $controlador->registrarPedido($codigop, $proveedor, $fecha, $notas);

        if (!empty($_POST['codigo']) && is_array($_POST['codigo'])) {
            $cantidad = $_POST['cantidad'];
            foreach ($_POST["codigo"] as $index => $codigo) {
                $valor2 = $controlador2->registrarArticuloPedido($codigo, $cantidad[$index], $codigop);
            }
        }
        if ($valor2) {
            echo '<script language="javascript">alert("Registro Exitoso");</script>';
        } else {
            echo '<script language="javascript">alert("false");</script>';
        }
    }

    if ($_GET) {
        if (isset($_GET['codigo2'])) {
            $codigo = $_GET['codigo'];
            $valor = $controlador->buscarPedido("Codigo", $codigo);
            if ($valor) {
                return $controlador->GuiRegistrarComparacion($valor);
            } else {
                echo '<script language="javascript">alert("No pudo realizar la accion");</script>';
            }
        } else
        if (isset($_GET['referencia']) && isset($_GET['codigo'])) {
            $referencia = $_GET['referencia'];
            $tipo = "Especial";
            $codigo = $_GET['codigo'];
            $valor = $controlador->buscarPedidoE($tipo, $referencia, $codigo);
            if ($valor) {
                return $controlador->GuiMostrarPedido($valor);
            } else {
                echo '<script language="javascript">alert("No pudo realizar la accion");</script>';
            }
        } else
        if (($_GET['action'] == 'registrar')) {
            return $controlador->guiRegistrarPedido();
        } else
        if (($_GET['action'] == 'consultar')) {
            return $controlador->guiConsultarPedido(NULL);
        } else
        if ($_GET['action'] == 'consultar2') {
            return $controlador->GuiConsultarPedido("null");
        }
    }
    return $controlador->Home();
} else {
    return $controlador->Principal();
}
?>