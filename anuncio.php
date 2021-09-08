<?php 
    require 'includes/funciones.php';
    
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Casa en Venta frente al bosque</h1>

        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp">
            <source srcset="build/img/destacada.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada.jpg" alt="imagen de la propiedad">
        </picture>

        <div class="resumen-propiedad">
            <p class="precio">$3,000,000</p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                    <p>4</p>
                </li>
            </ul>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, fugit consequuntur quibusdam aliquam
                nesciunt, illo dolorem voluptatum inventore aliquid repudiandae debitis fuga error ipsam vitae unde
                cumque, facilis dolores. Reiciendis est veritatis sequi ea, autem enim mollitia inventore in laborum,
                assumenda, nulla dicta dolore porro blanditiis consectetur voluptas recusandae illum sed quia sapiente
                architecto possimus neque quas? Dignissimos, ad impedit?
            </p>
            <p>
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Veritatis tenetur ad adipisci voluptates amet
                accusantium voluptatum, neque alias tempora sint magnam rerum mollitia cumque, aut ut eligendi odit
                culpa voluptate quidem. Deserunt maiores error fugit est, laboriosam debitis incidunt numquam.
            </p>
        </div>
    </main>

<?php 
    incluirTemplate('footer'); 
?>  