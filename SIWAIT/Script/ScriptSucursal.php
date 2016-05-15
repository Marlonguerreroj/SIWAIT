<?php

require_once '../Controlador/ControlSucursal.php';
$controlador = new ControlSucursal();
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
        $valor = $controlador->buscarSucursal($tipo, $informacion);
        if ($valor) {
            return $controlador->GuiConsultarSucursal($valor);
        } else {
            echo '<script language="javascript">alert("No encontro datos");</script>';
            return $controlador->GuiConsultarSucursal("null");
        }
    }

    if (isset($_POST['enviar'])) {
        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];
        $pagina = $_POST['pagina'];
        $direccion = $_POST['direccion'];
        $ciudad = $_POST['ciudad'];
        $pais = $_POST['pais'];
        $valor = $controlador->registrarSucursal($codigo, $nombre, $telefono, $email, $pagina, $direccion, $ciudad, $pais);
        if ($valor) {
            echo '<script language="javascript">alert("La sucursal se registro '
            . 'satisfactoriamente");</script>';
            return $controlador->GuiRegistrarSucursal();
        } else {
            echo '<script language="javascript">alert("No puede haber dos sucursales con el mismo'
            . ' codigo");</script>';
            return $controlador->GuiRegistrarSucursal();
        }
    }
    if (isset($_POST['enviar2'])) {
        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];
        $pagina = $_POST['pagina'];
        $direccion = $_POST['direccion'];
        $ciudad = $_POST['ciudad'];
        $pais = $_POST['pais'];

        $valor = $controlador->actualizarSucursal($codigo, $nombre, $telefono, $email, $pagina, $direccion, $ciudad, $pais);
        if ($valor) {
            echo '<script language="javascript">alert("La sucursal se actualizo '
            . 'satisfactoriamente");</script>';
            return $controlador->GuiConsultarSucursal(null);
        } else {
            echo '<script language="javascript">alert("No puede haber dos sucursales con el mismo'
            . ' codigo");</script>';
            return $controlador->GuiActualizarSucursal();
        }
    }
    if ($_GET && $dato[0][0] == "Jefe de Operaciones") {
        if (isset($_GET['codigo'])) {
            $tipo = "Codigo";
            $codigo = $_GET['codigo'];
            $valor = $controlador->buscarSucursal($tipo, $codigo);
            if ($valor) {
                return $controlador->GuiActualizarSucursal($valor);
            } else {
                echo '<script language="javascript">alert("No pudo realizar la accion");</script>';
            }
        } else
        if (($_GET['action'] == 'registrar')) {
            return $controlador->guiRegistrarSucursal();
        } else
        if ($_GET['action'] == 'consultar') {
            return $controlador->GuiConsultarSucursal(null);
        } else
        if ($_GET['action'] == 'consultar2') {
            return $controlador->GuiConsultarSucursal("null");
        }
    }
    return $controlador->Home();
} else {
    return $controlador->Principal();
}



