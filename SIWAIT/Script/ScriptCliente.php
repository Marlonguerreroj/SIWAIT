<?php

require_once '../Controlador/ControlCliente.php';
$controlador = new ControlCliente();
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
        $valor = $controlador->buscarCliente($tipo, $informacion);
        if ($valor) {
            return $controlador->GuiConsultarCliente($valor);
        } else {
            echo '<script language="javascript">alert("No encontro datos");</script>';
            return $controlador->GuiConsultarCliente("null");
        }
    }

    if (isset($_POST['buscar2'])) {
        if (!empty($_POST['informacion'])) {
            $tipo = $_POST['sel'];
            $informacion = $_POST['informacion'];
            $valor = $controlador->buscarCliente($tipo, $informacion);
            if ($valor) {
                return $controlador->GuiActualizarCliente($valor);
            } else {
                echo '<script language="javascript">alert("No encontro datos");</script>';
            }
        } else {
            echo '<script language="javascript">alert("Llene los campos");</script>';
        }
    }

    if (isset($_POST['enviar'])) {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $dni = $_POST['dni'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $email = $_POST['email'];

        $valor = $controlador->registrarCliente($dni, $nombre, $apellido, $direccion, $telefono, $email);
        if ($valor) {
            echo '<script language="javascript">alert("El cliente se registro '
            . 'satisfactoriamente");</script>';
            return $controlador->GuiRegistrarCliente();
        } else {
            echo '<script language="javascript">alert("No puede haber dos clientes con el mismo'
            . ' dni");</script>';
            return $controlador->GuiRegistrarCliente();
        }
    }
    if (isset($_POST['enviar2'])) {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $dni = $_POST['dni'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $email = $_POST['email'];

        $valor = $controlador->actualizarCliente($dni, $nombre, $apellido, $direccion, $telefono, $email);
        if ($valor) {
            echo '<script language="javascript">alert("El cliente se actualizo '
            . 'satisfactoriamente");</script>';
            return $controlador->GuiConsultarCliente(null);
        } else {
            echo '<script language="javascript">alert("No puede haber dos clientes con el mismo'
            . ' dni");</script>';
            return $controlador->GuiRegistrarCliente();
        }
    }

    if ($_GET) {
        if (isset($_GET['dni'])) {
            $tipo = "Dni";
            $dni = $_GET['dni'];
            $valor = $controlador->buscarCliente($tipo, $dni);
            if ($valor) {
                return $controlador->GuiActualizarCliente($valor);
            } else {
                echo '<script language="javascript">alert("No pudo realizar la accion");</script>';
            }
        } else
        if ($_GET['action'] == 'registrar') {
            return $controlador->GuiRegistrarCliente();
        } else
        if ($_GET['action'] == 'consultar') {
            return $controlador->GuiConsultarCliente(null);
        } else
        if ($_GET['action'] == 'consultar2') {
            return $controlador->GuiConsultarCliente("null");
        }
    }
    return $controlador->Home();
} else {
    return $controlador->Principal();
}

