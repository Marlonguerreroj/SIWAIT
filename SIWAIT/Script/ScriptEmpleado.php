<?php

require_once '../Controlador/ControlEmpleado.php';
require_once '../Controlador/ControlCliente.php';
$controlador = new ControlEmpleado();
$controlador2 = new ControlCliente();
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
        $valor = $controlador->buscarEmpleado($tipo, $informacion);
        if ($valor) {
            return $controlador->GuiConsultarEmpleado($valor);
        } else {
            echo '<script language="javascript">alert("No encontro datos");</script>';
            return $controlador->GuiConsultarEmpleado("null");
        }
    }

    if (isset($_POST['enviar'])) {
        $codigo = $_POST['codigo'];
        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $telefono = $_POST['telefono'];
        $celular = $_POST['celular'];
        $sucursal = $_POST['sel1'];
        $fIngreso = $_POST['fIngreso'];
        $direccion = $_POST['direccion'];
        $email = $_POST['email'];
        $contraseña = $_POST['contraseña'];
        $tipoEmpleado = $_POST['sel2'];

        $controlador2->registrarCliente($dni, $nombre, $apellido, $direccion, $telefono, $email);
        $valor = $controlador->registrarEmpleado($codigo, $dni, $celular, $sucursal, $fIngreso, $contraseña, $tipoEmpleado);
        if ($valor) {
            echo '<script language="javascript">alert("El empleado se registro '
            . 'satisfactoriamente");</script>';
            return $controlador->GuiRegistrarEmpleado();
        } else {
            echo '<script language="javascript">alert("No puede haber dos empleados con el mismo'
            . ' codigo");</script>';
            return $controlador->GuiRegistrarEmpleado();
        }
    }
    if (isset($_POST['enviar2'])) {
        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $telefono = $_POST['telefono'];
        $celular = $_POST['celular'];
        $sucursal = $_POST['sel1'];
        $fIngreso = $_POST['fIngreso'];
        $direccion = $_POST['direccion'];
        $email = $_POST['email'];
        $contraseña = $_POST['contraseña'];
        $tipoEmpleado = $_POST['sel2'];
        $estado = $_POST['radio'];
        if ($estado == 1) {
            $fecha = date('Y-m-d');
            $fSalida = $fecha;
        } else {
            $fSalida = null;
        }

        $controlador2->actualizarCliente($dni, $nombre, $apellido, $direccion, $telefono, $email);
        $valor = $controlador->actualizarEmpleado($dni, $celular, $sucursal, $fIngreso, $fSalida, $contraseña, $tipoEmpleado, $estado);
        if ($valor) {
            echo '<script language="javascript">alert("El empleado se actualizo '
            . 'satisfactoriamente");</script>';
            return $controlador->GuiConsultarEmpleado(null);
        } else {
            echo '<script language="javascript">alert("No puede haber dos empleados con el mismo'
            . ' codigo");</script>';
            return $controlador->GuiRegistrarEmpleado();
        }
    }

    if ($_GET && $dato[0][0] == "Jefe de Operaciones") {
        if (isset($_GET['dni'])) {
            $tipo = "Dni";
            $codigo = $_GET['dni'];
            $valor = $controlador->buscarEmpleado($tipo, $codigo);
            if ($valor) {
                return $controlador->GuiActualizarEmpleado($valor);
            } else {
                echo '<script language="javascript">alert("No pudo realizar la accion");</script>';
            }
        } else
        if (isset($_GET['dni2'])) {
            $tipo = "Dni";
            $codigo = $_GET['dni2'];
            $valor = $controlador->buscarEmpleado($tipo, $codigo);
            if ($valor) {
                return $controlador->GuiMostrarEmpleado($valor);
            } else {
                echo '<script language="javascript">alert("No pudo realizar la accion");</script>';
            }
        } else
        if ($_GET['action'] == 'registrar') {
            return $controlador->guiRegistrarEmpleado();
        } else
        if ($_GET['action'] == 'consultar') {
            return $controlador->GuiConsultarEmpleado(null);
        } else
        if ($_GET['action'] == 'consultar2') {
            return $controlador->GuiConsultarEmpleado("null");
        }
    }
    return $controlador->Home();
} else {
    return $controlador->Principal();
}

