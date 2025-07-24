<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<!-- Ceci est la balise HTML principale. `language_attributes()` permet d’ajouter automatiquement des attributs comme `lang="fr"` -->

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <!-- Définit l’encodage du site, généralement "UTF-8" -->

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Permet au site d’être responsive (adapté à tous les écrans) -->

    <title>
        
       <?php bloginfo('name'); ?> - <?php echo is_front_page() ? get_bloginfo('description') : get_the_title(); ?>

    </title>
    <!-- Affiche le nom du site + soit la description (si on est sur la page d’accueil), soit le titre de la page -->

    <?php wp_head(); ?>
    <!-- Très important : WordPress insère ici tous les styles, scripts et plugins nécessaires -->
</head>

<body <?php body_class(); ?>>
<!-- `body_class()` ajoute des classes dynamiques sur le body (ex : page-home, single-post...) -->

<header class="site-header">
    <div class="container">
        <!-- LOGO DU SITE -->
        <div class="site-logo">
            <a href="<?php echo home_url(); ?>">
                <!-- `home_url()` retourne l’URL de la page d’accueil -->
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" alt="<?php bloginfo('name'); ?>">
                
            </a>
        </div>

        <!-- MENU PRINCIPAL -->
        <nav class="main-navigation">
            <?php
                wp_nav_menu([
                    'theme_location' => 'main_menu', // Nom du menu (déclaré dans functions.php)
                    'container' => false, // On ne veut pas de balise <div> autour du menu
                    'menu_class' => 'main-menu' // Classe CSS ajoutée à la balise <ul>
                ]);
            ?>
        </nav>
    </div>
</header>
