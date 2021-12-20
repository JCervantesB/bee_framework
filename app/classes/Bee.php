<?php

class Bee {

    // Propiedades del framework
    private $framework = 'BeeFramework';
    private $version = '1.0.0';
    private $uri = [];

    // La función principal que se ejecuta al instanciar nuestra classe
    function __construct()
    {
        $this->init();
    }

    /**
     * Methodo para ejecutar cada "Methodo" de forma subsecuente
     * 
     * @return void
     * */
    private function init() {
        // Todos los methodos que queremos ejecutar consecutivamente.
        $this->init_session();
        $this->init_load_config();
        $this->init_load_function();
        $this->init_autoload();
    }

    /**
     * Mehtodo para iniciar la session en el sistema
     * 
     * @return void
     */
    private function init_session() {
        if(!isset($_SESSION)) {
            session_start();
        }
    }
    
    /**
     * Método para cargar la configuración del sistema
     * 
     * @return void
     */
    private function init_load_config() {
        // Cargar la configuración del sistema
        $file = 'bee_config.php';
        if(!is_file('app/config/'.$file)) {
            die(sprintf('El archivo %s no se encuentra, es requerido para que $s funcione correctamente', $file, $this->framework));
        }
        // Cargando archivo de configuración
        require_once 'app/config/'.$file;
        return;
    }

    /**
     * Método para cargar todas las funciones Core del sistema y del usuario
     * 
     * @return void
     */
    private function init_load_function() {
        // Cargar las funciones del sistema
        $file = 'bee_core_functions.php';
        if(!is_file(FUNCTIONS.$file)) {
            die(sprintf('El archivo %s no se encuentra, es requerido para que $s funcione correctamente', $file, $this->framework));
        }
        // Cargando archivo de funciones core
        require_once FUNCTIONS.$file;

        // Cargar las funciones del usuario
        $file = 'bee_custom_functions.php';
        if(!is_file(FUNCTIONS.$file)) {
            die(sprintf('El archivo %s no se encuentra, es requerido para que $s funcione correctamente', $file, $this->framework));
        }
        // Cargando archivo de funciones custom del usuario
        require_once FUNCTIONS.$file;

        return;
    }

    /**
     * Método para cargar todos los archivos de forma automatica
     * 
     * @return void
     */

    private function init_autoload(){
        require_once CLASSES.'Db.php';
        require_once CLASSES.'Model.php';
        require_once CLASSES.'Controller.php';   
        
        return;
    }



}