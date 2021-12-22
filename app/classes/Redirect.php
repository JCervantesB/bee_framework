<?php

// Redirecciona a una URL especifica

class Redirect {
    private $location;

    /**
     * Método para redireccionar al usuario a una sección especifica
     */
    public static function to($location) {

        $self = new self();
        $self->location = $location;

        // Si las cabeceras ya fueron enviadas, redireccionamos con javascript
        if(headers_sent()) {
            echo '<script type="text/javascript">';
            echo 'window.location.href="'.URL.$self->location.'";';
            echo '</script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="0;url='.URL.$self->location.'" />';
            echo '</noscript>';
            die();
        } 
        // Cuando pasamos una url externa a nuestro sitio
        if(strpos($self->location, 'http') !== false) {
            header('Location: '.$self->location);
            die();
        }

        // Redirigir al usuario a otra sección
        header('Location: '.URL.$self->location);
        die();
    }
}