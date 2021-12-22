<?php

class View {
    public static function render($view, $data = []) {
        // Convertir el array asociativo en un objeto
        $d = to_object($data); // $data en array_assoc o $d en objectos

        if(!is_file(VIEWS.CONTROLLER.DS.$view.'View.php')) {
            die('No existe la vista: '. $view.'View en la carpeta: '. CONTROLLER);
        } else {
            require_once VIEWS.CONTROLLER.DS.$view.'View.php';
            exit();
        }
    }
}