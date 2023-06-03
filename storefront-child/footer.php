
</div><!-- .col-full -->
</div><!-- #content -->

<?php do_action( 'storefront_before_footer' ); ?>

<footer id="colophon" class="site-footer" role="contentinfo" style="background-color:transparent;">
<div class="col-full">

 
    <?php
    /**
     * Functions hooked in to storefront_footer action
     *
     * @hooked storefront_footer_widgets - 10
     * @hooked storefront_credit         - 20
     */
    do_action( 'storefront_footer' );
    ?>

</div><!-- .col-full -->
</footer><!-- #colophon -->




<?php do_action( 'storefront_after_footer' ); ?>

</div><!-- #page -->



<div style="display: flex; justify-content: center; align-items: center; padding-top:30px; padding-bottom-30px;">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/IMG/img3.png" alt="logo" style="width: 200px; height: 200px;   
    -webkit-box-pack: center;
    justify-content: center;
    margin-bottom: 8px;"/>
    </div>




<?php wp_footer(); ?>

</body>
</html>
