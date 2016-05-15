<?php

require_once '../Controlador/ControlProveedor.php';
$controlador = new ControlProveedor();
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
        $valor = $controlador->buscarProveedor($tipo, $informacion);
        if ($valor) {
            return $controlador->GuiConsultarProveedor($valor);
        } else {
            echo '<script language="javascript">alert("No encontro datos");</script>';
            return $controlador->GuiConsultarProveedor("null");
        }
    }

    if (isset($_POST['enviar'])) {
        $codigo = $_POST['codigo'];
        $nit = $_POST['nit'];
        $nombre = $_POST['nombre'];
        $pagina = $_POST['pagina'];
        $telefono = $_POST['telefono'];
        $cuentaBancaria = $_POST['cuentaBancaria'];
        $nCuentaBancaria = $_POST['nCuentaBancaria'];
        $nombreContacto = $_POST['nombreContacto'];
        $email = $_POST['email'];
        $tipoCuenta = $_POST['tipoCuentaBancaria'];

        $valor = $controlador->registrarProveedor($codigo, $nit, $nombre, $pagina, $telefono, $cuentaBancaria, $nCuentaBancaria, $nombreContacto, $email, $tipoCuenta);
        if ($valor) {
            echo '<script language="javascript">alert("El proveedor se registro '
            . 'satisfactoriamente");</script>';
            return $controlador->GuiRegistrarProveedor();
        } else {
            echo '<script language="javascript">alert("No puede haber dos proveedores con el mismo'
            . ' codigo");</script>';
            return $controlador->GuiRegistrarProveedor();
        }
    }
    if (isset($_POST['enviar2'])) {
        $codigo = $_POST['codigo'];
        $nit = $_POST['nit'];
        $nombre = $_POST['nombre'];
        $pagina = $_POST['pagina'];
        $telefono = $_POST['telefono'];
        $cuentaBancaria = $_POST['cuentaBancaria'];
        $nCuentaBancaria = $_POST['nCuentaBancaria'];
        $nombreContacto = $_POST['nombreContacto'];
        $email = $_POST['email'];
        $tipoCuenta = $_POST['tipoCuentaBancaria'];

        $valor = $controlador->actualizarProveedor($codigo, $nit, $nombre, $pagina, $telefono, $cuentaBancaria, $nCuentaBancaria, $nombreContacto, $email, $tipoCuenta);
        if ($valor) {
            echo '<script language="javascript">alert("El proveedor se actualizo '
            . 'satisfactoriamente");</script>';
            return $controlador->GuiConsultarProveedor(null);
        } else {
            echo '<script language="javascript">alert("No puede haber dos proveedores con el mismo'
            . ' codigo");</script>';
            return $controlador->GuiRegistrarProveedor();
        }
    }
    if ($_GET && $dato[0][0] == "Jefe de Operaciones") {
        if (isset($_GET['codigo'])) {
            $tipo = "Codigo";
            $codigo = $_GET['codigo'];
            $valor = $controlador->buscarProveedor($tipo, $codigo);
            if ($valor) {
                return $controlador->GuiActualizarProveedor($valor);
            } else {
                echo '<script language="javascript">alert("No pudo realizar la accion");</script>';
            }
        } else
        if (isset($_GET['codigo2'])) {
            $tipo = "Codigo";
            $codigo = $_GET['codigo2'];
            $valor = $controlador->buscarProveedor($tipo, $codigo);
            if ($valor) {
                return $controlador->GuiMostrarProveedor($valor);
            } else {
                echo '<script language="javascript">alert("No pudo realizar la accion");</script>';
            }
        } else
        if ($_GET['action'] == 'registrar') {
            return $controlador->GuiRegistrarProveedor();
        } else
        if ($_GET['action'] == 'consultar') {
            return $controlador->GuiConsultarProveedor(null);
        } else
        if ($_GET['action'] == 'consultar2') {
            return $controlador->GuiConsultarProveedor("null");
        }
    }
    return $controlador->Home();
} else {
    return $controlador->Principal();
}

