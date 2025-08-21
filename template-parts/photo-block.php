
<article class="photo-card">
  <a href="<?php the_permalink(); ?>" class="photo-card__link">
    <?php if ( has_post_thumbnail() ) {
      the_post_thumbnail('medium', [
        'class' => 'photo-card__img',
        'alt'   => esc_attr( get_the_title() ),
      ]);
    } ?>
  </a>
</article>
