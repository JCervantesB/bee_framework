<?php
/**
 * Bee Framework version 1.0.0
 * Desarrollado por: JCervantes en el curso Mini Framework PHP Joystick.com
 * Utilizando Github Copilot
 */

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
        $this->init_csrf();
        $this->dispatch();
    }

    /**
     * Mehtodo para iniciar la session en el sistema
     * 
     * @return void
     */
    private function init_session() {
        if(session_status() == PHP_SESSION_NONE) {
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
        require_once CLASSES.'Autoloader.php'; // Cargando el autoloader
        Autoloader::init();
        // require_once CLASSES.'Db.php';
        // require_once CLASSES.'Model.php';
        // require_once CLASSES.'View.php';
        // require_once CLASSES.'Controller.php';   
        //require_once CONTROLLERS.DEFAULT_CONTROLLER.'Controller.php';
        //require_once CONTROLLERS.DEFAULT_ERROR_CONTROLLER.'Controller.php';
        return;
    }

    /**
     * Método para crear un nuevo token de la sesion del usuario
     * 
     * @return void
     */
    private function init_csrf() {
        $csrf = new Csrf();
    }

    /**
     * Método para filtrar y descomponener los elementos de nuestra url y uri
     * 
     * @return void
     */
    private function filter_url() {
        if(isset($_GET['uri'])) {
            $this->uri = $_GET['uri'];
            $this->uri = rtrim($this->uri, '/');
            $this->url = filter_var($this->uri, FILTER_SANITIZE_URL);
            $this->uri = explode('/', strtolower($this->uri));
            return $this->uri;
        }
    }

    /**
     * Método para ejecutar y cargar de forma automatica los controladores solicitados por el usuario
     * Su método y pasar parametros a el
     * 
     * @return void
     */
    private function dispatch() {
        // Filtrar la URL y separar la URI
        $this->filter_url();

        /////////////////////////////////////////////////////////////////////////////////////////
        // Necesitamos saber si se está pasando el nombre de un controlador en nuestro URIm 
        // $this->uri[0] es el controlador en cuestión
        if(isset($this->uri[0])) {
            $current_controller = $this->uri[0]; // usuariosController.php
            // Borrar el index del array para obtener solamente los parametros.
            unset($this->uri[0]);
        } else {
            // Si no existe, cargar el controlador por defecto
            $current_controller = DEFAULT_CONTROLLER; // homeController.php
        }

        // Ejecución del controlador solicitado
        // Verificamos si existe una clase con el controlador solicitado
        $controller = $current_controller.'Controller'; // homeController
        if(!class_exists($controller)) {
            // Si no existe, cargar el controlador por defecto
            $controller = DEFAULT_ERROR_CONTROLLER.'Controller'; // errorController
            $current_controller = DEFAULT_ERROR_CONTROLLER; // Llamar la vista Error por defecto
        }
        /////////////////////////////////////////////////////////////////////////////////////////
        //Ejecución del método solicitado
        if(isset($this->uri[1])) {
            $method = str_replace('-', '_', $this->uri[1]); // Convierte un '-' en '_'
            // Existe o no el método dentro de la clase a ejecutar (controlador)
            if(!method_exists($controller, $method)) {
                $controller = DEFAULT_ERROR_CONTROLLER.'Controller'; // errorController
                $current_method = DEFAULT_METHOD; // index
                $current_controller = DEFAULT_ERROR_CONTROLLER; // Llamar la vista Error por defecto
            } else {
                // Si existe, cargar el método solicitado
                $current_method = $method;
            }

            unset($this->uri[1]);

        } else {
            $current_method = DEFAULT_METHOD; // index
        }
        /////////////////////////////////////////////////////////////////////////////////////////
        // Creando constantes para utilizar mas adelante
        define('CONTROLLER', $current_controller);
        define('METHOD'    , $current_method);

        /////////////////////////////////////////////////////////////////////////////////////////
        // Ejecutando controlador y método solicitado
        $controller = new $controller;
        
        // Obtener los parametros de la uri
        $params = array_values(empty($this->uri) ? [] : $this->uri);

        // Llamada al método que solicita el usuario en curso
        if(empty($params)) {
            call_user_func([$controller, $current_method]);
        } else {
            call_user_func_array([$controller, $current_method], $params);
        }

        return; // Linea final todo sucede entre esta linea y el comienzo

    }

    /**
     * Método correr nuestro framework
     * 
     * @return void
     */
    public static function fly() {
        $bee = new self();
        return;
    }
}