<?php
    require '../../includes/app.php';

    use App\Propiedad;
    use Intervention\Image\ImageManagerStatic as Image;

    $db = conectarDB();
    $propiedad = new Propiedad; //Coloca el objeto totalmente vacio

    //Consultar para obtener los vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);

    //Arreglo con mensajes de errores
    $errores = Propiedad::getErrores();

    //Ejecuta el código despues de eque el usuario envia el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') { 

        //Crea una nueva instancia
        $propiedad = new Propiedad($_POST['propiedad']);
        
        /**Subida de archivos */
        // Generar un nombre unico
        $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";  
        
        // Settear imagen
        // Realiza un resize a la imagen con intervention
        if($_FILES['imagen']['tmp_name']) {
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
            $propiedad->setImagen($nombreImagen);
        }

        //Validar
        $errores = $propiedad->validar();
        
        // Revisar que el arreglo de errores este vacio
        if(empty($errores)) {
            
            
            //Crear la carpeta para subir imagenes
            if(!is_dir(CARPETA_IMAGENES)) {
                mkdir(CARPETA_IMAGENES);
            }
            
            //Guardar la imagen en el servidor
            $image->save(CARPETA_IMAGENES . $nombreImagen);
            
            //Guarda en la base de datos
            $resultado = $propiedad->guardar();   

            //Mensaje de exito o error
            if($resultado) {
                // Redireccionar al usuario si el registro es exitoso
                // Le pasamos informacion a la pagina de admin mediante querystring para mostrar que fue lo que se hizo
                header('Location: /admin?resultado=1');
            }
        }

    }

    incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Crear Propiedad</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach($errores as $error): ?>
    <div class="alerta error">
        <?php echo $error; ?>
    </div>
    <?php endforeach; ?>    

    <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_propiedades.php' ?>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">

    </form>
</main>


<?php
incluirTemplate('footer');
?>