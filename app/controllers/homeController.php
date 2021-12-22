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
}