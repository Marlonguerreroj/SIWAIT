<?php

class ArticuloSucursalDTO {

    private $referencia;
    private $sucursal;
    private $cantidad;
    private $apartados;
    private $valor;
    private $costoTransporte;
    private $costo;

    function getReferencia() {
        return $this->referencia;
    }

    function getSucursal() {
        return $this->sucursal;
    }

    function getCantidad() {
        return $this->cantidad;
    }

    function getApartados() {
        return $this->apartados;
    }

    function getValor() {
        return $this->valor;
    }

    function getCostoTransporte() {
        return $this->costoTransporte;
    }

    function getCosto() {
        return $this->costo;
    }

    function setReferencia($referencia) {
        $this->referencia = $referencia;
    }

    function setSucursal($sucursal) {
        $this->sucursal = $sucursal;
    }

    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    function setApartados($apartados) {
        $this->apartados = $apartados;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function setCostoTransporte($costoTransporte) {
        $this->costoTransporte = $costoTransporte;
    }

    function setCosto($costo) {
        $this->costo = $costo;
    }

}
