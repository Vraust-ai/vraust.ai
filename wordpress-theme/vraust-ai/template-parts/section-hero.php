<?php
/**
 * Hero Section Template Part
 *
 * @package Vraust_AI
 */
?>

<section class="hero grain-overlay">
    <div class="hero-bg"></div>
    <div class="hero-glow-1"></div>
    <div class="hero-glow-2"></div>
    <div class="hero-grid"></div>

    <div class="container hero-content">
        <!-- Badge -->
        <div class="badge badge-primary reveal">
            <span class="badge-dot"></span>
            <span><?php echo esc_html(get_theme_mod('hero_badge_text', 'Privacy-Preserving AI Infrastructure')); ?></span>
        </div>

        <!-- Headline -->
        <h1 class="hero-headline reveal reveal-delay-1">
            <?php echo esc_html(get_theme_mod('hero_headline_1', 'Collaborative AI.')); ?>
            <br>
            <span class="hero-headline-gradient">
                <?php echo esc_html(get_theme_mod('hero_headline_2', 'Zero Data Sharing.')); ?>
            </span>
        </h1>

        <!-- Subheadline -->
        <p class="hero-subheadline reveal reveal-delay-2">
            <?php echo esc_html(get_theme_mod('hero_subheadline', 'Privacy-preserving AI infrastructure for fraud and financial crime detection. The Vault of Trust for Canada\'s regulated industries.')); ?>
        </p>

        <!-- CTA Buttons -->
        <div class="hero-buttons reveal reveal-delay-3">
            <a href="<?php echo esc_url(home_url('/demo/')); ?>" class="btn btn-hero btn-xl">
                <?php echo esc_html(get_theme_mod('hero_cta_primary', 'Request a Demo')); ?>
                <?php echo vraust_get_icon('arrow-right'); ?>
            </a>
            <a href="#how-it-works" class="btn btn-outline btn-xl">
                <?php echo esc_html(get_theme_mod('hero_cta_secondary', 'How It Works')); ?>
            </a>
        </div>

        <!-- Trust Badges -->
        <div class="hero-trust-badges reveal reveal-delay-4">
            <div class="trust-badge">
                <span class="trust-badge-dot trust-badge-dot-accent"></span>
                <span><?php echo esc_html(get_theme_mod('hero_badge_1', 'AMF Compliant')); ?></span>
            </div>
            <div class="trust-badge">
                <span class="trust-badge-dot trust-badge-dot-primary"></span>
                <span><?php echo esc_html(get_theme_mod('hero_badge_2', 'Federated Learning')); ?></span>
            </div>
            <div class="trust-badge">
                <span class="trust-badge-dot trust-badge-dot-accent"></span>
                <span><?php echo esc_html(get_theme_mod('hero_badge_3', 'End-to-End Encrypted')); ?></span>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <a href="#problem" class="scroll-indicator">
        <span><?php _e('Explore', 'vraust-ai'); ?></span>
        <?php echo vraust_get_icon('chevron-down'); ?>
    </a>
</section>
