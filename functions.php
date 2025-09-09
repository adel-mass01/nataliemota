<?php
/**
 * Enqueue des styles & scripts du thème.
 * - CSS global
 * - JS global
 * - Librairie Choices (uniquement en home)
 * - Scripts front AJAX (bouton, filtres, lightbox, tri)
 * - Injection de l’URL admin-ajax.php dans plusieurs scripts (NM_AJAX.ajax_url)
 */
function mon_theme_enqueue_styles() {
  // CSS global (versionné via filemtime pour casser le cache)
  wp_enqueue_style(
    'mon-theme-style',
    get_template_directory_uri() . '/assets/css/style.css',
    [],
    filemtime( get_template_directory() . '/assets/css/style.css' )
  );

  // JS global
  wp_enqueue_script(
    'mon-script-theme',
    get_template_directory_uri() . '/assets/js/script.js',
    ['jquery'],
    filemtime( get_template_directory() . '/assets/js/script.js' ),
    true
  );

  // --- Assets spécifiques à la page d’accueil ---
  if ( is_front_page() ) {
    // Choices.css (CDN)
    wp_enqueue_style(
      'choices',
      'https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css',
      [],
      null
    );
    // Choices.js (CDN)
    wp_enqueue_script(
      'choices',
      'https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js',
      [],
      null,
      true
    );
  }

  // Bouton "Charger plus"
  wp_enqueue_script(
    'btn-ajax-front',
    get_template_directory_uri() . '/assets/js/btn-ajax-front-page.js',
    ['jquery'],
    filemtime( get_template_directory() . '/assets/js/btn-ajax-front-page.js' ),
    true
  );

  // Filtre Catégorie (dépend de Choices)
  wp_enqueue_script(
    'filtre-ajax-front',
    get_template_directory_uri() . '/assets/js/filtre-ajax-front-page.js',
    ['jquery','choices'],
    filemtime( get_template_directory() . '/assets/js/filtre-ajax-front-page.js' ),
    true
  );

  // Filtre Format (dépend de Choices)
  wp_enqueue_script(
    'format-ajax-front',
    get_template_directory_uri() . '/assets/js/format-ajax-front-page.js',
    ['jquery','choices'],
    filemtime( get_template_directory() . '/assets/js/format-ajax-front-page.js' ),
    true
  );

  // Lightbox (gestion overlay/plein écran)
  wp_enqueue_script(
    'lightbox',
    get_template_directory_uri() . '/assets/js/lightbox.js',
    ['jquery'],
    filemtime( get_template_directory() . '/assets/js/lightbox.js' ),
    true
  );

  // Filtre tri par date (ASC/DESC)
  wp_enqueue_script(
    'filtre-tri-front',
    get_template_directory_uri() . '/assets/js/filtre-tri-front-page.js',
    [],
    filemtime( get_template_directory() . '/assets/js/filtre-tri-front-page.js' ),
    true
  );

  // Expose l’URL AJAX côté JS (NM_AJAX.ajax_url) pour chaque script qui en a besoin
  wp_localize_script('btn-ajax-front',    'NM_AJAX', ['ajax_url' => admin_url('admin-ajax.php')]);
  wp_localize_script('filtre-ajax-front', 'NM_AJAX', ['ajax_url' => admin_url('admin-ajax.php')]);
  wp_localize_script('format-ajax-front', 'NM_AJAX', ['ajax_url' => admin_url('admin-ajax.php')]);
  wp_localize_script('filtre-tri-front',  'NM_AJAX', ['ajax_url' => admin_url('admin-ajax.php')]);
}
add_action('wp_enqueue_scripts', 'mon_theme_enqueue_styles');


/**
 * Réglages du thème : logo personnalisé + menus
 */
function mon_theme_setup() {
  add_theme_support('custom-logo');
  register_nav_menus([
    'main_menu'   => 'Menu principal',
    'main_footer' => 'Menu pied de page'
  ]);
}
add_action('after_setup_theme', 'mon_theme_setup');


/**
 * AJAX – Bouton "Charger plus"
 * Action JS attendue : action=request_ajax_grid & page={n}
 * Retour : blocs HTML via template-parts/photo-block
 */
add_action('wp_ajax_request_ajax_grid', 'request_ajax_grid');
add_action('wp_ajax_nopriv_request_ajax_grid', 'request_ajax_grid');

function request_ajax_grid() {
  // Page courante envoyée par JS
  $page = $_POST['page'];

  // Requête des posts de type "photo" paginés par 8
  $query2 = new WP_Query([
    'post_type'      => 'photo',
    'paged'          => $page,
    'posts_per_page' => 8
  ]);

  // Sortie HTML des cartes (partiel réutilisable)
  if ($query2->have_posts()) {
    while ($query2->have_posts()) {
      $query2->the_post();
      get_template_part('template-parts/photo-block');
    }
  }

  wp_reset_postdata();
  wp_die(); // Fin de la requête AJAX
}


