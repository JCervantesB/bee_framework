<?php

class usersController {
    function __construct()
    {
        echo 'Ejecutando: ' . __CLASS__;
    }


    function ver($id = null) {
        echo sprintf('<h1>Ver usuario: %s</h1>', $id);
    }

    function crear() {
        echo 'En el método crear de la clase: ' . __CLASS__;
    }

    function editar() {
        echo 'En el método editar de la clase: ' . __CLASS__;
    }

    function eliminar() {
        echo 'En el método eliminar de la clase: ' . __CLASS__;
    }
}