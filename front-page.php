<?php
get_header();
?>

<main id="principal">

  <!-- IMAGE BANNER -->
  <section class="banner-img">
    <div class="hero">
      <?php echo get_the_post_thumbnail(78, 'full', [ 'class' => 'hero-banner-img', 'alt'=> get_the_title(78)]); ?>
      <div class="hero-text">
        <p>photographe event</p>
      </div>
    </div>
  </section>

  <section class="section-photo">

    <?php 
    // Prépare la requête des 8 IMAGES
    $the_query = new WP_Query([
        'post_type' =>'photo',
        'posts_per_page' => 8,
        'orderby' => 'date',
        'paged' => $page
    ]); 
    ?>

    <?php if($the_query->have_posts()) : ?>

      <section class="home-photos">
        <div class="grid-photo-home">

          

          <div class="filtres-photo">
            <!-- Filtre des catégories -->

            <div class="filtres-gauche">
              <select class="filtre-categorie">
                <option value="">CATÉGORIES</option>
                <?php 
                $categories = get_terms([ 
                    'taxonomy' => 'categorie-photo', 
                    'hide_empty' => false 
                ]);
                foreach ($categories as $cat): ?> 
                  <option value="<?php echo esc_attr($cat->term_id); ?>">  
                    <?php echo esc_html($cat->name); ?> 
                  </option>
                <?php endforeach; ?>
              </select>

              <!-- Filtres des formats -->
              <select class="filtre-format">
                <option value="">FORMATS</option>
                <?php
                $formats = get_terms([
                    'taxonomy' => 'format-photo',
                    'hide_empty' => false 
                ]); 
                foreach ($formats as $format): ?>
                  <option value="<?php echo esc_attr($format->term_id); ?>">  
                    <?php echo esc_html($format->name); ?> 
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <!-- Filtre "Trier Par date" -->
            <div class="filtre-droite">
              <select class="filtre-date">
                <option value="">TRIER PAR</option>
                <option value="DESC">Du plus récent au plus ancien</option>
                <option value="ASC">Du plus ancien au plus récent</option>
              </select>
            </div>
          </div>
          <!-- /FILtRES -->

          <!-- 8 IMAGES -->

          <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
            <?php get_template_part('template-parts/photo-block'); ?>
          <?php endwhile; ?>

          <!-- /8 IMAGES -->

        </div>
      </section>

      <?php wp_reset_postdata(); ?>

    <?php else : ?>
      <p class="not-found">Aucune photo trouvée. </p>
    <?php endif; ?>

    <!-- BOUTON CHARGER PLUS -->
    <div class="charger-plus">
      <button class="btn-charger-plus">Charger plus</button>
    </div>

  </section>

</main>

<?php
get_footer();
?>
