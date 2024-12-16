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

		<?php if ( have_posts() ) : 
            ?>

            <section class="bfl-to-ufc-hero-section">
                <h1><?php the_title(); ?></h1>
                <?php 
                 $image_id = 14332;
                 echo wp_get_attachment_image( $image_id, ['150', '150'], "", ['class' => 'hero-image'])
                 ?>

            </section>

            <section class="bfl-to-ufc-description">
                <p>               
                    At Battlefield Fight League, we pride ourselves on being a premier launching pad for MMA talent in Canada. Many of our athletes have honed their skills in the BFL cage, earning recognition on the global stage and ultimately making their way to the pinnacle of MMA—the UFC. This progression underscores the high caliber of competition in BFL and our commitment to nurturing world-class fighters.
                </p>
                <p>
                    The "BFL to UFC" fighters list is a testament to the opportunities and exposure our league provides, while the "On the UFC Radar" list highlights rising stars who are catching the attention of the MMA world. 
                </p>
            </section>
    
            <?php
            // BFL to UFC
            $args = array(
                'post_type' => 'bfl-fighters', 
                'tag' => array('bfl-to-ufc'), 
                'posts_per_page' => -1,        
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) : ?>
                <section class="list-of-bfl-to-ufc">
                    <h2>BFL to UFC</h2>
                    <ul>
                        <?php while ($query->have_posts()) : $query->the_post(); ?>
                            <li>
                                <?php
                                $image_id = get_field('single_fighter_image');
                                echo wp_get_attachment_image( $image_id, ['150', '150'], "", [ 'class' => 'fighter-photo' ]);
                                ?>
                                <p><?php the_title(); ?></p>
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
                <section class="list-of-on-the-ufc-radar">
                    <h2>On the UFC Radar</h2>
                    <ul>
                        <?php while ($query->have_posts()) : $query->the_post(); ?>
                            <li>
                                <?php
                                $image_id = get_field('single_fighter_image');
                                echo wp_get_attachment_image( $image_id, ['150', '150'], "", [ 'class' => 'fighter-photo' ]);
                                ?>
                                <p><?php the_title(); ?></p>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </section>
                <?php
                wp_reset_postdata();
            endif;
		endif;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();