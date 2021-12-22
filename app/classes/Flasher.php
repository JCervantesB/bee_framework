<?php

use function PHPSTORM_META\type;

class Flasher {
    private $valid_types = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'];
    private $default = 'primary';
    private $type;
    private $msg;

    /**
     * Méthodo para guardar notifaicaciones flash
     * @param string array $msg
     * @param string $type
     * @return void
     */

    public static function new($msg, $type = null) {

        $self = new self();
        // Setear el tipo de notificación por defecto
        if($type === null) {
            $self->type = $self->default;
        } 
        
        $self->type = in_array($type, $self->valid_types) ? $type : $self->default;        

        // Guardar la notificación en un array de session
        if(is_array($msg)) {
            foreach($msg as $m) {
                $_SESSION[$self->type][] = $m;
            }

            return true;
        }

        $_SESSION[$self->type][] = $msg;

        return true;
    }

    /**
     * Renderiza las notificaciones a nuestro usuario
     * 
     * @return void
     */
    public static function flash() {

        $self = new self();
        $output = '';

        foreach ($self->valid_types as $type) {
            if(isset($_SESSION[$type]) && !empty($_SESSION[$type])) {
                foreach ($_SESSION[$type] as $m) {
                    $output .= '<div class="alert alert-'.$type.' alert-dismissible show fade" role="alert">';
                    $output .= $m;
                    $output .= '<button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                    <span arial-hidden="true">&times;</span></button>';
                    $output .= '</div>';
                }
                // Borar notificaciones una vez mostradas.
                unset($_SESSION[$type]);
            }
        }
        return $output;
    }
}