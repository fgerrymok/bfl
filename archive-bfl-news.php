<?php
get_header();
?>

<main id="primary" class="site-main news">

<section class="featured-news-container">

    <?php 
    $args = [
        'post_type' => 'bfl-news',
        'posts_per_page' => 1,
    ];
    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) :
            $query->the_post();
            $content = wp_trim_words(wp_strip_all_tags(get_the_content()), 30, '... Read more');
            ?>
            <div class="featured-news">
                <h1>New and Noteworthy News</h1>
                <a href="<?php the_permalink(); ?>"> 
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="featured-news-image">
                            <?php echo wp_get_attachment_image(get_post_thumbnail_id(), 'thumbnail', false, ['class' => 'news-hero-image']); ?>
                        </div>
                    <?php endif; ?>
                    <div class="hero-info">
                        <p class="card-date news-hero"><?php echo get_the_date('M j'); ?></p>
                        <p class="card-title news-hero"><?php echo the_title(); ?></p>
                        <div class="hero-text"><?php echo $content; ?></div>
                    </div>
                </a>
            </div>
            <?php
        endwhile;
        wp_reset_postdata();
    endif;
    ?>
</section>

    <h2>All News</h2>
    <div id="news-container">
        <!-- initial loading -->
        <?php
        $args = [
            'post_type' => 'bfl-news',
            'posts_per_page' => 8,
            'offset' => 1, 
        ];
        $query = new WP_Query($args);

        if ($query->have_posts()) :
            while ($query->have_posts()) :
                $query->the_post();
                ?>
                <div class="news-item">
                    <a href="<?php the_permalink(); ?>">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="news-image">
                            <?php echo wp_get_attachment_image(get_post_thumbnail_id(), 'full', false, ['class' => 'card-thumbnail-img news']); ?>
                        </div>
                    <?php endif; ?>
                        <p class="card-date news"><?php echo get_the_date( 'M j' ); ?></p>
                        <p class="card-title news"><?php echo the_title(); ?></p>
                    </a>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>

    
    <div id="load-more-wrapper">
       <button id="load-more" data-page="2" data-per-page="8">Load More</button>
    </div>


</main><!-- #main -->

<?php
get_sidebar();
get_footer();
