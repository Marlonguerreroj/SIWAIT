<?php

require_once 'Control.php';
require_once '../Modelo/Fachada.php';

class ControlCliente extends Control {

    public function buscarCliente($tipo, $informacion) {
        $fachada = new Fachada();
        $valor = $fachada->buscarCliente($tipo, $informacion);
        return $valor;
    }

    public function registrarCliente($dni, $nombre, $apellido, $direccion, $telefono, $email) {
        $Fachada = new Fachada();
        $valor = $Fachada->registrarCliente($dni, $nombre, $apellido, $direccion, $telefono, $email);
        return $valor;
    }

    public function actualizarCliente($dni, $nombre, $apellido, $direccion, $telefono, $email) {
        $Fachada = new Fachada();
        $valor = $Fachada->actualizarCliente($dni, $nombre, $apellido, $direccion, $telefono, $email);
        return $valor;
    }

    public function GuiRegistrarCliente() {
        ob_start();
        $pagina = $this->load_template("Registrar Cliente");
        include "../Vista/Seccion/Cliente/RCliente.html";
        $section = ob_get_clean();

        $pagina = $this->replace_content('/\#section\#/ms', $section, $pagina);
        $this->view_page($pagina);
    }

    public function GuiConsultarCliente($valor) {
        if ($valor == "null") {
            $valor = $_SESSION['resultado'];
        } else {
            $_SESSION['resultado'] = $valor;
        } ob_start();
        $pagina = $this->load_template("Consultar Cliente");
        include "../Vista/Seccion/Cliente/CCliente.html";
        $section = ob_get_clean();
        $pagina = $this->replace_content('/\#section\#/ms', $section, $pagina);
        $this->view_page($pagina);
    }

    public function GuiActualizarCliente($valor) {
        ob_start();
        $pagina = $this->load_template("Actualizar Cliente");
        include "../Vista/Seccion/Cliente/ACliente.html";
        $section = ob_get_clean();
        $pagina = $this->replace_content('/\#section\#/ms', $section, $pagina);
        $this->view_page($pagina);
    }

}
