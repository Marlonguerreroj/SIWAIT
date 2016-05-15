<?php

require_once 'Control.php';
require_once '../Modelo/Fachada.php';

class ControlPedido extends Control {

    public function registrarPedido($codigo, $proveedor, $fecha, $notas) {
        $fachada = new Fachada();
        $valor = $fachada->registrarPedido($codigo, $proveedor, $fecha, $notas);
        return $valor;
    }

    public function buscarPedido($tipo, $informacion) {
        $fachada = new Fachada();
        $valor = $fachada->buscarPedido($tipo, $informacion);
        return $valor;
    }
    public function buscarPedidoE($tipo, $referencia, $codigo) {
        $fachada = new Fachada();
        $valor = $fachada->buscarPedidoE($tipo, $referencia, $codigo);
        return $valor;
    }

    public function GuiRegistrarPedido() {
        ob_start();
        $pagina = $this->load_template("Registrar Pedido");
        include "../Vista/Seccion/Pedido/RPedido.html";
        $section = ob_get_clean();
        $pagina = $this->replace_content('/\#section\#/ms', $section, $pagina);
        $this->view_page($pagina);
    }
    public function GuiRegistrarComparacion() {
        ob_start();
        $pagina = $this->load_template("Registrar Comparacion");
        include "../Vista/Seccion/Comparacion/RComparacion.html";
        $section = ob_get_clean();
        $pagina = $this->replace_content('/\#section\#/ms', $section, $pagina);
        $this->view_page($pagina);
    }

    public function GuiConsultarPedido($valor) {
        if ($valor == "null") {
            $valor = $_SESSION['resultado'];
        } else {
            $_SESSION['resultado'] = $valor;
        }
        ob_start();
        $pagina = $this->load_template("Consultar Pedido");
        include "../Vista/Seccion/Pedido/CPedido.html";
        $section = ob_get_clean();
        $pagina = $this->replace_content('/\#section\#/ms', $section, $pagina);
        $this->view_page($pagina);
    }
    public function GuiMostrarPedido($valor) {
        $resultados = $valor;
        ob_start();
        $pagina = $this->load_template("Informacion del Pedido");
        include "../Vista/Seccion/Pedido/MPedido.html";
        $section = ob_get_clean();
        $pagina = $this->replace_content('/\#section\#/ms', $section, $pagina);
        $this->view_page($pagina);
    }
}
