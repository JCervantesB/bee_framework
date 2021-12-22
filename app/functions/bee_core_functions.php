<?php
// Este archivo contiene todas las funciones requeridas en este framework

function to_object($array) {
    // Convertir un array en un objeto
    return json_decode(json_encode($array));
}