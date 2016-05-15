<?php

require_once 'Control.php';
require_once '../Modelo/Fachada.php';

Class ControlArticuloSucursal extends Control {

    public function registrarArticuloSucursal($referencia, $sucursal, $cantidad, $cantidadApart, $valor0, $transporte, $costo) {
        $fachada = new Fachada();
        $valor = $fachada->registrarArticuloSucursal($referencia, $sucursal, $cantidad, $cantidadApart, $valor0, $transporte, $costo);
        return $valor;
    }
     public function actualizarArticuloSucursal($sucursal,$referencia,$costo,$transporte,$valorA) {
        $fachada = new Fachada();
        $valor = $fachada->actualizarArticuloSucursal($sucursal,$referencia,$costo,$transporte,$valorA);
        return $valor;
    }
}