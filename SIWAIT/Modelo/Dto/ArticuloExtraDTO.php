<?php

class ArticuloExtraDTO extends SucursalDTO{

    private $codigo;
    private $nombre;
    private $sucursal;
    private $cantidad;
    private $fEntrada;
    private $costo;
    private $valor;
    private $notas;
    //
    private $tipo;
    private $informacion;

    function getCodigo() {
        return $this->codigo;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getSucursal() {
        return $this->sucursal;
    }

    function getCantidad() {
        return $this->cantidad;
    }

    function getFEntrada() {
        return $this->fEntrada;
    }

    function getCosto() {
        return $this->costo;
    }

    function getValor() {
        return $this->valor;
    }

    function getNotas() {
        return $this->notas;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setSucursal($sucursal) {
        $this->sucursal = $sucursal;
    }

    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    function setFEntrada($fEntrada) {
        $this->fEntrada = $fEntrada;
    }

    function setCosto($costo) {
        $this->costo = $costo;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function setNotas($notas) {
        $this->notas = $notas;
    }

}
