<?php

    //Validad por id Valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    //Si el id no es un entero, redirecciona a admin.php
    if (!$id) {
        header('Location: /');
    }
    // Importar la conexion a DB
    $db = conectarDB();
    // Consultar la DB
    $query = "SELECT * FROM propiedades WHERE id = ${id}";    

    // Obtener resultados
    $resultado = mysqli_query($db, $query);

    //Si no hay registros, redirecciona a la pagina principal
    if(!$resultado->num_rows) {
        header('Location: /');
    }

    $propiedad = mysqli_fetch_assoc($resultado);
?>

<main class="contenedor seccion contenido-centrado">
    
    <h1><?php echo $propiedad['titulo']; ?></h1>

    <img loading="lazy" src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="Anuncio">
    
    <div class="resumen-propiedad">
        <p class="precio">$<?php echo $propiedad['precio']; ?></p>
        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                <p><?php echo $propiedad['wc']; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                <p><?php echo $propiedad['estacionamiento']; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                <p><?php echo $propiedad['habitaciones']; ?></p>
            </li>
        </ul>
        <p>
        <?php echo $propiedad['descripcion']; ?>
        </p>
        
    </div>

</main>

<?php 
    // Cerrar la conexion
    mysqli_close($db);
?>