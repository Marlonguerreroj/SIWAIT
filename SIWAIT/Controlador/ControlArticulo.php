<?php

require_once 'Control.php';
require_once '../Modelo/Fachada.php';

Class ControlArticulo extends Control {

    public function registrarArticulo($referencia, $nombre, $tipo) {
        $fachada = new Fachada();
        $valor = $fachada->registrarArticulo($referencia, $nombre, $tipo);
        return $valor;
    }
    public function registrarPerdidaArticulo($referencia, $nombre, $tipo) {
        $fachada = new Fachada();
        $valor = $fachada->registrarPerdidaArticulo($referencia, $nombre, $tipo);
        return $valor;
    }

    public function registrarArticuloPedido($referencia, $cantidad, $codigoPedido) {
        $fachada = new Fachada();
        $valor = $fachada->registrarArticuloPedido($referencia, $cantidad, $codigoPedido);
        return $valor;
    }

    public function actualizarArticulo($referencia, $nombre, $tipo) {
        $fachada = new Fachada();
        $valor = $fachada->actualizarArticulo($referencia, $nombre, $tipo);
        return $valor;
    }

    public function buscarArticulo($tipo, $informacion, $sucursal) {
        $fachada = new Fachada();
        $valor = $fachada->buscarArticulo($tipo, $informacion, $sucursal);
        return $valor;
    }

    public function GuiRegistrarArticulo() {
        ob_start();
        $pagina = $this->load_template("Registrar Articulo");
        include "../Vista/Seccion/Articulo/RArticulo.html";
        $section = ob_get_clean();
        $pagina = $this->replace_content('/\#section\#/ms', $section, $pagina);
        $this->view_page($pagina);
    }

    public function GuiConsultarArticulo($valor) {
        if ($valor == "null") {
            $valor = $_SESSION['resultado'];
        } else {
            $_SESSION['resultado'] = $valor;
        } ob_start();
        $pagina = $this->load_template("Consultar Articulo");
        include "../Vista/Seccion/Articulo/CArticulo.html";
        $section = ob_get_clean();
        $pagina = $this->replace_content('/\#section\#/ms', $section, $pagina);
        $this->view_page($pagina);
    }

    public function GuiMostrarArticulo($valor) {
        $resultados = $valor;
        ob_start();
        $pagina = $this->load_template("Informacion Articulo");
        include "../Vista/Seccion/Articulo/MArticulo.html";
        $section = ob_get_clean();
        $pagina = $this->replace_content('/\#section\#/ms', $section, $pagina);
        $this->view_page($pagina);
    }

    public function GuiActualizarArticulo($valor) {
        ob_start();
        $pagina = $this->load_template("Actualizar Articulo");
        include "../Vista/Seccion/Articulo/AArticulo.html";
        $section = ob_get_clean();
        $pagina = $this->replace_content('/\#section\#/ms', $section, $pagina);
        $this->view_page($pagina);
    }

}
