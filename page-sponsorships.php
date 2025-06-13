<?php
get_header();
?>

<main id="primary" class="site-main">
    <?php
    while ( have_posts() ) :
        the_post();
        if ( get_field( 'sponsor_hero_image' ) ) :
            ?>
            <!-- Hero Section -->
            <section class="sponsorships-hero">
                <div class="sponsorships-hero-image-container">
                    <?php
                    $image = get_field( 'sponsor_hero_image' );
                    if ( $image ) {
                        echo wp_get_attachment_image( $image, 'full' );
                    }
                    ?>
                </div>
                <div class="sponsorships-hero-overlay"></div>
                <div class="container">
                    <div class="sponsorships-hero-content">
                        <div class="hero-subtitle animate-on-scroll" data-delay="200">
                            <h1>JOIN THE CANADIAN MMA ELITE</h1>
                            <h2>BECOME A SPONSOR</h2>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Visibility Section -->
            <?php
            $audience_age_percentage = get_field( 'audience_age_percentage' );
            $audience_age_text = get_field( 'audience_age_text' );
            $audience_location_percentage = get_field( 'audience_location_percentage' );
            $audience_location_text = get_field( 'audience_location_text' );
            $audience_amount_number = get_field( 'audience_amount_number' );
            $audience_amount_text = get_field( 'audience_amount_text' );

            // Render section even if some fields are empty, with fallbacks
            ?>
            <section class="visibility-section">
                <div class="container">
                    <div class="section-header animate-on-scroll">
                        <h2>A UNIQUE VISIBILITY OPPORTUNITY</h2>
                        <h3 class="section-subtitle">THE AUDIENCE IN FIGURES</h3>
                    </div>
                    
                    <div class="stats-grid animate-on-scroll" data-delay="200">
                        <div class="stat-item">
                            <div class="stat-circle" data-percent="<?php echo esc_attr( $audience_age_percentage ? rtrim( $audience_age_percentage, '%' ) : '0' ); ?>">
                                <div class="stat-fill"></div>
                                <span class="stat-number"><?php echo esc_html( $audience_age_percentage ? $audience_age_percentage : '0%' ); ?></span>
                            </div>
                            <p class="stat-label"><?php echo esc_html( $audience_age_text ? $audience_age_text : 'Audience Age' ); ?></p>
                        </div>
                        
                        <div class="stat-item">
                            <div class="stat-circle" data-percent="<?php echo esc_attr( $audience_location_percentage ? rtrim( $audience_location_percentage, '%' ) : '0' ); ?>">
                                <div class="stat-fill"></div>
                                <span class="stat-number"><?php echo esc_html( $audience_location_percentage ? $audience_location_percentage : '0%' ); ?></span>
                            </div>
                            <p class="stat-label"><?php echo esc_html( $audience_location_text ? $audience_location_text : 'Audience Location' ); ?></p>
                        </div>
                        
                        <div class="stat-item">
                            <div class="stat-bar-container">
                                <div class="stat-bar">
                                    <div class="bar-fill" data-width="<?php echo esc_attr( $audience_amount_number ? '100' : '0' ); ?>"></div>
                                    <span class="stat-number-large"><?php echo esc_html( $audience_amount_number ? $audience_amount_number : '0' ); ?></span>
                                </div>
                            </div>
                            <p class="stat-label"><?php echo esc_html( $audience_amount_text ? $audience_amount_text : 'Audience Amount' ); ?></p>
                        </div>
                    </div>

                    <div class="content-description animate-on-scroll" data-delay="400">
                        <p>Associate your brand with Battlefield Fight League, the #1 Developmental Mixed Martial Arts Organization in Canada, and maximize your visibility among a committed public. Our events, broadcast on UFC Fight Pass, bring together the best prospects in Canadian MMA and attract millions of viewers live and online.</p>
                        <button>CONTACT US</button>
                    </div>
                </div>
            </section>

            <!-- Social Media Section -->
            <?php
            $rank_in_canada = get_field( 'rank_in_canada' );
            $average_views = get_field( 'average_views' );
            $average_engagement = get_field( 'average_engagement' );
            $percentage_followers = get_field( 'percentage_followers' );
            $percentage_non_followers = get_field( 'percentage_non_followers' );

            if ( $rank_in_canada || $average_views || $average_engagement || $percentage_followers || $percentage_non_followers ) :
                ?>
                <section class="social-section">
                    <div class="container">
                        <div class="section-header animate-on-scroll">
                            <h2>MAXIMUM VISIBILITY BY THE NUMBERS</h2>
                            <h3 class="section-subtitle">SOCIAL MEDIA PRESCENCE</h3>
                        </div>

                        <div class="social-stats animate-on-scroll" data-delay="200">
                            <div class="social-highlight">
                                <div class="badge-container">
                                    <span class="highlight-badge"><?php echo esc_html( $rank_in_canada ? $rank_in_canada : 'N/A' ); ?></span>
                                </div>
                                <p>Largest social media following along all channels</p>
                            </div>

							<div class="engagement-section animate-on-scroll" data-delay="400">
								<div class="engagement-content">
									<h3>Maximum Engagement</h3>
									<div class="engagement-stats">
										<div class="engagement-number">
											<span class="counter" data-target="30000"><?php echo esc_html( $average_engagement ? $average_engagement : '0' ); ?></span>
											<span class="label">Avg. Interactions during fight week</span>
										</div>
										<div class="engagement-breakdown">
											<div class="breakdown-item followers" data-percent="40.1">
												<span class="percentage"><?php echo esc_html( $percentage_followers ? $percentage_followers : '0%' ); ?></span>
												<span class="category">Followers</span>
											</div>
											<div class="breakdown-item non-followers" data-percent="59.9">
												<span class="percentage"><?php echo esc_html( $percentage_non_followers ? $percentage_non_followers : '0%' ); ?></span>
												<span class="category">Non-Followers</span>
											</div>
										</div>
									</div>
								</div>
							</div>
                            
                            <div class="views-counter">
                                <div class="counter-display">
                                    <span class="counter-number" data-target="1900000"><?php echo esc_html( $average_views ? $average_views : '0' ); ?></span>
                                    <span class="counter-label">Views</span>
                                </div>
                                <p>Average views per event across social media</p>
                            </div>

                        </div>
                    </div>
                </section>
                <?php
            endif;
            ?>

            <!-- Why BFL Section -->
            <?php
            $second_image = get_field( 'second_image' );
            if ( $second_image ) :
                ?>
                <section class="why-bfl-section">
					<div class="secondary-image">
						<?php echo wp_get_attachment_image( $second_image, 'full' ); ?>
					</div>
                    <div class="container">
                        <h2 class="section-title animate-on-scroll">WHY BFL?</h2>
                        
                        <div class="features-grid animate-on-scroll" data-delay="200">
                            <div class="feature-block">
                                <div class="feature-header">
                                    <h3>NATIONAL AND INTERNATIONAL VISIBILITY</h3>
                                </div>
                                <div class="feature-list">
                                    <div class="list-item"><span class="checkmark">&check;</span> Broadcast of our galas on UFC Fight Pass</div>
                                    <div class="list-item"><span class="checkmark">&check;</span> Media presence and promotion on social networks</div>
                                    <div class="list-item"><span class="checkmark">&check;</span> Over 50,000 active subscribers on our platforms</div>
                                </div>
                            </div>
                            
                            <div class="feature-block">
                                <div class="feature-header">
                                    <h3>STRATEGIC PARTNERSHIPS</h3>
                                </div>
                                <div class="feature-list">
                                    <div class="list-item"><span class="checkmark">&check;</span> Over 80% of Canadian hopefuls fight under our banner</div>
                                    <div class="list-item"><span class="checkmark">&check;</span> Collaboration opportunities adapted to your goals</div>
                                    <div class="list-item"><span class="checkmark">&check;</span> Highest level quality broadcast in Canada</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <?php
            endif;
            ?>

            <!-- Brand Opportunities Section -->
            <section class="opportunities-section">
                <div class="container">
                    <h2 class="section-title animate-on-scroll">HOW CAN YOUR BRAND SHINE WITH US?</h2>
                    
                    <div class="opportunities-grid animate-on-scroll" data-delay="200">
                        <div class="opportunity-item">
                            <div class="opportunity-icon"><svg width="64px" height="64px" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" fill="none"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill="#ffffff" fill-rule="evenodd" d="M3.415 10.242c-.067-.086-.13-.167-.186-.242a16.806 16.806 0 011.803-2.025C6.429 6.648 8.187 5.5 10 5.5c1.813 0 3.57 1.148 4.968 2.475A16.816 16.816 0 0116.771 10a16.9 16.9 0 01-1.803 2.025C13.57 13.352 11.813 14.5 10 14.5c-1.813 0-3.57-1.148-4.968-2.475a16.799 16.799 0 01-1.617-1.783zm15.423-.788L18 10l.838.546-.002.003-.003.004-.01.016-.037.054a17.123 17.123 0 01-.628.854 18.805 18.805 0 01-1.812 1.998C14.848 14.898 12.606 16.5 10 16.5s-4.848-1.602-6.346-3.025a18.806 18.806 0 01-2.44-2.852 6.01 6.01 0 01-.037-.054l-.01-.016-.003-.004-.001-.002c0-.001-.001-.001.837-.547l-.838-.546.002-.003.003-.004.01-.016a6.84 6.84 0 01.17-.245 18.804 18.804 0 012.308-2.66C5.151 5.1 7.394 3.499 10 3.499s4.848 1.602 6.346 3.025a18.803 18.803 0 012.44 2.852l.037.054.01.016.003.004.001.002zM18 10l.838-.546.355.546-.355.546L18 10zM1.162 9.454L2 10l-.838.546L.807 10l.355-.546zM9 10a1 1 0 112 0 1 1 0 01-2 0zm1-3a3 3 0 100 6 3 3 0 000-6z"></path> </g></svg></div>
                            <div class="opportunity-content">
                                <h3>Visibility on the Cage</h3>
                                <p>Display your logo on the mats, posts, or ring enclosures</p>
                            </div>
                        </div>
                        
                        <div class="opportunity-item">
                            <div class="opportunity-icon"><svg width="64px" height="64px" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" fill="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>broadcast-tower-solid</title> <g id="Layer_2" data-name="Layer 2"> <g id="invisible_box" data-name="invisible box"> <rect width="48" height="48" fill="none"></rect> </g> <g id="icons_Q2" data-name="icons Q2"> <g> <path d="M25.8,25.6A4.9,4.9,0,0,0,29,21a5,5,0,0,0-10,0,4.9,4.9,0,0,0,3.2,4.6L15.1,42.7c-.3.7,0,1.3.5,1.3H32.4c.5,0,.8-.6.5-1.3Z"></path> <path d="M17.5,31.4a2.2,2.2,0,0,0-.1-2.9,10,10,0,0,1,0-15,2.2,2.2,0,0,0,.1-2.9,2.2,2.2,0,0,0-2.9-.1A14.5,14.5,0,0,0,10,21a14.5,14.5,0,0,0,4.6,10.5A2.2,2.2,0,0,0,17.5,31.4Z"></path> <path d="M33.4,10.5a2.1,2.1,0,0,0-2.9.1,2.2,2.2,0,0,0,.1,2.9,10,10,0,0,1,0,15,2.1,2.1,0,0,0,2.8,3,14.3,14.3,0,0,0,0-21Z"></path> <path d="M39.4,5.6a2,2,0,0,0-2.8,2.8,17.4,17.4,0,0,1,0,25.2,2,2,0,0,0,2.8,2.8,21.3,21.3,0,0,0,0-30.8Z"></path> <path d="M6,21A17.5,17.5,0,0,1,11.4,8.4,2,2,0,0,0,8.6,5.6a21.3,21.3,0,0,0,0,30.8,2,2,0,0,0,2.8-2.8A17.5,17.5,0,0,1,6,21Z"></path> </g> </g> </g> </g></svg></div>
                            <div class="opportunity-content">
                                <h3>Presence on our Broadcasts</h3>
                                <p>Associate your brand with fighting and television production</p>
                            </div>
                        </div>
                        
                        <div class="opportunity-item">
                            <div class="opportunity-icon"><svg width="64px" height="64px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6 18V14M6 14H8L13 17V7L8 10H5C3.89543 10 3 10.8954 3 12V12C3 13.1046 3.89543 14 5 14H6ZM17 7L19 5M17 17L19 19M19 12H21" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg></div>
                            <div class="opportunity-content">
                                <h3>Digital promotion</h3>
                                <p>Highlighting on social networks and our website</p>
                            </div>
                        </div>
                        
                        <div class="opportunity-item">
                            <div class="opportunity-icon"><svg fill="#ffffff" width="64px" height="64px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M16,1H8.5A5.5,5.5,0,0,0,3.313,8.333a.978.978,0,0,0,.1.171A2.965,2.965,0,0,0,3,10v3.343a4.968,4.968,0,0,0,1.464,3.536L6,18.414V22a1,1,0,0,0,1,1H17a1,1,0,0,0,1-1V18.414l1.536-1.535A4.968,4.968,0,0,0,21,13.343V6A5.006,5.006,0,0,0,16,1Zm0,20H8V19h8Zm3-7.657a2.983,2.983,0,0,1-.878,2.122L16.586,17H7.414L5.878,15.465A2.983,2.983,0,0,1,5,13.343V10a1,1,0,0,1,2,0v3a1,1,0,0,0,2,0V12h7a1,1,0,0,0,0-2H9A3,3,0,0,0,6,7a2.971,2.971,0,0,0-.932.163A3.478,3.478,0,0,1,8.5,3H16a3,3,0,0,1,3,3Z"></path></g></svg></div>
                            <div class="opportunity-content">
                                <h3>Immersive experience</h3>
                                <p>Fight sponsorships, event booths, collaborations with our Ring Girls</p>
                            </div>
                        </div>
                        
                        <div class="opportunity-item">
                            <div class="opportunity-icon"><svg width="64px" height="64px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M22 7.99995H20M20 7.99995H19C17 6.00173 14 3.99974 12 5.99995M20 7.99995V15.9999M12 5.99995L8.99956 9.00158C8.9202 9.08097 8.88052 9.12066 8.84859 9.1558C8.15499 9.91889 8.15528 11.0842 8.84927 11.847C8.88121 11.8821 8.92098 11.9218 9.00031 12.0011C9.07967 12.0804 9.11936 12.1201 9.15449 12.152C9.91743 12.8453 11.0824 12.8452 11.8451 12.1516C11.8802 12.1197 11.9199 12.08 11.9992 12.0007L12.9996 11.0003M12 5.99995C10 3.99974 7 6.0018 5 8.00001H4M2 8.00001H4M4 8.00001V15.9999M20 15.9999V18.9999H22M20 15.9999H17.1716M15 12.9999L16.5 14.4999C16.5796 14.5796 16.6195 14.6194 16.6515 14.6547C17.3449 15.4175 17.3449 16.5824 16.6515 17.3452C16.6195 17.3805 16.5796 17.4203 16.5 17.4999C16.4204 17.5795 16.3805 17.6194 16.3453 17.6515C15.5824 18.3449 14.4176 18.3449 13.6547 17.6515C13.6195 17.6194 13.5796 17.5795 13.5 17.4999L13 16.9999C12.4548 17.5452 12.1821 17.8178 11.888 17.9636C11.3285 18.2408 10.6715 18.2408 10.112 17.9636C9.81788 17.8178 9.54525 17.5452 9 16.9999C8.31085 17.9188 6.89563 17.7912 6.38197 16.7639L6 15.9999H4M4 15.9999V18.9999H2" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg></div>
                            <div class="opportunity-content">
                                <h3>Personalized offers</h3>
                                <p>Creation of tailor-made campaigns for maximum impact</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Final CTA Section with Hero Image -->
            <section class="final-cta">
				<div class="cta-content animate-on-scroll">
					<p>Do you want to be part of the BFL adventure? Contact us now and join the elite of Canadian MMA!</p>
					<button class="cta-button-large">CONTACT US</button>
				</div>
            </section>
            <?php
        endif;
    endwhile;
    ?>
</main>

<?php
get_footer();
?>