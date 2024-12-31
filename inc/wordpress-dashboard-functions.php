<?php

// Single Column Dashboard Layout
function single_screen_columns( $columns ) {
    $columns['dashboard'] = 1;
    return $columns;
}
add_filter( 'screen_layout_columns', 'single_screen_columns' );
 
function single_screen_dashboard(){return 1;}
add_filter( 'get_user_option_screen_layout_dashboard', 'single_screen_dashboard' );


// Function to add the custom dashboard widgets.

function add_custom_dashboard_widgets() {
    wp_add_dashboard_widget('welcome_message', 'DASHBOARD', 'welcome_widget');
    wp_add_dashboard_widget('tutorials', 'Tutorials', 'tutorial_widget');
}

add_action('wp_dashboard_setup', 'add_custom_dashboard_widgets');

// Dashboard Widgets
function welcome_widget() {
    ?>
    <div class="welcome-header">
        <img src="<?php echo get_template_directory_uri() . '/backend/site-logo.png' ?>" alt="Company Logo">
        <h1 class="dashboard-welcome-message"><?php esc_html_e('Battlefield Fight Leauge'); ?></h1>
    </div>
    <p class="dashboard-long-message">Thank you for choosing <a href=<?php echo esc_url("https://wsstudio.ca/"); ?> target="_blank" class="whitespace-link">Whitespace Studio</a> to create your website. Below this message, you'll find helpful tutorials designed to guide you through navigating your new site and getting started with content creation. If you have any questions, feel free to reach out!</p>
    <?php
}

function tutorial_widget() {
    ?>
        <h1 class="tutorial-main-title"><?php esc_html_e('Tutorials'); ?></h1>
        <section class="all-tutorials">
            <div class="single-tutorial">
                <!-- Tutorial 1 -->
                <h2 class="tutorial-title"><?php esc_html_e ('Adding New Events & Fight Results'); ?></h2>
                <iframe src="https://www.youtube.com/embed/sNDpkzKsp7U" frameborder="0" allowfullscreen></iframe>

            </div>
            <div class="single-tutorial">
                <!-- Tutorial 2 -->
                <h2 class="tutorial-title"><?php echo esc_html_e ('Updating Rankings & Adding New Fighter Profiles'); ?></h2>
                <iframe src="https://www.youtube.com/embed/2iQXa71lHf4" frameborder="0" allowfullscreen></iframe>

            </div>
            <div class="single-tutorial">
                <!-- Tutorial 3 -->
                <h2 class="tutorial-title"><?php esc_html_e ('Editing the Footer'); ?></h2>
                <iframe src="https://www.youtube.com/embed/JuUN0DERLTQ" frameborder="0" allowfullscreen></iframe>

            </div>
        </section>
    <?php
}