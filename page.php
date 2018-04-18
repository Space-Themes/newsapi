<?php get_header(); ?>

    <!-- Show Only News Images Start -->

    <div class="space-single-news-items relative">
        <?php themeslug_newsapi_data('us','sports',1); ?>
    </div>

    <!-- Show Only News Images End -->

    <!-- Show Full News Start -->

    <div class="space-single-full-news-items relative">
        <?php themeslug_newsapi_data('us','sports',2); ?>
    </div>

    <!-- Show Full News End -->


<?php get_footer(); ?>
