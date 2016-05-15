<?php

class ArticuloDTO extends SucursalDTO{

    private $referencia;
    private $nombre;
    private $tipoArticulo;
    //
    private $codigoPedido;
    private $cantidad;
    //
    private $tipo;
    private $informacion;
    function getCantidad() {
        return $this->cantidad;
    }

    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

        function getTipoArticulo() {
        return $this->tipoArticulo;
    }
    function getCodigoPedido() {
        return $this->codigoPedido;
    }

    function setCodigoPedido($codigoPedido) {
        $this->codigoPedido = $codigoPedido;
    }

        function setTipoArticulo($tipoArticulo) {
        $this->tipoArticulo = $tipoArticulo;
    }

    function getReferencia() {
        return $this->referencia;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getInformacion() {
        return $this->informacion;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setInformacion($informacion) {
        $this->informacion = $informacion;
    }

    function getNombre() {
        return $this->nombre;
    }

    function setReferencia($referencia) {
        $this->referencia = $referencia;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

}
