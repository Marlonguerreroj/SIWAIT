<?php

class ProveedorDTO {

    private $codigo;
    private $nit;
    private $nombre;
    private $nCuentaBancaria;
    private $cuentaBancaria;
    private $pagina;
    private $nombreContacto;
    private $telefono;
    private $email;
    private $tipo;
    private $informacion;
    private $tipoCuenta;

    function getTipoCuenta() {
        return $this->tipoCuenta;
    }

    function setTipoCuenta($tipoCuenta) {
        $this->tipoCuenta = $tipoCuenta;
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

    function getCodigo() {
        return $this->codigo;
    }

    function getNit() {
        return $this->nit;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getNCuentaBancaria() {
        return $this->nCuentaBancaria;
    }

    function getCuentaBancaria() {
        return $this->cuentaBancaria;
    }

    function getPagina() {
        return $this->pagina;
    }

    function getNombreContacto() {
        return $this->nombreContacto;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getEmail() {
        return $this->email;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setNit($nit) {
        $this->nit = $nit;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setNCuentaBancaria($nCuentaBancaria) {
        $this->nCuentaBancaria = $nCuentaBancaria;
    }

    function setCuentaBancaria($cuentaBancaria) {
        $this->cuentaBancaria = $cuentaBancaria;
    }

    function setPagina($pagina) {
        $this->pagina = $pagina;
    }

    function setNombreContacto($nombreContacto) {
        $this->nombreContacto = $nombreContacto;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setEmail($email) {
        $this->email = $email;
    }

}
