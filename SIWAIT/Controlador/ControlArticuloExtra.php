<?php

require_once 'Control.php';
require_once '../Modelo/Fachada.php';

Class ControlArticuloExtra extends Control {

    public function registrarArticuloExtra($codigo, $sucursal, $nombre, $cantidad, $fEntrada, $costo, $valorA, $notas) {
        $fachada = new Fachada();
        $valor = $fachada->registrarArticuloExtra($codigo, $sucursal, $nombre, $cantidad, $fEntrada, $costo, $valorA, $notas);
        return $valor;
    }

    public function buscarArticuloExtra($tipo, $informacion, $sucursal) {
        $fachada = new Fachada();
        $valor = $fachada->buscarArticuloExtra($tipo, $informacion, $sucursal);
        return $valor;
    }

    public function GuiRegistrarArticuloExtra() {
        ob_start();
        $pagina = $this->load_template("Registrar Articulo Extra");
        include "../Vista/Seccion/Articulo/RArticuloExtra.html";
        $section = ob_get_clean();
        $pagina = $this->replace_content('/\#section\#/ms', $section, $pagina);
        $this->view_page($pagina);
    }

    public function GuiConsultarArticuloExtra($valor) {
        if ($valor == "null") {
            $valor = $_SESSION['resultado'];
        } else {
            $_SESSION['resultado'] = $valor;
        } ob_start();
        $pagina = $this->load_template("Consultar Articulo Extra");
        include "../Vista/Seccion/Articulo/CArticuloExtra.html";
        $section = ob_get_clean();
        $pagina = $this->replace_content('/\#section\#/ms', $section, $pagina);
        $this->view_page($pagina);
    }
    public function GuiMostrarArticuloExtra($valor) {
        $resultados = $valor;
        ob_start();
        $pagina = $this->load_template("Informacion Articulo");
        include "../Vista/Seccion/Articulo/MArticuloExtra.html";
        $section = ob_get_clean();
        $pagina = $this->replace_content('/\#section\#/ms', $section, $pagina);
        $this->view_page($pagina);
    }
}
