<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php bloginfo('name'); ?> - <?php echo is_front_page() ? get_bloginfo('description') : get_the_title(); ?>
    </title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header class="site-header">
    <div class="container header-style">

        <!-- ✅ LOGO DYNAMIQUE -->
        <div class="site-logo">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <?php
                // Si un logo personnalisé est défini dans l’admin
                if (function_exists('the_custom_logo') && has_custom_logo()) {
                    the_custom_logo(); // ✅ Natif WordPress : insère automatiquement le logo
                } else {
                    // Sinon, on affiche le nom du site
                    echo '<h1>' . get_bloginfo('name') . '</h1>';
                }
                ?>
            </a>
        </div>

        <!-- ✅ MENU PRINCIPAL -->
        <nav class="main-navigation">
            <?php
            wp_nav_menu([
                'theme_location' => 'main_menu',  // ✅ Emplacement déclaré dans functions.php
                'container' => false,             // ❌ Pas de <div> automatique autour
                'menu_class' => 'main-menu'       // ✅ Classe CSS ajoutée au <ul>
            ]);
            ?>
        </nav>

    </div>
</header>
