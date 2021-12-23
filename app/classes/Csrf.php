<?php

class Csrf {
    private $length = 32; // Longitud del token
    private $token; // Token
    private $token_expiration; // Fecha de expiración del token
    private $token_expiration_time = 60 * 5; // Tiempo de expiración del token: 5min

    // Crear nuestro token si no existe y es el primer ingeso al sitio
    public function __construct()
    {
        if (!isset($_SESSION['csrf_token'])) {
            $this->generate();
            $_SESSION['csrf_token'] = 
            [
                'token' => $this->token,
                'expiration' => $this->token_expiration
            ];
            return $this;
        }

        $this->token            = $_SESSION['csrf_token']['token'];
        $this->token_expiration = $_SESSION['csrf_token']['expiration'];
        
        return $this;
    }

    private function generate()
    {
        if(function_exists('bin2hex')) {
            $this->token = bin2hex(random_bytes($this->length)); //(PHP 7, PHP 8)
        } elseif (function_exists('mcrypt_create_iv')) {
            $this->token = bin2hex(mcrypt_create_iv($this->length, MCRYPT_DEV_RANDOM)); // Esta función está OBSOLETA en PHP 7.1.0. y ELIMINADA en PHP 7.2.0. 
        } else {
            $this->token = bin2hex(openssl_random_pseudo_bytes($this->length)); // (PHP 5 >= 5.3.0, PHP 7, PHP 8)
        }

        $this->token_expiration = time() + $this->token_expiration_time;
    }

    /**
     * Validar el token de la petición con el del sistema
     * 
     * @param string $csrf_token
     * @param boolean $validate_expiration
     * @return void
     */
    public static function validate($csrf_token, $validate_expiration = false)
    {
        $self = new self();

        // Validando el tiempo qde expiración del token
        if ($validate_expiration && $self->get_expiration() < time()) {
            return false;
        }
        if ($csrf_token !== $self->get_token()) {
            return false;
        }

        return true;
    }

    /**
     * Método para obtener el token
     * 
     * @return void
     */
    public function get_token()
    {
        return $this->token;
    }
    
    /**
     * Método para obtener la fecha de expiración del token
     * 
     * @return void
     */
    public function get_expiration()
    {
        return $this->token_expiration;
    }
}