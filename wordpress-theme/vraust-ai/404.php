<?php
/**
 * 404 Page Template
 */
get_header();
?>

<div class="page-404 grain-overlay">
    <div class="page-404-content">
        <h1>404</h1>
        <h2><?php _e('Page Not Found', 'vraust-ai'); ?></h2>
        <p><?php _e('The page you\'re looking for doesn\'t exist or has been moved.', 'vraust-ai'); ?></p>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-hero">
            <?php _e('Return Home', 'vraust-ai'); ?>
        </a>
    </div>
</div>

<?php get_footer(); ?>
