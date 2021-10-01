<?php 
    require '../includes/app.php';
    estaAutenticado();

    //Importar clases
    use App\Propiedad;
    use App\Vendedor;

    //Implementar un método para obtener todas las propiedades
    $propiedades = Propiedad::all();
    $vendedores = Vendedor::all();
    $tipo = '';

    //Muestra Mensaje condicional
    $resultado = $_GET['resultado'] ?? null;
    $urlId = $_GET['id'] ?? null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        //Validar ID
        if ($id) {
            $tipo = $_POST['tipo'];
            if(validarTipoContenido($tipo)){
                //Compara lo que vamos a eliminar
                if ($tipo === 'propiedad') {
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }else if($tipo === 'vendedor'){
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }
            }
        }
    }

    //Incluye un template
    incluirTemplate ('header'); 
    ?>
    
    <main class="contenedor seccion">
        <h1>Administrados de Bienes Raices</h1>
        <?php 
            $mensaje = mostrarNotificacion( intval($resultado) );
            if ($mensaje && intval($resultado) === 1): ?>
                <p class="alerta exito"><?php echo $_GET['tipo']." ".sane($mensaje)?></p>
            <?php elseif ($mensaje): ?>
                <p class="alerta exito"><?php echo $_GET['tipo']." ".$urlId." ".sane($mensaje)?></p>
        <?php endif; ?>

        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
        <a href="/admin/vendedores/crear.php" class="boton boton-amarillo">Nuevo(a) Vendedor</a>
        <h2>Propiedades</h2>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>  <!--Mostrar los resultados-->
                <?php foreach( $propiedades as $propiedad): ?>
                    <tr>
                        <td><?php echo $propiedad->id; ?></td>
                        <td><?php echo $propiedad->titulo; ?></td>
                        <td><img src="/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla" alt=""></td>
                        <td><?php echo "$". $propiedad->precio; ?></td>
                        <td>
                            <form method="POST" class="w-100">
                                <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                                <input type="hidden" name="tipo" value="propiedad">
                                <input type="submit" class="boton-rojo-block" value="Eliminar">
                            </form>
                            <!-- <img src="/build/img/trash-alt.svg" class="icono-boton"> -->
                                
                            </a>
                            <a href="propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">
                                <img src="/build/img/edit.svg" class="icono-boton editar">
                                Actualizar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Vendedores</h2>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>  <!--Mostrar los resultados-->
                <?php foreach( $vendedores as $vendedor): ?>
                    <tr>
                        <td><?php echo $vendedor->id; ?></td>
                        <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                        <td><?php echo $vendedor->telefono; ?></td>
                        <td>
                            <form method="POST" class="w-100">
                                <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                                <input type="hidden" name="tipo" value="vendedor">
                                <input type="submit" class="boton-rojo-block" value="Eliminar">
                            </form>
                            <!-- <img src="/build/img/trash-alt.svg" class="icono-boton"> -->
                                
                            </a>
                            <a href="vendedores/actualizar.php?id=<?php echo $vendedor->id; ?>" class="boton-amarillo-block">
                                <img src="/build/img/edit.svg" class="icono-boton editar">
                                Actualizar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

<?php 
    incluirTemplate ('footer'); 
    ?>