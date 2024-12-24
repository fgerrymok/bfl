<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BFL
 */

get_header();
?>
<main id="primary" class="site-main">

<?php


while ( have_posts() ) :
    the_post();
    if(get_field('about_page_title')):
        ?>
        <div class='about-hero-section hero'>
        <h1><?php the_field('about_page_title')?></h1>
        <?php
    endif;

    if(get_field('about_hero_image')):
        $hero_image = get_field('about_hero_image');
        $size = 'full';
        echo wp_get_attachment_image( $hero_image, $size );
    endif;

    // output about bfl text
    if(have_rows('about_bfl')):
        while(have_rows('about_bfl')): the_row();
            // get sub_field values
            $about_bfl_text = get_sub_field('about_bfl_text');
        ?>
        </div>
        <div class='about-page-wrapper'>
        <div class='about-information-wrapper'>
        <section class='about-page-section'>
            <p><?php echo esc_html($about_bfl_text); ?></p>
        </section>
        <?php
        endwhile;
    endif;

    // Output What We Offer Section
    if(have_rows('what_we_offer_section')):
        while(have_rows('what_we_offer_section')): the_row();
            // get sub_field values
            $offer_title = get_sub_field('what_we_offer_title');
            $offer_text  = get_sub_field('what_we_offer_text');
        ?>
        
        <section class='about-page-section'>
            <h2><?php echo esc_html($offer_title) ?></h2>
            <p><?php echo esc_html($offer_text); ?></p>
        </section>
        <?php
        endwhile;
    endif;

    // Output Our Place in the MMA Market Section
    if(have_rows('our_place_in_mma_market_section')):
        while(have_rows('our_place_in_mma_market_section')): the_row();
            // get sub_field values
            $mma_title = get_sub_field('our_place_in_mma_market_title');
            $mma_text  = get_sub_field('our_place_in_mma_market_text');
        ?>
        <section class='about-page-section'>
            <h2><?php echo esc_html($mma_title) ?></h2>
            <p><?php echo esc_html($mma_text); ?></p>
        </section>
        <?php
        endwhile;
    endif;

    // Output Our Vision Section
    if(have_rows('our_vision_section')):
        while(have_rows('our_vision_section')): the_row();
            // get sub_field values
            $vision_title = get_sub_field('our_vision_title');
            $vision_text  = get_sub_field('our_vision_text');
        ?>
        <section class='about-page-section'>
            <h2><?php echo esc_html($vision_title) ?></h2>
            <p><?php echo esc_html($vision_text); ?></p>
        </section>
        </div>
        <?php
        endwhile;
    endif;

    // Output Contact Us Section
    if(have_rows('contact_us_section')):
        while(have_rows('contact_us_section')): the_row();
            // get sub_field values
            $contact_title = get_sub_field('contact_us_title');
            $advertise_title = get_sub_field('advertise_title');
            $fight_title = get_sub_field('fight_in_bfl_title');
            $email_addres = get_sub_field('email_address');
            $fill_the_form = get_sub_field('fill_the_form_title');

            
        ?>
        <section class='about-page-section contact-us-section'>
            <h2 id="contact-section-title"><?php echo esc_html($contact_title) ?></h2>
            <div class='advertise-fight-wrapper'>
                <p class='advertise'><?php echo esc_html($advertise_title); ?></p>
                <p><?php echo esc_html($fight_title); ?> <span>BFL</span></p>
            </div>
            <div class='email-form-title-wrapper'>
                <p class='email-address'><?php echo esc_html($email_addres); ?></p>
                <p class='or'>or</p>
                <p class='form-title'><?php echo esc_html($fill_the_form); ?></p>
            </div>
        </section>
        <?php
        endwhile;
    endif;










    get_template_part( 'template-parts/content', 'page' );

    // If comments are open or we have at least one comment, load up the comment template.
    if ( comments_open() || get_comments_number() ) :
        comments_template();
    endif;

endwhile; // End of the loop.
?>
</div>
</main><!-- #main -->

<?php
get_footer();
