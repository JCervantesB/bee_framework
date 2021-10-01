<?php 
    require '../../includes/app.php';
    use App\Vendedor;

    estaAutenticado();

    $vendedor = new Vendedor;

    //Arreglo con mensaje de errores 
    $errores = Vendedor::getErrores();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        //Crear una nueva instancia
        $vendedor = new Vendedor($_POST['vendedor']);

        //Validar que no haya campos vacios
        $errores = $vendedor->validar();

        if (empty($errores)) {
            $vendedor->guardar();
        }
    }

    incluirTemplate ('header'); 
    ?>

    <main class="contenedor seccion">
        <h1>Registrar vendedor(a)</h1>

        <a href="/admin" class="boton boton-verde">&larr; Volver</a>

        <?php foreach ($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form action="/admin/vendedores/crear.php" class="formulario" method="POST">
            <?php include '../../includes/templates/formulario_vendedores.php';?>
            <div class="alinear-derecha">
                <input type="submit" value="Registrar Vendedor" class="boton boton-verde">
            </div>
        </form>
    </main>

<?php incluirTemplate ('footer'); ?>