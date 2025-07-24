<?php 

function mon_theme_enqueue_styles() {
    wp_enqueue_script('mon-script-theme',get_template_directory_uri() . '/assets/js/script.js',[],null,true);
    wp_enqueue_style('mon-theme-style', get_template_directory_uri() . '/assets/css/style.css',[],filemtime(get_template_directory() . '/assets/css/style.css'));
}

add_action('wp_enqueue_scripts', 'mon_theme_enqueue_styles');

