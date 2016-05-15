<?php

require_once '../Controlador/ControlVenta.php';
$controlador = new ControlVenta();
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
    if ($_GET) {
        if (($_GET['action'] == 'registrar')) {
            return $controlador->guiRegistrarVenta();
        }
    }
} else {
    return $controlador->Principal();
}

