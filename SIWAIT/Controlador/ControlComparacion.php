<?php

require_once 'Control.php';
require_once '../Modelo/Fachada.php';

class ControlComparacion extends Control {

    public function registrarComparacion($codigo, $sucursal, $fecha, $notas,$cantArticulo,$cantUnidades){
        $fachada = new Fachada();
        $valor = $fachada->registrarComparacion($codigo, $sucursal, $fecha, $notas,$cantArticulo,$cantUnidades);
        return $valor;
    }
    public function registrarArticulosComparacion($referencia, $codigo, $cantidad){
        $fachada = new Fachada();
        $valor = $fachada->registrarArticulosComparacion($referencia, $codigo, $cantidad);
        return $valor;
    }
    public function registrarSeriales($codigo, $referencia, $sucursal,$pedido,$descripcion){
        $fachada = new Fachada();
        $valor = $fachada->registrarSeriales($codigo, $referencia, $sucursal,$pedido,$descripcion);
        return $valor;
    }
    


    public function GuiRegistrarComparacion($valor) {   
        ob_start();
        $pagina = $this->load_template("Registrar Comparacion");
        include "../Vista/Seccion/Comparacion/RComparacion.html";
        $section = ob_get_clean();
        $pagina = $this->replace_content('/\#section\#/ms', $section, $pagina);
        $this->view_page($pagina);
    }

}
