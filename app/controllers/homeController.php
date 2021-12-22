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

        echo '<pre>';
        try {
            // SELECT
            $sql = 'SELECT * FROM test WHERE id=:id AND name=:name';
            $resultado = Db::query($sql, ['id' => 1, 'name' => 'Julio Cervantes']);
            print_r($resultado);

            // INSERT
            $sql = 'INSERT INTO test (name, email, create_at) VALUES (:name, :email, :create_at)';
            $registro =
            [
                'name'      => 'Juanito',
                'email'     => 'juanito@correo.com',
                'create_at' => now()
            ];
            //$id = Db::query($sql, $registro);
            //print_r($id);

            // UPDATE
            $sql = 'UPDATE test SET name=:name, email=:email WHERE id=:id';
            $update = 
            [
                'id'        => 3,
                'name'      => 'Pedrito',
                'email'     => 'pedro@correo.com',
            ];
            //print_r(Db::query($sql, $update));

            // DELETE
            $sql = 'DELETE FROM test WHERE id=:id LIMIT 1';
            //print_r(Db::query($sql, ['id' => 4]));

            // ALTER TABLE
            // $sql = 'ALTER TABLE test ADD COLUMN username VARCHAR(255) NULL AFTER name';
            // print_r(Db::query($sql));

        } catch (Exception $e) {
            echo 'Hubo un error: '.$e->getMessage();
        }


        echo '</pre>';

        die;
        View::render('test');
    }

    function flash()
    {
        View::render('flash');
    }
}