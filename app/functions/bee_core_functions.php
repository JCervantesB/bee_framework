<?php
// Este archivo contiene todas las funciones requeridas en este framework

function to_object($array) {
    // Convertir un array en un objeto
    return json_decode(json_encode($array));
}

/**
 * Regresa el nombre de nuestra aplicación
 *
 * @return string
 */
function get_sitename() {
    return 'Bee Framework';
}

/**
 * Devuelve el email general del sistema
 *
 * @return string
 */
function get_siteemail() {
  return 'jslocal@localhost.com';
}

/**
 * Regresa la fecha de estos momentos
 *
 * @return string
 */
function now() {
  return date('Y-m-d H:i:s');
}

/**
 * Carga un recurso o imagen que esté directamente
 * en la carpeta de imágenes de bee framework
 *
 * @param string $filename
 * @return string
 */
function get_image($filename)
{
	if (!is_file(IMAGES_PATH.$filename)) {
		return IMAGES.'broken.png';
	}

	return IMAGES.$filename;
}

/**
 * Muestra en pantalla los valores pasados
 *
 * @param mixed $data
 * @return void
 */
function debug($data) {
  echo '<pre>';
  if(is_array($data) || is_object($data)) {
    print_r($data);
  } else {
    echo $data;
  }
  echo '</pre>';
}