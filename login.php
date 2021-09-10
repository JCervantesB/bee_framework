<?php 
    require 'includes/config/database.php';
    $db = conectarDB();

    // Validacion con errores
    $errores = [];

    // Autenticar usuaro
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        $email = mysqli_real_escape_string( $db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) );

        $password = mysqli_real_escape_string($db, $_POST['password']);

        //Validando el error
        if(!$email) {
            $errores[] = "El email es obligatorio o no es válido";
        }
        if(!$password) {
            $errores[] = "La contraseña es obligatoria";
        }

        // Validar la cuenta
        if(empty($errores)) {
            // Revisar si el usuario existe
            $query = "SELECT * FROM usuarios WHERE email = '${email}' ";
            $resultado = mysqli_query($db, $query);
            
            if($resultado->num_rows) {

                // Revisar si el password es correcto
                $usuario = mysqli_fetch_assoc($resultado);

                // Verificar si el password es correcto o no
                $auth = password_verify($password, $usuario['password']);

                if($auth) {
                    //El usuario esta autenticado
                    session_start();

                    // Llenar el arreglo de la sesión
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;

                    header('Location: /admin');

                } else {
                    $errores[] = "La contraseña es incorrecta";
                }

            } else {
                $errores[] = "El usuario no existe";
            }
        
        }
    }

    // Incluye el header
    require 'includes/funciones.php';
    
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesion</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach ?>

        <form method="POST" class="formulario">

            <fieldset>
                <legend>Email y Password</legend>

                <label for="">E-Mail</label>
                <input name="email" type="email" placeholder="Tu Email" id="email" >
                
                <label for="">Contraseña</label>
                <input name="password" type="password" placeholder="Tu Contraseña" id="password" >
            </fieldset>
            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
        </form>

    </main>
    

<?php 
    incluirTemplate('footer');
?>  