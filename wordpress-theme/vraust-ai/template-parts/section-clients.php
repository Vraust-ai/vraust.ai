<?php
/**
 * Target Clients Section
 */
$clients = array(
    array('icon' => 'landmark', 'name' => get_theme_mod('client_1_name', 'Banks'), 'desc' => get_theme_mod('client_1_desc', 'Major financial institutions protecting customer assets')),
    array('icon' => 'building', 'name' => get_theme_mod('client_2_name', 'FinTechs'), 'desc' => get_theme_mod('client_2_desc', 'Innovative payment and lending platforms')),
    array('icon' => 'shield', 'name' => get_theme_mod('client_3_name', 'Insurers'), 'desc' => get_theme_mod('client_3_desc', 'Insurance companies preventing fraud and assessing risk')),
    array('icon' => 'heart', 'name' => get_theme_mod('client_4_name', 'Healthcare'), 'desc' => get_theme_mod('client_4_desc', 'Public health institutions protecting patient data')),
);
$logos = explode(',', get_theme_mod('client_logos', 'Enterprise A, Financial Corp, Health Institute, Bank Group, Insure Co'));
?>

<section class="section grain-overlay">
    <div class="clients-bg"></div>
    <div class="container" style="position: relative; z-index: 10;">
        <div class="section-header reveal">
            <span class="badge badge-accent mb-6"><?php echo esc_html(get_theme_mod('clients_badge', 'Who We Serve')); ?></span>
            <h2><?php _e('Trusted by', 'vraust-ai'); ?> <span class="text-accent"><?php _e('Regulated Industries', 'vraust-ai'); ?></span></h2>
            <p><?php echo esc_html(get_theme_mod('clients_description', 'Enterprise-grade privacy infrastructure for organizations that can\'t compromise on data protection.')); ?></p>
        </div>

        <div class="grid grid-4" style="max-width: 56rem; margin: 0 auto;">
            <?php foreach ($clients as $i => $client) : ?>
                <div class="client-card reveal reveal-delay-<?php echo $i + 1; ?>">
                    <div class="client-icon"><?php echo vraust_get_icon($client['icon']); ?></div>
                    <h3><?php echo esc_html($client['name']); ?></h3>
                    <p><?php echo esc_html($client['desc']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="client-logos reveal">
            <p><?php echo esc_html(get_theme_mod('clients_footer_text', 'Serving Canada\'s leading financial and healthcare organizations')); ?></p>
            <div class="client-logos-list">
                <?php foreach ($logos as $logo) : ?>
                    <span class="client-logo-placeholder"><?php echo esc_html(trim($logo)); ?></span>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
