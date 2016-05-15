<?php

class SucursalDTO {

    private $codigo;
    private $nombre;
    private $telefono;
    private $email;
    private $pagina;
    private $direccion;
    private $ciudad;
    private $pais;
    private $tipo;
    private $informacion;

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

    function getNombre() {
        return $this->nombre;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getEmail() {
        return $this->email;
    }

    function getPagina() {
        return $this->pagina;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getCiudad() {
        return $this->ciudad;
    }

    function getPais() {
        return $this->pais;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPagina($pagina) {
        $this->pagina = $pagina;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setCiudad($ciudad) {
        $this->ciudad = $ciudad;
    }

    function setPais($pais) {
        $this->pais = $pais;
    }

}
