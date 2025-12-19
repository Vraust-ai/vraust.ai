</main><!-- #main -->

<!-- Footer -->
<footer class="footer grain-overlay">
    <div class="container">
        <div class="footer-grid">
            <!-- Brand Column -->
            <div class="footer-brand">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
                    <div class="logo-icon">
                        <span>V</span>
                    </div>
                    <span class="logo-text">
                        Vraust<span>.ai</span>
                    </span>
                </a>
                <p>
                    <?php echo esc_html(get_theme_mod('footer_description', 'The Vault of Trust for Collaborative AI. Privacy-preserving machine learning infrastructure for Canada\'s regulated industries.')); ?>
                </p>
                <p class="made-in">
                    <?php echo esc_html(get_theme_mod('footer_made_in', 'Made in Canada 🍁')); ?>
                </p>
            </div>

            <!-- Product Links -->
            <div class="footer-links">
                <h4><?php _e('Product', 'vraust-ai'); ?></h4>
                <ul>
                    <li><a href="#how-it-works"><?php _e('How It Works', 'vraust-ai'); ?></a></li>
                    <li><a href="#use-cases"><?php _e('Use Cases', 'vraust-ai'); ?></a></li>
                    <li><a href="#"><?php _e('Security', 'vraust-ai'); ?></a></li>
                    <li><a href="#"><?php _e('Compliance', 'vraust-ai'); ?></a></li>
                </ul>
            </div>

            <!-- Company Links -->
            <div class="footer-links">
                <h4><?php _e('Company', 'vraust-ai'); ?></h4>
                <ul>
                    <li><a href="#about"><?php _e('About', 'vraust-ai'); ?></a></li>
                    <li><a href="#"><?php _e('Research', 'vraust-ai'); ?></a></li>
                    <li><a href="#"><?php _e('Careers', 'vraust-ai'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/demo/')); ?>"><?php _e('Contact', 'vraust-ai'); ?></a></li>
                </ul>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="footer-bottom">
            <?php vraust_footer_credits(); ?>
            <div class="footer-legal">
                <?php
                if (has_nav_menu('legal')) {
                    wp_nav_menu(array(
                        'theme_location' => 'legal',
                        'container'      => false,
                        'items_wrap'     => '%3$s',
                        'depth'          => 1,
                    ));
                } else {
                    ?>
                    <a href="#"><?php _e('Privacy Policy', 'vraust-ai'); ?></a>
                    <a href="#"><?php _e('Terms of Service', 'vraust-ai'); ?></a>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
