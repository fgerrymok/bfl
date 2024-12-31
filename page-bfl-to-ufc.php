<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BFL
 */

get_header();
?>

    <main id="primary" class="site-main">

    <?php 
    if ( have_posts() ) :
        while ( have_posts() ) :
            the_post();
            ?>
            <section class="hero-section bfl-to-ufc">
                <h1 class="title bfl-to-ufc"><?php the_title(); ?></h1>
                <?php
                $description = get_field("bfl_to_ufc_description");
                if ($description) : ?>
                    <p><?php echo wpautop(esc_html($description)); ?></p>
                <?php endif; ?>
            </section>


            <div class="tab-wrapper">
            <div class="tabs bfl-to-ufc">
                <button class="tab-button active" data-target="list-of-bfl-to-ufc">BFL to UFC</button>
                <button class="tab-button" data-target="list-of-on-the-ufc-radar">On the UFC Radar</button>
            </div>

      
            <?php
            // BFL to UFC
            $args = array(
                'post_type' => 'bfl-fighters',
                'tag' => array('bfl-to-ufc'),
                'posts_per_page' => -1,
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) : ?>
                <section class="tab-content list-of-bfl-to-ufc active" id="list-of-bfl-to-ufc">
                    <ul>
                        <?php while ($query->have_posts()) : $query->the_post(); ?>
                            <li>
                                <a href="<?php echo esc_url(the_permalink()); ?>">
                                    <?php
                                    $image_id = get_field('single_fighter_image');
                                    echo wp_get_attachment_image( $image_id, 'full', "", [ 'class' => 'fighter-photo' ]);
                                    ?>
                                    <p><?php the_title(); ?></p>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </section>
                <?php
                wp_reset_postdata();
            endif;

            // On the UFC Radar
            $args = array(
                'post_type' => 'bfl-fighters',
                'tag' => array('on-the-ufc-radar'),
                'posts_per_page' => -1,
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) : ?>
                <section class="tab-content list-of-on-the-ufc-radar" id="list-of-on-the-ufc-radar" style="display: none;">
                    <ul>
                        <?php while ($query->have_posts()) : $query->the_post(); ?>
                            <li>
                                <a href="<?php echo esc_url(the_permalink()); ?>">
                                    <?php
                                    $image_id = get_field('single_fighter_image');
                                    echo wp_get_attachment_image( $image_id, 'full', "", [ 'class' => 'fighter-photo' ]);
                                    ?>
                                    <p><?php the_title(); ?></p>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </section>

                <?php
                wp_reset_postdata();
            endif; ?>
            </div>
        <?php
        endwhile;
    endif; ?>



    </main><!-- #main -->

<?php
get_sidebar();
get_footer();