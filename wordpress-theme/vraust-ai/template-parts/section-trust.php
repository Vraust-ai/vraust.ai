<?php
/**
 * Trust Section
 */
$creds = array(
    array('icon' => 'graduation-cap', 'value' => get_theme_mod('cred_1_value', '10+'), 'label' => get_theme_mod('cred_1_label', 'Years of Research'), 'desc' => get_theme_mod('cred_1_desc', 'In privacy-preserving machine learning')),
    array('icon' => 'microscope', 'value' => get_theme_mod('cred_2_value', '15+'), 'label' => get_theme_mod('cred_2_label', 'Research Partners'), 'desc' => get_theme_mod('cred_2_desc', 'Including top Canadian universities')),
    array('icon' => 'building', 'value' => get_theme_mod('cred_3_value', 'Healthcare'), 'label' => get_theme_mod('cred_3_label', 'Clinical Collaborations'), 'desc' => get_theme_mod('cred_3_desc', 'With leading medical institutions')),
    array('icon' => 'award', 'value' => get_theme_mod('cred_4_value', 'AMF'), 'label' => get_theme_mod('cred_4_label', 'Regulatory Expertise'), 'desc' => get_theme_mod('cred_4_desc', 'Built for Canadian compliance')),
);
?>

<section id="about" class="section">
    <div class="container">
        <div class="section-header reveal">
            <span class="badge badge-primary mb-6"><?php echo esc_html(get_theme_mod('trust_badge', 'Research Foundation')); ?></span>
            <h2><?php _e('Built on', 'vraust-ai'); ?> <span class="text-primary"><?php _e('Rigorous Science', 'vraust-ai'); ?></span></h2>
            <p><?php echo esc_html(get_theme_mod('trust_description', 'Vraust.ai is founded on years of academic research in privacy-preserving AI, with deep expertise in both financial and healthcare domains.')); ?></p>
        </div>

        <div class="grid grid-4" style="max-width: 64rem; margin: 0 auto;">
            <?php foreach ($creds as $i => $cred) : ?>
                <div class="credential-card reveal reveal-delay-<?php echo $i + 1; ?>">
                    <div class="credential-icon"><?php echo vraust_get_icon($cred['icon']); ?></div>
                    <div class="credential-value"><?php echo esc_html($cred['value']); ?></div>
                    <div class="credential-label"><?php echo esc_html($cred['label']); ?></div>
                    <div class="credential-desc"><?php echo esc_html($cred['desc']); ?></div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="quote-card reveal">
            <blockquote>"<?php echo esc_html(get_theme_mod('trust_quote', 'Our mission is to unlock collective intelligence across data-sensitive ecosystems while maintaining strict confidentiality, regulatory compliance, and operational control.')); ?>"</blockquote>
            <div class="quote-author">
                <div class="quote-author-avatar"><span>V</span></div>
                <div class="quote-author-info"><div class="quote-author-name">Vraust.ai</div><div class="quote-author-title"><?php _e('Research Team', 'vraust-ai'); ?></div></div>
            </div>
        </div>
    </div>
</section>
