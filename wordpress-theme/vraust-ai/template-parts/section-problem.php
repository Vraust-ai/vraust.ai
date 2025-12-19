<?php
/**
 * Problem Section Template Part
 */

$problems = array(
    array('icon' => 'database', 'title' => get_theme_mod('problem_1_title', 'Data Silos'), 'desc' => get_theme_mod('problem_1_desc', 'Critical fraud patterns remain invisible when institutions can\'t share insights across organizational boundaries.')),
    array('icon' => 'alert-triangle', 'title' => get_theme_mod('problem_2_title', 'Regulatory Constraints'), 'desc' => get_theme_mod('problem_2_desc', 'Privacy regulations and competitive concerns prevent the data sharing needed for effective AI models.')),
    array('icon' => 'building', 'title' => get_theme_mod('problem_3_title', 'Inability to Collaborate'), 'desc' => get_theme_mod('problem_3_desc', 'Without a secure framework, financial institutions fight fraud alone—missing the collective intelligence advantage.')),
);
?>

<section id="problem" class="section">
    <div class="container">
        <div class="section-header reveal">
            <span class="badge badge-accent mb-6"><?php echo esc_html(get_theme_mod('problem_badge', 'The Challenge')); ?></span>
            <h2><?php echo esc_html(get_theme_mod('problem_title', 'Fraud Thrives in')); ?> <span class="text-accent"><?php _e('Isolation', 'vraust-ai'); ?></span></h2>
            <p><?php echo esc_html(get_theme_mod('problem_description', 'Financial criminals exploit institutional silos. Current approaches leave billions in losses undetected.')); ?></p>
        </div>

        <div class="grid grid-3" style="max-width: 64rem; margin: 0 auto;">
            <?php foreach ($problems as $i => $problem) : ?>
                <div class="problem-card reveal reveal-delay-<?php echo $i + 1; ?>">
                    <div class="problem-card-glow"></div>
                    <div class="problem-card-content">
                        <div class="icon-box icon-box-accent mb-6">
                            <?php echo vraust_get_icon($problem['icon']); ?>
                        </div>
                        <h3><?php echo esc_html($problem['title']); ?></h3>
                        <p><?php echo esc_html($problem['desc']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="section-separator mt-16 reveal"></div>
    </div>
</section>
