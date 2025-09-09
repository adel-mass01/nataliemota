

<?php

// Récuperer les infos 

$post_id = get_the_ID();
$reference = get_field('reference_photo' , $post_id) ; 
$categorie = get_the_terms($post_id, 'categorie-photo');




?>




<article class="photo-card">
  <a href="<?php the_permalink(); ?>" class="photo-card__link">
    <?php if ( has_post_thumbnail() ) {
      the_post_thumbnail('medium', [
        'class' => 'photo-card__img',
        'alt'   => esc_attr( get_the_title() ),
      ]);
    } ?>
  </a>



<!-- OVERLAY SUR L'IMAGE -->  

<div class="photo-card__overlay">
  <div class="overlay__meta">

    <div class="icon_fullscreen_container"
       data-url="<?php echo esc_url(get_permalink(get_the_ID())); ?>"
       data-full="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID()), 'full'); ?>">
      <img class="icon_fullscreen" src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/Icon_agrandir.svg'); ?>">
    </div>

    <div class="icon_eye_container"
      data-url="<?php echo esc_url(get_permalink(get_the_ID())); ?>">
      <img class="icon_eye" src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/Icon_eye.svg'); ?>">
    </div>

    <span class="overlay__ref">Reférence : <?php echo esc_html($reference); ?></span>
    <span class="overlay__cat"><?php echo esc_html(implode(',', wp_list_pluck($categorie, 'name'))); ?></span>

  </div>
</div>

</article>
