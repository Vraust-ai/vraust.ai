<?php
/**
 * Solution Section Template Part
 */

$pillars = array(
    array('icon' => 'shield', 'title' => get_theme_mod('pillar_1_title', 'Privacy by Design'), 'desc' => get_theme_mod('pillar_1_desc', 'Data never leaves your infrastructure. Models train locally, only encrypted gradients are shared.')),
    array('icon' => 'lock', 'title' => get_theme_mod('pillar_2_title', 'Enterprise Security'), 'desc' => get_theme_mod('pillar_2_desc', 'End-to-end encryption, secure aggregation protocols, and zero-trust architecture.')),
    array('icon' => 'eye', 'title' => get_theme_mod('pillar_3_title', 'Full Explainability'), 'desc' => get_theme_mod('pillar_3_desc', 'Transparent AI decisions with audit trails and interpretable model outputs.')),
    array('icon' => 'file-check', 'title' => get_theme_mod('pillar_4_title', 'AMF Compliance'), 'desc' => get_theme_mod('pillar_4_desc', 'Built to meet Canadian regulatory requirements for financial AI applications.')),
);
?>

<section class="section grain-overlay">
    <div class="solution-bg"></div>
    <div class="solution-glow"></div>
    
    <div class="container" style="position: relative; z-index: 10;">
        <div class="section-header reveal">
            <span class="badge badge-primary mb-6"><?php echo esc_html(get_theme_mod('solution_badge', 'The Solution')); ?></span>
            <h2><?php _e('The Vault of', 'vraust-ai'); ?> <span class="text-primary"><?php _e('Trust', 'vraust-ai'); ?></span></h2>
            <p><?php echo esc_html(get_theme_mod('solution_description', 'Vraust.ai provides a secure federated learning infrastructure designed specifically for regulated environments. Unlock collective intelligence without compromising privacy.')); ?></p>
        </div>

        <div class="grid grid-4">
            <?php foreach ($pillars as $i => $pillar) : ?>
                <div class="pillar-card reveal reveal-delay-<?php echo $i + 1; ?>">
                    <div class="pillar-icon">
                        <?php echo vraust_get_icon($pillar['icon']); ?>
                    </div>
                    <h3><?php echo esc_html($pillar['title']); ?></h3>
                    <p><?php echo esc_html($pillar['desc']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Vault Visual -->
        <div class="vault-visual reveal">
            <div class="vault-visual-glow"></div>
            <div class="vault-visual-content">
                <div class="vault-icon-container">
                    <div class="vault-icon">
                        <div class="vault-icon-ring"></div>
                        <?php echo vraust_get_icon('lock'); ?>
                    </div>
                </div>
                <div class="vault-content">
                    <h3><?php echo esc_html(get_theme_mod('vault_title', 'Your Data. Your Control. Shared Intelligence.')); ?></h3>
                    <p><?php echo esc_html(get_theme_mod('vault_description', 'With Vraust.ai, participating institutions maintain complete sovereignty over their data while contributing to a collectively smarter AI.')); ?></p>
                    <div class="vault-features">
                        <div class="vault-feature"><span class="vault-feature-dot vault-feature-dot-accent"></span><span><?php _e('Zero data movement', 'vraust-ai'); ?></span></div>
                        <div class="vault-feature"><span class="vault-feature-dot vault-feature-dot-primary"></span><span><?php _e('Encrypted aggregation', 'vraust-ai'); ?></span></div>
                        <div class="vault-feature"><span class="vault-feature-dot vault-feature-dot-accent"></span><span><?php _e('Regulatory ready', 'vraust-ai'); ?></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
