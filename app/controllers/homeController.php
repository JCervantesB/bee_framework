<?php

class homeController {
    function __construct()
    {
        
    }

    function index()
    {
        $data = 
        [
            'title' => 'Bee Framework',
        ];

        View::render('bee', $data);
    }

    function test()
    {
        Flasher::new('Hola mundo soy  una notificación');
        Flasher::new('Hola mundo soy  una notificación', 'danger');
        Flasher::new('Hola mundo soy  una notificación', 'warning');
        View::render('test');
    }

    function flash()
    {
        View::render('flash');
    }
}