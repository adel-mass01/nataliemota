<footer class="site-footer">
    <div class="container">
        <!-- Le texte du footer -->
        <p>&copy; <?php echo date('Y'); ?> - <?php bloginfo('name'); ?>. Tous droits réservés.</p>
            <!-- MENU FOOTER -->
        <nav class="main-navigation">
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

<?php wp_footer(); ?>
<!-- Très important : WordPress insère ici les fichiers JS (ex : modale, plugin, etc.) -->

</body>
</html>
