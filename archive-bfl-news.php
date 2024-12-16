<?php
get_header();
?>

<main id="primary" class="site-main">

    <header class="page-header">
        <?php
        the_archive_title( '<h1 class="page-title">', '</h1>' );
        the_archive_description( '<div class="archive-description">', '</div>' );
        ?>
    </header><!-- .page-header -->

    <div id="news-container">
        <!-- initial loading -->
        <?php
        $initial_posts = 3; // the number of posts to initially load
        $args = [
            'post_type' => 'bfl-news',
            'posts_per_page' => $initial_posts,
        ];
        $query = new WP_Query($args);

        if ($query->have_posts()) :
            while ($query->have_posts()) :
                $query->the_post();
                ?>
                <div class="news-item">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="news-image">
                            <?php echo wp_get_attachment_image(get_post_thumbnail_id(), 'thumbnail', false, [
                                'style' => 'width: 150px; height: 150px; object-fit: cover;'
                            ]); ?>
                        </div>
                    <?php endif; ?>
                    <div class="news-title">
                        <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>
	<div id="news-container">
    	<!-- new adding posts coming here -->
	</div>
    <button id="load-more" data-page="1" data-per-page="3">Load More</button>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