/**
 * AJAX – Filtre par Catégorie uniquement
 * Action JS attendue : action=request_ajax_filtre & categorie={term_id} & page & per_page
 * (Trie par date si une catégorie est sélectionnée sinon aléatoire)
 */
add_action('wp_ajax_request_ajax_filtre', 'request_ajax_filtre');
add_action('wp_ajax_nopriv_request_ajax_filtre', 'request_ajax_filtre');

function request_ajax_filtre() {
  $page      = $_POST['page'];
  $per_page  = $_POST['per_page'];
  $categorie = $_POST['categorie'];

  // Base de la requête
  $args = [
    'post_type'      => 'photo',
    'posts_per_page' => $per_page,
    'paged'          => $page,
    'order'          => 'DESC',
    'orderby'        => empty($categorie) ? 'rand' : 'date',
  ];

  // Si une catégorie est fournie → filtrage par taxonomie
  if (!empty($categorie)) {
    $args['tax_query'] = [[
      'taxonomy' => 'categorie-photo',
      'field'    => 'term_id',
      'terms'    => $categorie,
    ]];
  }

  $query = new WP_Query($args);

  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();
      get_template_part('template-parts/photo-block');
    }
  } else {
    echo '<p>Aucune photo trouvée.</p>';
  }

  wp_reset_postdata();
  wp_die();
}


/**
 * AJAX – Filtre par Format uniquement
 * Action JS attendue : action=request_ajax_format & format={term_id} & page & per_page
 * (Trie par date si un format est sélectionné sinon aléatoire)
 */
add_action('wp_ajax_request_ajax_format', 'request_ajax_format');
add_action('wp_ajax_nopriv_request_ajax_format', 'request_ajax_format');

function request_ajax_format() {
  $page     = $_POST['page'];
  $per_page = $_POST['per_page'];
  $format   = $_POST['format'];

  // Base de la requête
  $args = [
    'post_type'      => 'photo',
    'posts_per_page' => $per_page,
    'paged'          => $page,
    'order'          => 'DESC',
    'orderby'        => empty($format) ? 'rand' : 'date',
  ];

  // Si un format est fourni → filtrage par taxonomie
  if (!empty($format)) {
    $args['tax_query'] = [[
      'taxonomy' => 'format-photo',
      'field'    => 'term_id',
      'terms'    => $format,
    ]];
  }

  $query = new WP_Query($args);

  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();
      get_template_part('template-parts/photo-block');
    }
  } else {
    echo '<p>Aucune photo trouvée.</p>';
  }

  wp_reset_postdata();
  wp_die();
}


/**
 * AJAX – Filtre combiné (Catégorie, Format) + Tri par date (ASC/DESC)
 * Action JS attendue :
 *   action=request_ajax_filtre
 *   & categorie={term_id|0}
 *   & format={term_id|0}
 *   & order={ASC|DESC}
 *   & page
 *   & per_page
 */
add_action('wp_ajax_request_ajax_filtre',        'request_ajax_filtre_handler');
add_action('wp_ajax_nopriv_request_ajax_filtre', 'request_ajax_filtre_handler');

function request_ajax_filtre_handler() {
  // Récupération/validation basique des paramètres
  $cat_id    = isset($_POST['categorie']) ? (int) $_POST['categorie'] : 0;
  $format_id = isset($_POST['format'])    ? (int) $_POST['format']    : 0;
  $order     = isset($_POST['order'])     ? strtoupper($_POST['order']) : 'DESC';
  $page      = isset($_POST['page'])      ? (int) $_POST['page']      : 1;
  $per_page  = isset($_POST['per_page'])  ? (int) $_POST['per_page']  : 8;

  // Sécurise la valeur de tri
  if ($order !== 'ASC' && $order !== 'DESC') {
    $order = 'DESC';
  }

  // Requête principale
  $args = [
    'post_type'      => 'photo',
    'posts_per_page' => $per_page,
    'paged'          => max(1, $page),
    'orderby'        => 'date',
    'order'          => $order,
    'no_found_rows'  => true, // perf : pas de comptage total
  ];

  // Construction d’un éventuel tax_query combiné
  $tax_query = [];
  if ($cat_id) {
    $tax_query[] = [
      'taxonomy' => 'categorie-photo',
      'field'    => 'term_id',
      'terms'    => [$cat_id],
    ];
  }
  if ($format_id) {
    $tax_query[] = [
      'taxonomy' => 'format-photo',
      'field'    => 'term_id',
      'terms'    => [$format_id],
    ];
  }
  if (!empty($tax_query)) {
    $args['tax_query'] = $tax_query;
  }

  // Exécution et rendu
  $q = new WP_Query($args);

  if ($q->have_posts()) {
    while ($q->have_posts()) {
      $q->the_post();
      get_template_part('template-parts/photo-block');
    }
    wp_reset_postdata();
  } else {
    echo '<p class="not-found">Aucune photo trouvée.</p>';
  }

  wp_die();
}
