<?php

use App\Propiedad;
use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

require '../../includes/app.php';
    estaAutenticado();

    //Validar que sea un ID valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id)
        header('Location: /admin');
        
    //Obtener los datos de la propiedad
    $propiedad = Propiedad::find($id);

    //Consulta para obtener todos los vendedores
    //$vendedores = Vendedor::all();

    //Arreglo con mensaje de errores 
    $errores = Propiedad::getErrores();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        //Asignar los atributos
        $args = $_POST['propiedad'];
        $propiedad->sincronizar($args);

        $errores = $propiedad->validar();
        
        //Revisar que el arreglo de errores esté vacío
        if (empty($errores)) {
            
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                
                //Generar un nombre único
                $nombreImagen = md5( uniqid( rand(), true) ) . ".jpg";

                //Realiza un resize a la imagen con intervention
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);

                /*Setear la imagen*/
                $propiedad->setImagen($nombreImagen);

                //Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);
            }

            $propiedad->guardar();
        }   
    }

    incluirTemplate ('header'); 
    ?>
    
    <main class="contenedor seccion">
        <h1>Actualizar</h1>

        <a href="/admin" class="boton boton-verde">&larr; Volver</a>

        <?php foreach ($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" enctype="multipart/form-data">
            <?php include '../../includes/templates/formulario_propiedades.php';?>
            <div class="alinear-derecha">
                <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
            </div>
        </form>
    </main>

<?php incluirTemplate ('footer'); ?>