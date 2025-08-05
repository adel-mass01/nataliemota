<footer class="site-footer">
    <div class="footer-style">
       
            <!-- MENU FOOTER -->
        <nav class="main-navigation-footer">
            <?php
                wp_nav_menu([
                    'theme_location' => 'main_footer', // Nom du menu (déclaré dans functions.php)
                    'container' => false, // On ne veut pas de balise <div> autour du menu
                    'menu_class' => 'main-footer' // Classe CSS ajoutée à la balise <ul>
                ]);
            ?>
        </nav>
        <!-- Affiche l’année actuelle automatiquement avec le nom du site -->
    </div>
</footer>
<?php get_template_part('templates_part/contact-modal'); ?>

<?php wp_footer(); ?>
<!-- Très important : WordPress insère ici les fichiers JS (ex : modale, plugin, etc.) -->

</body>
</html>
