<?php
/**
 * The main template file
 *
 * @package Vraust_AI
 */

get_header();

if (is_front_page()) {
    get_template_part('front-page');
} elseif (is_page()) {
    get_template_part('page');
} elseif (is_single()) {
    get_template_part('single');
} elseif (is_archive()) {
    ?>
    <div class="section">
        <div class="container">
            <header class="section-header">
                <?php the_archive_title('<h1>', '</h1>'); ?>
                <?php the_archive_description('<p>', '</p>'); ?>
            </header>

            <div class="grid grid-3">
                <?php
                if (have_posts()) :
                    while (have_posts()) :
                        the_post();
                        ?>
                        <article class="glass-card p-6">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium', array('class' => 'mb-4')); ?>
                                </a>
                            <?php endif; ?>
                            
                            <h2>
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            
                            <p class="text-muted"><?php the_excerpt(); ?></p>
                            
                            <a href="<?php the_permalink(); ?>" class="btn btn-outline">
                                <?php _e('Read More', 'vraust-ai'); ?>
                            </a>
                        </article>
                        <?php
                    endwhile;
                else :
                    ?>
                    <p><?php _e('No posts found.', 'vraust-ai'); ?></p>
                    <?php
                endif;
                ?>
            </div>

            <?php the_posts_pagination(); ?>
        </div>
    </div>
    <?php
} else {
    ?>
    <div class="section">
        <div class="container">
            <?php
            if (have_posts()) :
                while (have_posts()) :
                    the_post();
                    the_content();
                endwhile;
            endif;
            ?>
        </div>
    </div>
    <?php
}

get_footer();
