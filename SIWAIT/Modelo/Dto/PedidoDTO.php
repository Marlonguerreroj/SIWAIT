<?php

class PedidoDTO {

    private $codigo;
    private $proveedor;
    private $fecha;
    private $notas;
    private $tipo;
    private $informacion;
    private $referencia;

    function getReferencia() {
        return $this->referencia;
    }

    function setReferencia($referencia) {
        $this->referencia = $referencia;
    }

    function getCodigo() {
        return $this->codigo;
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

    function getProveedor() {
        return $this->proveedor;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getNotas() {
        return $this->notas;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setProveedor($proveedor) {
        $this->proveedor = $proveedor;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setNotas($notas) {
        $this->notas = $notas;
    }

}
