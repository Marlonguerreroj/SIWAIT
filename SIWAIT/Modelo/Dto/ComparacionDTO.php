<?php

class ComparacionDTO {

    private $codigo;
    private $sucursal;
    private $fecha;
    private $cantArticulos;
    private $cantUnidades;
    private $notas;
    private $pedido;
    private $referencia;

    function getPedido() {
        return $this->pedido;
    }

    function setPedido($pedido) {
        $this->pedido = $pedido;
    }

    function getReferencia() {
        return $this->referencia;
    }

    function setReferencia($referencia) {
        $this->referencia = $referencia;
    }

    function getCodigo() {
        return $this->codigo;
    }

    function getSucursal() {
        return $this->sucursal;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getCantArticulos() {
        return $this->cantArticulos;
    }

    function getCantUnidades() {
        return $this->cantUnidades;
    }

    function getNotas() {
        return $this->notas;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setSucursal($sucursal) {
        $this->sucursal = $sucursal;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setCantArticulos($cantArticulos) {
        $this->cantArticulos = $cantArticulos;
    }

    function setCantUnidades($cantUnidades) {
        $this->cantUnidades = $cantUnidades;
    }

    function setNotas($notas) {
        $this->notas = $notas;
    }

}
