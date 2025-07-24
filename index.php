<?php get_header(); ?>

<main class="site-main">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <?php if (is_singular('page')) : ?>
            <!-- Si c'est une page, on utilise section -->
            <section id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h2><?php the_title(); ?></h2>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </section>

        <?php else : ?>
            <!-- Sinon (article, actu, etc.), on utilise article -->
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h2><?php the_title(); ?></h2>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </article>

        <?php endif; ?>

    <?php endwhile; else : ?>

        <p>Aucun contenu à afficher pour le moment.</p>

    <?php endif; ?>

</main>

<?php get_footer(); ?>
