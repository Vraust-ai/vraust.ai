<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class('grain-overlay'); ?>>
<?php wp_body_open(); ?>

<!-- Navbar -->
<header class="navbar">
    <div class="container navbar-container">
        <!-- Logo -->
        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <div class="logo-icon">
                    <span>V</span>
                </div>
                <span class="logo-text">
                    Vraust<span>.ai</span>
                </span>
            <?php endif; ?>
        </a>

        <!-- Desktop Navigation -->
        <nav class="nav-links">
            <?php
            if (has_nav_menu('primary')) {
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'items_wrap'     => '%3$s',
                    'walker'         => new Vraust_Nav_Walker(),
                ));
            } else {
                // Default navigation
                ?>
                <a href="#how-it-works" class="nav-link"><?php _e('How It Works', 'vraust-ai'); ?></a>
                <a href="#use-cases" class="nav-link"><?php _e('Use Cases', 'vraust-ai'); ?></a>
                <a href="#about" class="nav-link"><?php _e('About', 'vraust-ai'); ?></a>
                <?php
            }
            ?>
        </nav>

        <!-- CTA Button -->
        <div class="nav-cta">
            <a href="<?php echo esc_url(home_url('/demo/')); ?>" class="btn btn-hero">
                <?php _e('Request Demo', 'vraust-ai'); ?>
            </a>
        </div>

        <!-- Mobile Menu Toggle -->
        <button class="mobile-menu-toggle" id="mobile-menu-toggle" aria-label="<?php esc_attr_e('Toggle menu', 'vraust-ai'); ?>">
            <span class="menu-icon"><?php echo vraust_get_icon('menu'); ?></span>
            <span class="close-icon" style="display: none;"><?php echo vraust_get_icon('x'); ?></span>
        </button>
    </div>

    <!-- Mobile Menu -->
    <nav class="mobile-menu" id="mobile-menu">
        <?php
        if (has_nav_menu('primary')) {
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container'      => false,
            ));
        } else {
            ?>
            <a href="#how-it-works"><?php _e('How It Works', 'vraust-ai'); ?></a>
            <a href="#use-cases"><?php _e('Use Cases', 'vraust-ai'); ?></a>
            <a href="#about"><?php _e('About', 'vraust-ai'); ?></a>
            <?php
        }
        ?>
        <a href="<?php echo esc_url(home_url('/demo/')); ?>" class="btn btn-hero">
            <?php _e('Request Demo', 'vraust-ai'); ?>
        </a>
    </nav>
</header>

<main id="main" class="site-main">
