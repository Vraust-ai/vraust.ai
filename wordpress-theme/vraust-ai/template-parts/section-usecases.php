<?php
/**
 * Use Cases, Clients, Trust, CTA Sections Template Parts
 */

// Use Cases
$useCases = array(
    array('icon' => 'shield-alert', 'title' => get_theme_mod('usecase_1_title', 'Fraud Detection'), 'desc' => get_theme_mod('usecase_1_desc', 'Identify fraudulent patterns across institutions without exposing transaction data.')),
    array('icon' => 'fingerprint', 'title' => get_theme_mod('usecase_2_title', 'AML & Financial Crime'), 'desc' => get_theme_mod('usecase_2_desc', 'Strengthen anti-money laundering models with cross-institutional signals.')),
    array('icon' => 'user-check', 'title' => get_theme_mod('usecase_3_title', 'Identity Verification'), 'desc' => get_theme_mod('usecase_3_desc', 'Enhance KYC processes with collective intelligence on identity fraud patterns.')),
    array('icon' => 'trending-up', 'title' => get_theme_mod('usecase_4_title', 'Risk Management'), 'desc' => get_theme_mod('usecase_4_desc', 'Build more accurate credit and operational risk models using aggregated insights.')),
);
?>

<section id="use-cases" class="section">
    <div class="container">
        <div class="section-header reveal">
            <span class="badge badge-primary mb-6"><?php echo esc_html(get_theme_mod('usecases_badge', 'Use Cases')); ?></span>
            <h2><?php _e('Built for', 'vraust-ai'); ?> <span class="text-primary"><?php _e('Critical Applications', 'vraust-ai'); ?></span></h2>
            <p><?php echo esc_html(get_theme_mod('usecases_description', 'Privacy-preserving AI infrastructure for the most sensitive financial operations.')); ?></p>
        </div>

        <div class="grid grid-2" style="max-width: 64rem; margin: 0 auto;">
            <?php foreach ($useCases as $i => $case) : ?>
                <div class="use-case-card reveal reveal-delay-<?php echo $i + 1; ?>">
                    <div class="use-case-content">
                        <div class="use-case-icon"><?php echo vraust_get_icon($case['icon']); ?></div>
                        <div class="use-case-text"><h3><?php echo esc_html($case['title']); ?></h3><p><?php echo esc_html($case['desc']); ?></p></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
