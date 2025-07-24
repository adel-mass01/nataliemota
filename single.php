<?php 
// On récupère le haut de page
get_header(); 
?>

<main class="site-main">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <!-- Balise article adaptée car ici c’est bien un article -->
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <!-- Titre principal de l’article -->
            <h1><?php the_title(); ?></h1>

            <!-- Métadonnées de l’article : auteur et date -->
            <div class="post-meta">
                <p>Publié le <?php echo get_the_date(); ?> par <?php the_author(); ?></p>
            </div>

            <!-- Contenu complet de l’article -->
            <div class="entry-content">
                <?php the_content(); ?>
            </div>

            <!-- Si l’article est dans des catégories, on peut les afficher -->
            <div class="post-categories">
                <p>Catégories : <?php the_category(', '); ?></p>
            </div>

        </article>

    <?php endwhile; else : ?>

        <!-- Message si l’article est introuvable -->
        <p>Article introuvable.</p>

    <?php endif; ?>

</main>

<?php 
// On récupère le bas de page
get_footer(); 
?>
