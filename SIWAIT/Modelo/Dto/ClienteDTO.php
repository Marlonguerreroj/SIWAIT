<?php

class ClienteDTO {

    private $dni;
    private $nombre;
    private $apellido;
    private $direccion;
    private $telefono;
    private $email;
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

    function getDni() {
        return $this->dni;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellido() {
        return $this->apellido;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getEmail() {
        return $this->email;
    }

    function setDni($dni) {
        $this->dni = $dni;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setEmail($email) {
        $this->email = $email;
    }

}
