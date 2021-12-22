<?php

class errorController {
    function __construct()
    {
        
    }

    function index()
    {
        $data = 
        [
            'title' => 'Pagina no encontrada',
        ];
        View::render('404', $data);
    }
}