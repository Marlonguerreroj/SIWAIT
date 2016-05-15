<?php

abstract class Control {

    public function Principal() {
        //$pagina = $this->load_page('../Vista/Principal.html');
        //$this->view_page($pagina);
        ob_start();
        $pagina = $this->load_page('../Vista/Home.html');
        include '../Vista/Principal.html';
        $section = //$this->load_page("../Vista/Header.html");
                ob_get_clean();
        $pagina = $this->replace_content('/\#header\#/ms', "", $pagina);
        $pagina = $this->replace_content('/\#section\#/ms', $section, $pagina);
        $pagina = $this->replace_content('/\#title\#/ms', "Iniciar Sesion", $pagina);
        $this->view_page($pagina);

    }

    function load_template($title = 'Sin Titulo') {
        ob_start();
        $pagina = $this->load_page('../Vista/Home.html');
        include '../Vista/Header.html';
        $header = //$this->load_page("../Vista/Header.html");
                ob_get_clean();
        $pagina = $this->replace_content('/\#header\#/ms', $header, $pagina);
        $pagina = $this->replace_content('/\#title\#/ms', $title, $pagina);

        return $pagina;
    }

    function load_page($page) {
        return file_get_contents($page);
    }

    /* METODO QUE ESCRIBE EL CODIGO PARA QUE SEA VISTO POR EL USUARIO

     */

    function view_page($html) {
        echo $html;
    }

    function replace_content($in = '/\#CONTENIDO\#/ms', $out, $pagina) {
        return preg_replace($in, $out, $pagina);
    }

    public function Home() {
        $pagina = $this->load_template("HOME");
        $this->view_page($pagina);
    }

}
