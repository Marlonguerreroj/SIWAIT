<?php

require '../Controlador/ControlManejoInicioSesion.php';

$controlador = new ControlManejoInicioSesion();

//inicia Sesion
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
//Verdadero si no hay sesion iniciada
if (empty($_SESSION)) {
    if (isset($_POST['enviar'])) {
        $user = $_POST['usuario'];
        $contraseña = $_POST['contraseña'];
        $valor = $controlador->IniciarSesion($user, $contraseña);

        if ($valor) {
            if ($valor[0][0] != "Vendedor" && $valor[0][1] != 1) {
                $_SESSION['usuario'] = $valor;
                $_SESSION['tiempo'] = time();
                return $controlador->Home();
            }
        } else {
            echo '<script language="javascript">alert("Verifique los datos");</script>';
            return $controlador->Principal();
        }
    }
    return $controlador->Principal();
} else {
    if ($_GET) {
        if ($_GET['action'] == 'cerrar') {

            //unset($_SESSION['usuario']);
            //unset($_SESSION['contraseña']);
            session_unset();
            session_destroy();
            return $controlador->Principal();
        }
        if ($_GET['action'] == 'home') {

            return $controlador->Home();
        }
    }
    $_SESSION['tiempo']= time();
    return $controlador->Home();
}
?>