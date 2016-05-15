<?php

require_once 'Control.php';
require_once '../Modelo/Fachada.php';

class ControlProveedor extends Control {

    public function buscarProveedor($tipo, $informacion) {
        $fachada = new Fachada();
        $valor = $fachada->buscarProveedor($tipo, $informacion);
        return $valor;
    }

    public function registrarProveedor($codigo, $nit, $nombre, $pagina, $telefono, $cuentaBancaria, $nCuentaBancaria, $nombreContacto, $email, $tipoCuenta) {
        $fachada = new Fachada();
        $valor = $fachada->registrarProveedor($codigo, $nit, $nombre, $pagina, $telefono, $cuentaBancaria, $nCuentaBancaria, $nombreContacto, $email, $tipoCuenta);
        return $valor;
    }
    public function actualizarProveedor($codigo, $nit, $nombre, $pagina, $telefono, $cuentaBancaria, $nCuentaBancaria, $nombreContacto, $email, $tipoCuenta) {
        $fachada = new Fachada();
        $valor = $fachada->actualizarProveedor($codigo, $nit, $nombre, $pagina, $telefono, $cuentaBancaria, $nCuentaBancaria, $nombreContacto, $email, $tipoCuenta);
        return $valor;
    }
    
    

    public function GuiRegistrarProveedor() {
        ob_start();
        $pagina = $this->load_template("Registrar Proveedor");
        include "../Vista/Seccion/Proveedor/RProveedor.html";
        $section = ob_get_clean();
        $pagina = $this->replace_content('/\#section\#/ms', $section, $pagina);
        $this->view_page($pagina);
    }

    public function GuiConsultarProveedor($valor) {
        if ($valor == "null") {
            $valor = $_SESSION['resultado'];
        } else {
            $_SESSION['resultado']= $valor;
        }
        ob_start();
        $pagina = $this->load_template("Consultar Proveedor");
        include "../Vista/Seccion/Proveedor/CProveedor.html";
        $section = ob_get_clean();
        $pagina = $this->replace_content('/\#section\#/ms', $section, $pagina);
        $this->view_page($pagina);
    }

    public function GuiActualizarProveedor($valor) {
        $resultados = $valor;
        ob_start();
        $pagina = $this->load_template("Actualizar Proveedor");
        include "../Vista/Seccion/Proveedor/AProveedor.html";
        $section = ob_get_clean();
        $pagina = $this->replace_content('/\#section\#/ms', $section, $pagina);
        $this->view_page($pagina);
    }
    public function GuiMostrarProveedor($valor) {
        ob_start();
        $pagina = $this->load_template("Informacion Proveedor");
        include "../Vista/Seccion/Proveedor/MProveedor.html";
        $section = ob_get_clean();
        $pagina = $this->replace_content('/\#section\#/ms', $section, $pagina);
        $this->view_page($pagina);
    }

}
