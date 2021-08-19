<?php include 'includes/templates/header.php'; ?>

    <main class="contenedor seccion">
        <h1>Conoce sobre Nosotros</h1>

        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>
                    25 Años de experiencia
                </blockquote>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, quas repellat animi quos earum
                    corrupti quibusdam tenetur eum quia voluptas exercitationem quo laboriosam perferendis nam!
                    Suscipit, sapiente repellendus totam deserunt recusandae ratione asperiores eum dicta minima culpa
                    sunt, autem repellat in quas? Dolore itaque impedit minima blanditiis eaque, architecto hic
                    molestias, officiis modi id aut amet unde repellendus, voluptas saepe.
                </p>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis eligendi, quas dolores natus est
                    in assumenda incidunt ullam. Voluptate est repellendus sequi quaerat quo rerum aspernatur,
                    architecto doloribus quod, recusandae velit accusamus odit. 
                </p>
            </div>
        </div>
    </main>
    
    <section class="contenedor seccion">
        <h1>Más Sobre Nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Consectetur suscipit repellat libero fugiat
                    eum!
                    Tenetur quis commodi omnis?</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Consectetur suscipit repellat libero fugiat
                    eum!
                    Tenetur quis commodi omnis?</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>Tiempo</h3>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Consectetur suscipit repellat libero fugiat
                    eum!
                    Tenetur quis commodi omnis?</p>
            </div>
        </div>
    </section>

    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="nosotros.php">Nosotros</a>
                <a href="anuncios.php">Anuncios</a>
                <a href="blog.php">Blog</a>
                <a href="contacto.php">Contacto</a>
            </nav>
        </div>
        <p class="copyright">Todos los derechos reservados 2021 &copy;</p>
    </footer>

    <script src="build/js/bundle.min.js"></script>
</body>

</html>