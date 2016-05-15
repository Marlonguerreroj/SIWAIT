<?php

require_once 'ClienteDTO.php';

class EmpleadoDTO extends ClienteDTO {

    private $codigo;
    private $dni;
    private $sucursal;
    private $tipoEmpleado;
    private $contraseña;
    private $fIngreso;
    private $fSalida;
    private $celular;
    private $tipo;
    private $informacion;
    private $estado;

    function getEstado() {
        return $this->estado;
    }

    function setEstado($estado) {
        $this->estado = $estado;
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

    function getDni() {
        return $this->dni;
    }

    function getSucursal() {
        return $this->sucursal;
    }

    function getTipoEmpleado() {
        return $this->tipoEmpleado;
    }

    function getContraseña() {
        return $this->contraseña;
    }

    function getFIngreso() {
        return $this->fIngreso;
    }

    function getFSalida() {
        return $this->fSalida;
    }

    function getCelular() {
        return $this->celular;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setDni($dni) {
        $this->dni = $dni;
    }

    function setSucursal($sucursal) {
        $this->sucursal = $sucursal;
    }

    function setTipoEmpleado($tipoEmpleado) {
        $this->tipoEmpleado = $tipoEmpleado;
    }

    function setContraseña($contraseña) {
        $this->contraseña = $contraseña;
    }

    function setFIngreso($fIngreso) {
        $this->fIngreso = $fIngreso;
    }

    function setFSalida($fSalida) {
        $this->fSalida = $fSalida;
    }

    function setCelular($celular) {
        $this->celular = $celular;
    }

}
