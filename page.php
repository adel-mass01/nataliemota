<?php 
// On inclut le haut de page
get_header(); 
?>

<main class="site-main">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <!-- Section pour le contenu de la page -->
        <section id="page-<?php the_ID(); ?>" <?php post_class(); ?>>

            <!-- Titre de la page -->
            <h1><?php the_title(); ?></h1>

            <!-- Contenu principal de la page -->
            <div class="entry-content">
                <?php the_content(); ?>
            </div>

        </section>

    <?php endwhile; else : ?>

        <!-- Message si la page est vide ou introuvable -->
        <p>Page introuvable.</p>

    <?php endif; ?>

</main>

<?php 
// On inclut le bas de page
get_footer(); 
?>
