<?php


// Récupération des champs ACF
$reference = get_field('reference_photo', get_the_ID());
$type      = get_field('type_photo', get_the_ID()) ;

// Récupération de l'année
$annee     = get_the_date('Y') ?: '';

// Récupération des taxonomies
$categories = get_the_terms(get_the_ID(), 'categorie-photo');
$formats    = get_the_terms(get_the_ID(), 'format-photo'); 

?>

<div class="single-photo-container">

<article id="post-<?php the_ID(); ?>" <?php post_class('content-header-photo'); ?>>

  <!-- info affichée  -->

  <div class="photo-info">
   <h1 class="photo-title"><?php echo get_the_title(); ?></h1>


    <div class="photo-meta">
      <?php if ($reference): ?>
        <p><strong>Référence :</strong> <?= esc_html($reference) ?></p>
      
      <?php endif; ?>

      <?php if (!empty($categories)): ?>
        <p><strong>Catégorie :</strong>
          <?= esc_html(implode(', ', wp_list_pluck($categories, 'name'))) ?>
        
        </p>
      <?php endif; ?>

      <?php if (!empty($formats)): ?>
        <p><strong>Format :</strong>
          <?= esc_html(implode(', ', wp_list_pluck($formats, 'name'))) ?>
        
        </p>
      <?php endif; ?>

      <?php if ($type): ?>
        <p><strong>Type :</strong> <?= esc_html($type) ?></p>
       
      <?php endif; ?>

      <?php if ($annee): ?>
        <p><strong>Année :</strong> <?= esc_html($annee) ?></p>
       
      <?php endif; ?>
    </div>
  </div>

<!-- image affichée -->  

  <div class="photo-image">
    <?php if ( has_post_thumbnail() ) {
      the_post_thumbnail();
    } ?>
  </div>

</article>

<div class="footer-photo">
<!-- bouton contact -->


<div class="contact-box">
  <p>Cette photo vous intéresse ?</p>
  <button class="open-modal-button btn-contact-single" data-ref="<?= esc_attr($reference); ?>">
    Contact
  </button>
</div>


<?php
// Navigation entre les photos
// Récupération des photos précédentes et suivantes
$post_précédent = get_previous_post();
$post_suivant   = get_next_post();

$prev_thumbnail = ($post_précédent) ? get_the_post_thumbnail_url($post_précédent->ID, 'thumbnail') : '';
$next_thumbnail = ($post_suivant)   ? get_the_post_thumbnail_url($post_suivant->ID,   'thumbnail') : '';
?>

<div class="photo-navigation">

  <!-- Précédent -->
  <?php if ($post_précédent): ?>
    <a class="nav-link prev-link" href="<?php echo esc_url( get_permalink($post_précédent->ID) ); ?>">
      <?php if ($prev_thumbnail): ?>
        <div class="thumbnail-preview">
          <img src="<?php echo esc_url($prev_thumbnail); ?>"
               alt="<?php echo esc_attr($post_précédent->post_title); ?>">
        </div>
      <?php endif; ?>
      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/arrow-left.svg"
           alt="Photo précédente" class="arrow-left">
    </a>
  <?php endif; ?>

  <!-- Suivant -->
  <?php if ($post_suivant): ?>
    <a class="nav-link next-link" href="<?php echo esc_url( get_permalink($post_suivant->ID) ); ?>">
      <?php if ($next_thumbnail): ?>
        <div class="thumbnail-preview">
          <img src="<?php echo esc_url($next_thumbnail); ?>"
               alt="<?php echo esc_attr($post_suivant->post_title); ?>">
        </div>
      <?php endif; ?>
      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/arrow-right.svg"
           alt="Photo suivante" class="arrow-right">
    </a>
  <?php endif; ?>
</div>

      </div>


<?php

// Récupérer les photos similaires

$my_id = get_the_ID();

// Récupérer les IDs de catégories de la photo actuelle
$term_ids = wp_get_post_terms($my_id, 'categorie-photo', ['fields' => 'ids']);

$myquery = new WP_Query([
  'post_type'      => 'photo',
  'posts_per_page' => 2,
  'post__not_in'   => [$my_id], 
  'tax_query'      => [
    [
      'taxonomy' => 'categorie-photo',
      'field'    => 'term_id',   
      'terms'    => $term_ids,   
    ],
  ],
]);

if ($myquery->have_posts()): ?>
  <section class="similar-photos">
    <h2>VOUS AIMEREZ AUSSI</h2>
    <div class="photo-grid">
      <?php while ($myquery->have_posts()): $myquery->the_post(); ?>
        <?php get_template_part('template-parts/photo-block'); ?>
      <?php endwhile; ?>
    </div>
  </section>
<?php endif; ?>
<?php wp_reset_postdata();  ?>

</div>

<?php
