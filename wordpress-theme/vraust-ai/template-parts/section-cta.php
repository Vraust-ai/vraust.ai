<?php
/**
 * CTA Section
 */
?>

<section class="cta-section grain-overlay">
    <div class="cta-bg"></div>
    <div class="cta-glow"></div>
    
    <div class="container cta-content">
        <div class="badge badge-primary mb-8 reveal">
            <span class="badge-dot"></span>
            <span><?php echo esc_html(get_theme_mod('cta_badge', 'Ready to Transform')); ?></span>
        </div>

        <h2 class="reveal"><?php _e('See Vraust.ai', 'vraust-ai'); ?> <span class="text-primary"><?php _e('in Action', 'vraust-ai'); ?></span></h2>
        
        <p class="reveal"><?php echo esc_html(get_theme_mod('cta_description', 'Deploy collaborative AI without compromising privacy. Join Canada\'s leading financial institutions in the fight against fraud and financial crime.')); ?></p>

        <div class="cta-buttons reveal">
            <a href="<?php echo esc_url(home_url('/demo/')); ?>" class="btn btn-cta">
                <?php echo esc_html(get_theme_mod('cta_primary_button', 'Request a Demo')); ?>
                <?php echo vraust_get_icon('arrow-right'); ?>
            </a>
            <a href="#" class="btn btn-outline btn-xl"><?php echo esc_html(get_theme_mod('cta_secondary_button', 'Contact Sales')); ?></a>
        </div>

        <div class="cta-trust reveal">
            <div class="cta-trust-item"><?php echo vraust_get_icon('check'); ?><span><?php _e('No data sharing required', 'vraust-ai'); ?></span></div>
            <div class="cta-trust-item"><?php echo vraust_get_icon('check'); ?><span><?php _e('Enterprise security', 'vraust-ai'); ?></span></div>
            <div class="cta-trust-item"><?php echo vraust_get_icon('check'); ?><span><?php _e('AMF compliant', 'vraust-ai'); ?></span></div>
        </div>
    </div>
</section>
