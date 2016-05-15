<?php

require_once 'Control.php';
require_once '../Modelo/Fachada.php';

class ControlVenta extends Control {

    public function GuiRegistrarVenta() {
        ob_start();
        $pagina = $this->load_template("Registrar Venta");
        include "../Vista/Seccion/Venta/RVenta.html";
        $section = ob_get_clean();
        $pagina = $this->replace_content('/\#section\#/ms', $section, $pagina);
        $this->view_page($pagina);
    }

}
