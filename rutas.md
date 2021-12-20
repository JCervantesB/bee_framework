# Como funcionan nusetras rutas
Nuestro primer parametro sera el Controllador, seguido de un methodo y un parametro.

Ejemplo:
    controllador|metodo|parametro
    usuarios/ver/123
    productos/agregar

## Descomponiendo nuestra ruta
    1 -> Nombre del controlador
    2 -> Nombre del método del controlador
    3 -> Parametros a pasar

## index.php
    Todas las peticiones http pasarán por solamente el archivo index.php

## Parametro URI en la URL Solicitada
    La URL contentrá un parametro llamdo URI, será simplemente un string, no queremos ver "index.php?uri=controlador/metodo/123"
    Queremos "controlador/metodo/123" directamente.
    Ejemplo: https.dominio.com/producto/1

## .HTACCESS
    Instrucciones en Apache para decirle al servidor como tratar a nuestro archivo y las peticiones
    <IfModule mod_rewrite.c>
        RewriteEngine On
        RewriteEngine %{REQUEST_FILENAME} !-d
        RewriteEngine %{REQUEST_FILENAME} !-f
        RewriteRule ^(.+)$ index.php?uri=$1 [QSA,L]
    </IfModule>
