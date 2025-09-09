<footer class="site-footer">
    <div class="footer-style">
       
            <!-- MENU FOOTER -->
        <nav class="main-navigation-footer">
            <?php
                wp_nav_menu([
                    'theme_location' => 'main_footer', 
                    'container' => false, 
                    'menu_class' => 'main-footer' 
                ]);
            ?>
        </nav>
        
    </div>


    <!-- LIGHTBOX -->

<div class="lightbox">
     <button class="lightbox__close" aria-label="fermer">X</button>


     <div class="lightbox__container">
    
 <img src="">




</div>



<div class="lightbox__buttons">
      <button class="lightbox__next">suivant
        <img  class="fleche_next" alt="" src="<?php echo esc_url (get_template_directory_uri() . '/assets/img/arrow-right.svg'); ?>">
      </button>


       <button class="lightbox__prev">
        <img class="fleche_prev" alt="" src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/arrow-left.svg'); ?>">précedent
      </button>

            </div>













</footer>
<?php get_template_part('template-parts/contact-modal'); ?>

<?php wp_footer(); ?>


</body>
</html>
