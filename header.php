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

    <!--  LOGO DYNAMIQUE -->
    <div class="site-logo">
      <a href="<?php echo esc_url(home_url('/')); ?>">
        <?php
        if (function_exists('the_custom_logo') && has_custom_logo()) {
          the_custom_logo();
        } else {
          echo '<h1>' . get_bloginfo('name') . '</h1>';
        }
        ?>
      </a>
    </div>

    <div class="header-menu">
      <!--  MENU PRINCIPAL -->
      <nav class="main-navigation" aria-label="Navigation principale">
        <?php
        wp_nav_menu([
          'theme_location' => 'main_menu',
          'container'      => false,
          'menu_class'     => 'main-menu',
          'menu_id'        => 'main-menu'
        ]);
        ?>
      </nav>

      <!-- Bouton hamburger (sert aussi de croix quand .is-open) -->
      <button id="hamburger" class="hamburger-menu" type="button">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
      </button>
    </div>

  </div> 
</header>

<!-- Overlay plein écran (sous le header) -->
<div id="mobile-overlay" class="menu-overlay">
  <div class="menu-overlay-content">
    <?php
    wp_nav_menu([
      'theme_location' => 'main_menu',
      'container'      => false,
      'menu_class'     => 'mobile-menu',
      'menu_id'        => 'mobile-menu'
    ]);
    ?>
  </div>
</div>

