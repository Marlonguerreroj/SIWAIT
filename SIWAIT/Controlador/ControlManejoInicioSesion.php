<?php

require_once '../Controlador/Control.php';
require_once '../Modelo/Fachada.php';

class ControlManejoInicioSesion extends Control {

    var $Fachada;

    function __construct() {
        $this->Fachada = new Fachada();
    }

    public function IniciarSesion($id, $contraseña) {
        $estado = $this->Fachada->IniciarSesion($id, $contraseña);
        return $estado;
    }

    

}
