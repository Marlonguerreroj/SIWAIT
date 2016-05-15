<?php

require_once '../Controlador/ControlComparacion.php';
require_once '../Controlador/ControlPedido.php';
require_once '../Controlador/ControlArticulo.php';
require_once '../Controlador/ControlArticuloSucursal.php';
$controlador = new ControlComparacion;
$controlador2 = new ControlPedido;
$controlador3 = new ControlArticuloSucursal;
+session_start();
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
}if (!empty($_SESSION)) {
    $_SESSION['tiempo'] = time();

    if (isset($_POST['enviarComparacion'])) {
        $codigo = $_POST['codigo'];
        $sucursal = $_POST['sel1'];
        $fecha = $_POST['fecha'];
        $notas = $_POST['notas'];
        $cantArticulo = $_POST['articulos'];
        $cantUnidades = $_POST['unidades'];
        $valor = $controlador->registrarComparacion($codigo, $sucursal, $fecha, $notas, $cantArticulo, $cantUnidades);

        if (!empty($_POST['referencia']) && is_array($_POST['referencia'])) {
            if (!empty($_POST['cantidad']) && is_array($_POST['cantidad'])) {
                if (!empty($_POST['valor']) && is_array($_POST['valor'])) {
                    if (!empty($_POST['valorTrans']) && is_array($_POST['valorTrans'])) {
                        if (!empty($_POST['costo']) && is_array($_POST['costo'])) {
                            $referencia = $_POST['referencia'];
                            $cantidad = $_POST['cantidad'];
                            $valor = $_POST['valor'];
                            $valorTrans = $_POST['valorTrans'];
                            $costo = $_POST['costo'];
                            foreach ($referencia as $index => $referencia2) {
                                $valor2 = $controlador->registrarArticulosComparacion($referencia2, $codigo, $cantidad[$index]);
                                $valor3 = $controlador3->registrarArticuloSucursal($referencia2, $sucursal, $cantidad[$index], 0, $valor[$index], $valorTrans[$index], $costo[$index]);
                                
                            }
                            if ($valor2) {
                                echo '<script language="javascript">alert("Registro Exitoso");</script>';
                                return $controlador2->GuiConsultarPedido("null");
                            } else {
                                echo '<script language="javascript">alert("false");</script>';
                            }
                        }
                    }
                }
            }
        }
    }

    if ($_GET) {
        if (isset($_GET['codigo'])) {
            $codigo = $_GET['codigo'];
            $valor = $controlador2->buscarPedido("CodigoPedi", $codigo);
            return $controlador->guiRegistrarComparacion($valor);
        }
    }
} else {
    return $controlador->Principal();
}    