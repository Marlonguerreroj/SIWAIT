<?php

require_once '../Controlador/ControlArticulo.php';
require_once '../Controlador/ControlArticuloSucursal.php';
require_once '../Controlador/ControlArticuloExtra.php';
$controlador = new ControlArticulo();
$controlador2 = new ControlArticuloSucursal();
$controlador3 = new ControlArticuloExtra();
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
        $sucursal = $_POST['sel0'];
        $informacion = $_POST['informacion'];
        $valor = $controlador->buscarArticulo($tipo, $informacion, $sucursal);
        if ($valor) {
            return $controlador->GuiConsultarArticulo($valor);
        } else {
            echo '<script language="javascript">alert("No encontro datos");</script>';
            return $controlador->GuiConsultarArticulo("null");
        }
    }
    if (isset($_POST['buscarExtra'])) {
        $tipo = $_POST['sel'];
        $sucursal = $_POST['sel0'];
        $informacion = $_POST['informacion'];
        $valor = $controlador3->buscarArticuloExtra($tipo, $informacion, $sucursal);
        if ($valor) {
            return $controlador3->GuiConsultarArticuloExtra($valor);
        } else {
            echo '<script language="javascript">alert("No encontro datos");</script>';
            return $controlador3->GuiConsultarArticuloExtra("null");
        }
    }
    if (isset($_POST['enviarExtra'])) {
        $codigo = $_POST['codigo'];
        $sucursal = $_POST['sel1'];
        $nombre = $_POST['nombre'];
        $cantidad = $_POST['cantidad'];
        $fEntrada = $_POST['fEntrada'];
        $costo = $_POST['costo'];
        $valorA = $_POST['valor'];
        $notas = $_POST['notas'];

        $valor = $controlador3->registrarArticuloExtra($codigo, $sucursal, $nombre, $cantidad, $fEntrada, $costo, $valorA, $notas);
        if ($valor) {
            echo '<script language="javascript">alert("El articulo extra se registro '
            . 'satisfactoriamente");</script>';
            return $controlador3->GuiRegistrarArticuloExtra();
        } else {
            echo '<script language="javascript">alert("No puede haber dos articulos extras con la misma'
            . ' referencia");</script>';
            return $controlador3->GuiRegistrarArticuloExtra();
        }
    }

    if (isset($_POST['enviar'])) {
        $referencia = $_POST['referencia'];
        $nombre = $_POST['nombre'];
        $tipo = $_POST['tipo'];

        $valor = $controlador->registrarArticulo($referencia, $nombre, $tipo);
        if ($valor) {
            echo '<script language="javascript">alert("El articulo se registro '
            . 'satisfactoriamente");</script>';
            return $controlador->GuiRegistrarArticulo();
        } else {
            echo '<script language="javascript">alert("No puede haber dos articulos con la misma'
            . ' referencia");</script>';
            return $controlador->GuiRegistrarArticulo();
        }
    }
    if (isset($_POST['enviar2'])) {
        $referencia = $_POST['referencia'];
        $nombre = $_POST['nombre'];
        $tipo = $_POST['tipo'];
        $costo = $_POST['costo'];
        $transporte = $_POST['transporte'];
        $valorA = $_POST['valor'];
        $sucursal = $_POST['sel1'];
        $valor0 = $controlador2->actualizarArticuloSucursal($sucursal, $referencia, $costo, $transporte, $valorA);
        $valor = $controlador->actualizarArticulo($referencia, $nombre, $tipo);
        if ($valor && $valor0) {
            echo '<script language="javascript">alert("El articulo se actualizo '
            . 'satisfactoriamente");</script>';
            return $controlador->GuiConsultarArticulo(null);
        } else {
            echo '<script language="javascript">alert("No puede haber dos articulos con la misma'
            . ' referencia");</script>';
            return $controlador->GuiConsultarArticulo("null");
        }
    }

    if ($_GET) {
        if (isset($_GET['referencia']) && isset($_GET['sucursal'])) {
            $sucursal = $_GET['sucursal'];
            $tipo = "Referencia";
            $informacion = $_GET['referencia'];
            $valor = $controlador->buscarArticulo($tipo, $informacion, $sucursal);
            if ($valor) {
                return $controlador->GuiActualizarArticulo($valor);
            } else {
                echo '<script language="javascript">alert("No pudo realizar la accion");</script>';
            }
        } else
        if (isset($_GET['referencia2']) && isset($_GET['sucursal2'])) {
            $sucursal = $_GET['sucursal2'];
            $tipo = "Referencia";
            $informacion = $_GET['referencia2'];
            $valor = $controlador->buscarArticulo($tipo, $informacion, $sucursal);
            if ($valor) {
                return $controlador->GuiMostrarArticulo($valor);
            } else {
                echo '<script language="javascript">alert("No pudo realizar la accion");</script>';
            }
        } else
        if (isset($_GET['codigo2']) && isset($_GET['sucursal2'])) {
            $sucursal = $_GET['sucursal2'];
            $tipo = "Codigo";
            $informacion = $_GET['codigo2'];
            $valor = $controlador3->buscarArticuloExtra($tipo, $informacion, $sucursal);
            if ($valor) {
                return $controlador3->GuiMostrarArticuloExtra($valor);
            } else {
                echo '<script language="javascript">alert("No pudo realizar la accion");</script>';
            }
        }
        if (($_GET['action'] == 'registrar')) {
            return $controlador->GuiRegistrarArticulo();
        } else
        if ($_GET['action'] == 'consultar') {
            return $controlador->GuiConsultarArticulo(null);
        } else
        if ($_GET['action'] == 'consultar2') {
            return $controlador->GuiConsultarArticulo("null");
        } else
        if ($_GET['action'] == 'registrarExtra') {
            return $controlador3->GuiRegistrarArticuloExtra();
        } else
        if ($_GET['action'] == 'consultarExtra') {
            return $controlador3->GuiConsultarArticuloExtra(null);
        } else
        if ($_GET['action'] == 'consultarExtra2') {
            return $controlador3->GuiConsultarArticuloExtra("null");
        }else
        if($_GET['action']== 'registrarPerdida'){
            return $controlador->GuiRegistrarPerdida();
        }
    }
    return $controlador->Home();
} else {
    return $controlador->Principal();
}

