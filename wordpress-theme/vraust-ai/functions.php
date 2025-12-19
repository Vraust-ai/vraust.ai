<?php
/**
 * Vraust.ai Theme Functions
 *
 * @package Vraust_AI
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Theme Setup
 */
function vraust_theme_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');

    // Custom logo support
    add_theme_support('custom-logo', array(
        'height'      => 80,
        'width'       => 200,
        'flex-width'  => true,
        'flex-height' => true,
    ));

    // HTML5 support
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Register navigation menus
    register_nav_menus(array(
        'primary'   => __('Primary Menu', 'vraust-ai'),
        'footer'    => __('Footer Menu', 'vraust-ai'),
        'legal'     => __('Legal Menu', 'vraust-ai'),
    ));

    // Add support for responsive embedded content
    add_theme_support('responsive-embeds');

    // Add support for wide alignment
    add_theme_support('align-wide');

    // Add custom background support
    add_theme_support('custom-background', array(
        'default-color' => '0f1721',
    ));

    // Editor styles
    add_theme_support('editor-styles');
    add_editor_style('assets/css/editor-style.css');
}
add_action('after_setup_theme', 'vraust_theme_setup');

/**
 * Enqueue scripts and styles
 */
function vraust_scripts() {
    // Google Fonts - Inter
    wp_enqueue_style(
        'vraust-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap',
        array(),
        null
    );

    // Main stylesheet
    wp_enqueue_style(
        'vraust-style',
        get_stylesheet_uri(),
        array('vraust-google-fonts'),
        wp_get_theme()->get('Version')
    );

    // Main JavaScript
    wp_enqueue_script(
        'vraust-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        wp_get_theme()->get('Version'),
        true
    );

    // Pass data to JavaScript
    wp_localize_script('vraust-main', 'vraustData', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('vraust_nonce'),
        'homeUrl' => home_url(),
    ));
}
add_action('wp_enqueue_scripts', 'vraust_scripts');

/**
 * Register widget areas
 */
function vraust_widgets_init() {
    register_sidebar(array(
        'name'          => __('Footer Widget Area', 'vraust-ai'),
        'id'            => 'footer-widgets',
        'description'   => __('Add widgets here to appear in the footer.', 'vraust-ai'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'vraust_widgets_init');

/**
 * Customizer Settings
 */
function vraust_customize_register($wp_customize) {
    
    // ================================
    // HERO SECTION
    // ================================
    $wp_customize->add_section('vraust_hero_section', array(
        'title'       => __('Hero Section', 'vraust-ai'),
        'priority'    => 30,
        'description' => __('Customize the hero section content.', 'vraust-ai'),
    ));

    // Hero Badge Text
    $wp_customize->add_setting('hero_badge_text', array(
        'default'           => 'Privacy-Preserving AI Infrastructure',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('hero_badge_text', array(
        'label'   => __('Badge Text', 'vraust-ai'),
        'section' => 'vraust_hero_section',
        'type'    => 'text',
    ));

    // Hero Headline Part 1
    $wp_customize->add_setting('hero_headline_1', array(
        'default'           => 'Collaborative AI.',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('hero_headline_1', array(
        'label'   => __('Headline (Line 1)', 'vraust-ai'),
        'section' => 'vraust_hero_section',
        'type'    => 'text',
    ));

    // Hero Headline Part 2 (Gradient)
    $wp_customize->add_setting('hero_headline_2', array(
        'default'           => 'Zero Data Sharing.',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('hero_headline_2', array(
        'label'   => __('Headline (Line 2 - Gradient)', 'vraust-ai'),
        'section' => 'vraust_hero_section',
        'type'    => 'text',
    ));

    // Hero Subheadline
    $wp_customize->add_setting('hero_subheadline', array(
        'default'           => 'Privacy-preserving AI infrastructure for fraud and financial crime detection. The Vault of Trust for Canada\'s regulated industries.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('hero_subheadline', array(
        'label'   => __('Subheadline', 'vraust-ai'),
        'section' => 'vraust_hero_section',
        'type'    => 'textarea',
    ));

    // Primary CTA Text
    $wp_customize->add_setting('hero_cta_primary', array(
        'default'           => 'Request a Demo',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('hero_cta_primary', array(
        'label'   => __('Primary Button Text', 'vraust-ai'),
        'section' => 'vraust_hero_section',
        'type'    => 'text',
    ));

    // Secondary CTA Text
    $wp_customize->add_setting('hero_cta_secondary', array(
        'default'           => 'How It Works',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('hero_cta_secondary', array(
        'label'   => __('Secondary Button Text', 'vraust-ai'),
        'section' => 'vraust_hero_section',
        'type'    => 'text',
    ));

    // Trust Badges
    $wp_customize->add_setting('hero_badge_1', array(
        'default'           => 'AMF Compliant',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('hero_badge_1', array(
        'label'   => __('Trust Badge 1', 'vraust-ai'),
        'section' => 'vraust_hero_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('hero_badge_2', array(
        'default'           => 'Federated Learning',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('hero_badge_2', array(
        'label'   => __('Trust Badge 2', 'vraust-ai'),
        'section' => 'vraust_hero_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('hero_badge_3', array(
        'default'           => 'End-to-End Encrypted',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('hero_badge_3', array(
        'label'   => __('Trust Badge 3', 'vraust-ai'),
        'section' => 'vraust_hero_section',
        'type'    => 'text',
    ));

    // ================================
    // PROBLEM SECTION
    // ================================
    $wp_customize->add_section('vraust_problem_section', array(
        'title'       => __('Problem Section', 'vraust-ai'),
        'priority'    => 31,
    ));

    $wp_customize->add_setting('problem_badge', array(
        'default'           => 'The Challenge',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('problem_badge', array(
        'label'   => __('Section Badge', 'vraust-ai'),
        'section' => 'vraust_problem_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('problem_title', array(
        'default'           => 'Fraud Thrives in Isolation',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('problem_title', array(
        'label'   => __('Section Title', 'vraust-ai'),
        'section' => 'vraust_problem_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('problem_description', array(
        'default'           => 'Financial criminals exploit institutional silos. Current approaches leave billions in losses undetected.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('problem_description', array(
        'label'   => __('Section Description', 'vraust-ai'),
        'section' => 'vraust_problem_section',
        'type'    => 'textarea',
    ));

    // Problem Cards (1-3)
    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting("problem_{$i}_title", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("problem_{$i}_title", array(
            'label'   => sprintf(__('Problem %d Title', 'vraust-ai'), $i),
            'section' => 'vraust_problem_section',
            'type'    => 'text',
        ));

        $wp_customize->add_setting("problem_{$i}_desc", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_textarea_field',
        ));
        $wp_customize->add_control("problem_{$i}_desc", array(
            'label'   => sprintf(__('Problem %d Description', 'vraust-ai'), $i),
            'section' => 'vraust_problem_section',
            'type'    => 'textarea',
        ));
    }

    // ================================
    // SOLUTION SECTION
    // ================================
    $wp_customize->add_section('vraust_solution_section', array(
        'title'       => __('Solution Section', 'vraust-ai'),
        'priority'    => 32,
    ));

    $wp_customize->add_setting('solution_badge', array(
        'default'           => 'The Solution',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('solution_badge', array(
        'label'   => __('Section Badge', 'vraust-ai'),
        'section' => 'vraust_solution_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('solution_title', array(
        'default'           => 'The Vault of Trust',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('solution_title', array(
        'label'   => __('Section Title', 'vraust-ai'),
        'section' => 'vraust_solution_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('solution_description', array(
        'default'           => 'Vraust.ai provides a secure federated learning infrastructure designed specifically for regulated environments. Unlock collective intelligence without compromising privacy.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('solution_description', array(
        'label'   => __('Section Description', 'vraust-ai'),
        'section' => 'vraust_solution_section',
        'type'    => 'textarea',
    ));

    // Pillars (1-4)
    $pillars_defaults = array(
        1 => array('Privacy by Design', 'Data never leaves your infrastructure. Models train locally, only encrypted gradients are shared.'),
        2 => array('Enterprise Security', 'End-to-end encryption, secure aggregation protocols, and zero-trust architecture.'),
        3 => array('Full Explainability', 'Transparent AI decisions with audit trails and interpretable model outputs.'),
        4 => array('AMF Compliance', 'Built to meet Canadian regulatory requirements for financial AI applications.'),
    );

    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting("pillar_{$i}_title", array(
            'default'           => $pillars_defaults[$i][0],
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("pillar_{$i}_title", array(
            'label'   => sprintf(__('Pillar %d Title', 'vraust-ai'), $i),
            'section' => 'vraust_solution_section',
            'type'    => 'text',
        ));

        $wp_customize->add_setting("pillar_{$i}_desc", array(
            'default'           => $pillars_defaults[$i][1],
            'sanitize_callback' => 'sanitize_textarea_field',
        ));
        $wp_customize->add_control("pillar_{$i}_desc", array(
            'label'   => sprintf(__('Pillar %d Description', 'vraust-ai'), $i),
            'section' => 'vraust_solution_section',
            'type'    => 'textarea',
        ));
    }

    // Vault Content
    $wp_customize->add_setting('vault_title', array(
        'default'           => 'Your Data. Your Control. Shared Intelligence.',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('vault_title', array(
        'label'   => __('Vault Title', 'vraust-ai'),
        'section' => 'vraust_solution_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('vault_description', array(
        'default'           => 'With Vraust.ai, participating institutions maintain complete sovereignty over their data while contributing to a collectively smarter AI. The vault metaphor isn\'t just branding—it\'s our architecture: impenetrable protection with selective, secure collaboration.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('vault_description', array(
        'label'   => __('Vault Description', 'vraust-ai'),
        'section' => 'vraust_solution_section',
        'type'    => 'textarea',
    ));

    // ================================
    // HOW IT WORKS SECTION
    // ================================
    $wp_customize->add_section('vraust_how_section', array(
        'title'       => __('How It Works Section', 'vraust-ai'),
        'priority'    => 33,
    ));

    $wp_customize->add_setting('how_badge', array(
        'default'           => 'How It Works',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('how_badge', array(
        'label'   => __('Section Badge', 'vraust-ai'),
        'section' => 'vraust_how_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('how_title', array(
        'default'           => 'Federated Learning Explained',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('how_title', array(
        'label'   => __('Section Title', 'vraust-ai'),
        'section' => 'vraust_how_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('how_description', array(
        'default'           => 'Train AI models collaboratively without ever moving sensitive data. Your data stays secure while collective intelligence grows.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('how_description', array(
        'label'   => __('Section Description', 'vraust-ai'),
        'section' => 'vraust_how_section',
        'type'    => 'textarea',
    ));

    $wp_customize->add_setting('how_key_message', array(
        'default'           => 'Data never leaves your environment',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('how_key_message', array(
        'label'   => __('Key Message', 'vraust-ai'),
        'section' => 'vraust_how_section',
        'type'    => 'text',
    ));

    // Steps (1-3)
    $steps_defaults = array(
        1 => array('Local Training', 'Each institution trains models on their own data within their secure environment.'),
        2 => array('Secure Aggregation', 'Only encrypted model updates—never raw data—are shared with the central aggregator.'),
        3 => array('Collective Intelligence', 'The improved global model is distributed back, benefiting all participants.'),
    );

    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting("step_{$i}_title", array(
            'default'           => $steps_defaults[$i][0],
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("step_{$i}_title", array(
            'label'   => sprintf(__('Step %d Title', 'vraust-ai'), $i),
            'section' => 'vraust_how_section',
            'type'    => 'text',
        ));

        $wp_customize->add_setting("step_{$i}_desc", array(
            'default'           => $steps_defaults[$i][1],
            'sanitize_callback' => 'sanitize_textarea_field',
        ));
        $wp_customize->add_control("step_{$i}_desc", array(
            'label'   => sprintf(__('Step %d Description', 'vraust-ai'), $i),
            'section' => 'vraust_how_section',
            'type'    => 'textarea',
        ));
    }

    // ================================
    // USE CASES SECTION
    // ================================
    $wp_customize->add_section('vraust_usecases_section', array(
        'title'       => __('Use Cases Section', 'vraust-ai'),
        'priority'    => 34,
    ));

    $wp_customize->add_setting('usecases_badge', array(
        'default'           => 'Use Cases',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('usecases_badge', array(
        'label'   => __('Section Badge', 'vraust-ai'),
        'section' => 'vraust_usecases_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('usecases_title', array(
        'default'           => 'Built for Critical Applications',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('usecases_title', array(
        'label'   => __('Section Title', 'vraust-ai'),
        'section' => 'vraust_usecases_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('usecases_description', array(
        'default'           => 'Privacy-preserving AI infrastructure for the most sensitive financial operations.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('usecases_description', array(
        'label'   => __('Section Description', 'vraust-ai'),
        'section' => 'vraust_usecases_section',
        'type'    => 'textarea',
    ));

    // Use Cases (1-4)
    $usecases_defaults = array(
        1 => array('Fraud Detection', 'Identify fraudulent patterns across institutions without exposing transaction data. Detect sophisticated schemes invisible to individual organizations.'),
        2 => array('AML & Financial Crime', 'Strengthen anti-money laundering models with cross-institutional signals while maintaining strict data sovereignty.'),
        3 => array('Identity Verification', 'Enhance KYC processes with collective intelligence on identity fraud patterns and synthetic identities.'),
        4 => array('Risk Management', 'Build more accurate credit and operational risk models using aggregated insights from multiple data sources.'),
    );

    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting("usecase_{$i}_title", array(
            'default'           => $usecases_defaults[$i][0],
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("usecase_{$i}_title", array(
            'label'   => sprintf(__('Use Case %d Title', 'vraust-ai'), $i),
            'section' => 'vraust_usecases_section',
            'type'    => 'text',
        ));

        $wp_customize->add_setting("usecase_{$i}_desc", array(
            'default'           => $usecases_defaults[$i][1],
            'sanitize_callback' => 'sanitize_textarea_field',
        ));
        $wp_customize->add_control("usecase_{$i}_desc", array(
            'label'   => sprintf(__('Use Case %d Description', 'vraust-ai'), $i),
            'section' => 'vraust_usecases_section',
            'type'    => 'textarea',
        ));
    }

    // ================================
    // TARGET CLIENTS SECTION
    // ================================
    $wp_customize->add_section('vraust_clients_section', array(
        'title'       => __('Target Clients Section', 'vraust-ai'),
        'priority'    => 35,
    ));

    $wp_customize->add_setting('clients_badge', array(
        'default'           => 'Who We Serve',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('clients_badge', array(
        'label'   => __('Section Badge', 'vraust-ai'),
        'section' => 'vraust_clients_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('clients_title', array(
        'default'           => 'Trusted by Regulated Industries',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('clients_title', array(
        'label'   => __('Section Title', 'vraust-ai'),
        'section' => 'vraust_clients_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('clients_description', array(
        'default'           => 'Enterprise-grade privacy infrastructure for organizations that can\'t compromise on data protection.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('clients_description', array(
        'label'   => __('Section Description', 'vraust-ai'),
        'section' => 'vraust_clients_section',
        'type'    => 'textarea',
    ));

    $wp_customize->add_setting('clients_footer_text', array(
        'default'           => 'Serving Canada\'s leading financial and healthcare organizations',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('clients_footer_text', array(
        'label'   => __('Footer Text', 'vraust-ai'),
        'section' => 'vraust_clients_section',
        'type'    => 'text',
    ));

    // Clients (1-4)
    $clients_defaults = array(
        1 => array('Banks', 'Major financial institutions protecting customer assets'),
        2 => array('FinTechs', 'Innovative payment and lending platforms'),
        3 => array('Insurers', 'Insurance companies preventing fraud and assessing risk'),
        4 => array('Healthcare', 'Public health institutions protecting patient data'),
    );

    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting("client_{$i}_name", array(
            'default'           => $clients_defaults[$i][0],
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("client_{$i}_name", array(
            'label'   => sprintf(__('Client %d Name', 'vraust-ai'), $i),
            'section' => 'vraust_clients_section',
            'type'    => 'text',
        ));

        $wp_customize->add_setting("client_{$i}_desc", array(
            'default'           => $clients_defaults[$i][1],
            'sanitize_callback' => 'sanitize_textarea_field',
        ));
        $wp_customize->add_control("client_{$i}_desc", array(
            'label'   => sprintf(__('Client %d Description', 'vraust-ai'), $i),
            'section' => 'vraust_clients_section',
            'type'    => 'textarea',
        ));
    }

    // Client logos (comma-separated)
    $wp_customize->add_setting('client_logos', array(
        'default'           => 'Enterprise A, Financial Corp, Health Institute, Bank Group, Insure Co',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('client_logos', array(
        'label'       => __('Client Logo Names (comma-separated)', 'vraust-ai'),
        'description' => __('Enter placeholder names for client logos', 'vraust-ai'),
        'section'     => 'vraust_clients_section',
        'type'        => 'text',
    ));

    // ================================
    // TRUST SECTION
    // ================================
    $wp_customize->add_section('vraust_trust_section', array(
        'title'       => __('Trust Section', 'vraust-ai'),
        'priority'    => 36,
    ));

    $wp_customize->add_setting('trust_badge', array(
        'default'           => 'Research Foundation',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('trust_badge', array(
        'label'   => __('Section Badge', 'vraust-ai'),
        'section' => 'vraust_trust_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('trust_title', array(
        'default'           => 'Built on Rigorous Science',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('trust_title', array(
        'label'   => __('Section Title', 'vraust-ai'),
        'section' => 'vraust_trust_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('trust_description', array(
        'default'           => 'Vraust.ai is founded on years of academic research in privacy-preserving AI, with deep expertise in both financial and healthcare domains.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('trust_description', array(
        'label'   => __('Section Description', 'vraust-ai'),
        'section' => 'vraust_trust_section',
        'type'    => 'textarea',
    ));

    // Credentials (1-4)
    $creds_defaults = array(
        1 => array('10+', 'Years of Research', 'In privacy-preserving machine learning'),
        2 => array('15+', 'Research Partners', 'Including top Canadian universities'),
        3 => array('Healthcare', 'Clinical Collaborations', 'With leading medical institutions'),
        4 => array('AMF', 'Regulatory Expertise', 'Built for Canadian compliance'),
    );

    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting("cred_{$i}_value", array(
            'default'           => $creds_defaults[$i][0],
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("cred_{$i}_value", array(
            'label'   => sprintf(__('Credential %d Value', 'vraust-ai'), $i),
            'section' => 'vraust_trust_section',
            'type'    => 'text',
        ));

        $wp_customize->add_setting("cred_{$i}_label", array(
            'default'           => $creds_defaults[$i][1],
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("cred_{$i}_label", array(
            'label'   => sprintf(__('Credential %d Label', 'vraust-ai'), $i),
            'section' => 'vraust_trust_section',
            'type'    => 'text',
        ));

        $wp_customize->add_setting("cred_{$i}_desc", array(
            'default'           => $creds_defaults[$i][2],
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("cred_{$i}_desc", array(
            'label'   => sprintf(__('Credential %d Description', 'vraust-ai'), $i),
            'section' => 'vraust_trust_section',
            'type'    => 'text',
        ));
    }

    // Quote
    $wp_customize->add_setting('trust_quote', array(
        'default'           => 'Our mission is to unlock collective intelligence across data-sensitive ecosystems while maintaining strict confidentiality, regulatory compliance, and operational control.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('trust_quote', array(
        'label'   => __('Quote Text', 'vraust-ai'),
        'section' => 'vraust_trust_section',
        'type'    => 'textarea',
    ));

    // ================================
    // CTA SECTION
    // ================================
    $wp_customize->add_section('vraust_cta_section', array(
        'title'       => __('CTA Section', 'vraust-ai'),
        'priority'    => 37,
    ));

    $wp_customize->add_setting('cta_badge', array(
        'default'           => 'Ready to Transform',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('cta_badge', array(
        'label'   => __('Badge Text', 'vraust-ai'),
        'section' => 'vraust_cta_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('cta_title', array(
        'default'           => 'See Vraust.ai in Action',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('cta_title', array(
        'label'   => __('Title', 'vraust-ai'),
        'section' => 'vraust_cta_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('cta_description', array(
        'default'           => 'Deploy collaborative AI without compromising privacy. Join Canada\'s leading financial institutions in the fight against fraud and financial crime.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('cta_description', array(
        'label'   => __('Description', 'vraust-ai'),
        'section' => 'vraust_cta_section',
        'type'    => 'textarea',
    ));

    $wp_customize->add_setting('cta_primary_button', array(
        'default'           => 'Request a Demo',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('cta_primary_button', array(
        'label'   => __('Primary Button Text', 'vraust-ai'),
        'section' => 'vraust_cta_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('cta_secondary_button', array(
        'default'           => 'Contact Sales',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('cta_secondary_button', array(
        'label'   => __('Secondary Button Text', 'vraust-ai'),
        'section' => 'vraust_cta_section',
        'type'    => 'text',
    ));

    // ================================
    // DEMO PAGE SECTION
    // ================================
    $wp_customize->add_section('vraust_demo_section', array(
        'title'       => __('Demo Page', 'vraust-ai'),
        'priority'    => 38,
    ));

    $wp_customize->add_setting('demo_title', array(
        'default'           => 'Request a Demo',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('demo_title', array(
        'label'   => __('Page Title', 'vraust-ai'),
        'section' => 'vraust_demo_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('demo_description', array(
        'default'           => 'Discover how Vraust.ai can help your organization fight fraud collaboratively while maintaining complete data privacy. Our team will walk you through the platform and answer all your questions.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('demo_description', array(
        'label'   => __('Description', 'vraust-ai'),
        'section' => 'vraust_demo_section',
        'type'    => 'textarea',
    ));

    $wp_customize->add_setting('demo_quote', array(
        'default'           => 'The demo helped us understand how federated learning could transform our fraud detection capabilities without compromising customer privacy.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('demo_quote', array(
        'label'   => __('Testimonial Quote', 'vraust-ai'),
        'section' => 'vraust_demo_section',
        'type'    => 'textarea',
    ));

    $wp_customize->add_setting('demo_quote_author', array(
        'default'           => '— Financial Institution Partner',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('demo_quote_author', array(
        'label'   => __('Quote Author', 'vraust-ai'),
        'section' => 'vraust_demo_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('demo_success_title', array(
        'default'           => 'Thank You!',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('demo_success_title', array(
        'label'   => __('Success Title', 'vraust-ai'),
        'section' => 'vraust_demo_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('demo_success_message', array(
        'default'           => 'Your demo request has been received. Our team will contact you within 24 hours to schedule a personalized walkthrough of Vraust.ai.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('demo_success_message', array(
        'label'   => __('Success Message', 'vraust-ai'),
        'section' => 'vraust_demo_section',
        'type'    => 'textarea',
    ));

    // Email recipient
    $wp_customize->add_setting('demo_email_recipient', array(
        'default'           => get_option('admin_email'),
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('demo_email_recipient', array(
        'label'       => __('Demo Request Email Recipient', 'vraust-ai'),
        'description' => __('Email address to receive demo requests', 'vraust-ai'),
        'section'     => 'vraust_demo_section',
        'type'        => 'email',
    ));

    // ================================
    // FOOTER SECTION
    // ================================
    $wp_customize->add_section('vraust_footer_section', array(
        'title'       => __('Footer', 'vraust-ai'),
        'priority'    => 39,
    ));

    $wp_customize->add_setting('footer_description', array(
        'default'           => 'The Vault of Trust for Collaborative AI. Privacy-preserving machine learning infrastructure for Canada\'s regulated industries.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('footer_description', array(
        'label'   => __('Footer Description', 'vraust-ai'),
        'section' => 'vraust_footer_section',
        'type'    => 'textarea',
    ));

    $wp_customize->add_setting('footer_made_in', array(
        'default'           => 'Made in Canada 🍁',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('footer_made_in', array(
        'label'   => __('Made In Text', 'vraust-ai'),
        'section' => 'vraust_footer_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('footer_copyright', array(
        'default'           => 'Vraust.ai. All rights reserved.',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('footer_copyright', array(
        'label'   => __('Copyright Text', 'vraust-ai'),
        'section' => 'vraust_footer_section',
        'type'    => 'text',
    ));

    // ================================
    // CONTACT INFO
    // ================================
    $wp_customize->add_section('vraust_contact_section', array(
        'title'       => __('Contact Info', 'vraust-ai'),
        'priority'    => 40,
    ));

    $wp_customize->add_setting('contact_email', array(
        'default'           => 'contact@vraust.ai',
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('contact_email', array(
        'label'   => __('Contact Email', 'vraust-ai'),
        'section' => 'vraust_contact_section',
        'type'    => 'email',
    ));

    $wp_customize->add_setting('contact_phone', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('contact_phone', array(
        'label'   => __('Phone Number', 'vraust-ai'),
        'section' => 'vraust_contact_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('linkedin_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('linkedin_url', array(
        'label'   => __('LinkedIn URL', 'vraust-ai'),
        'section' => 'vraust_contact_section',
        'type'    => 'url',
    ));

    $wp_customize->add_setting('twitter_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('twitter_url', array(
        'label'   => __('Twitter/X URL', 'vraust-ai'),
        'section' => 'vraust_contact_section',
        'type'    => 'url',
    ));
}
add_action('customize_register', 'vraust_customize_register');

/**
 * Handle Demo Form Submission
 */
function vraust_handle_demo_form() {
    // Verify nonce
    if (!isset($_POST['vraust_demo_nonce']) || !wp_verify_nonce($_POST['vraust_demo_nonce'], 'vraust_demo_submission')) {
        wp_die(__('Security check failed', 'vraust-ai'));
    }

    // Sanitize form data
    $name         = sanitize_text_field($_POST['name'] ?? '');
    $organization = sanitize_text_field($_POST['organization'] ?? '');
    $role         = sanitize_text_field($_POST['role'] ?? '');
    $industry     = sanitize_text_field($_POST['industry'] ?? '');
    $email        = sanitize_email($_POST['email'] ?? '');
    $message      = sanitize_textarea_field($_POST['message'] ?? '');

    // Validate required fields
    if (empty($name) || empty($organization) || empty($email)) {
        wp_redirect(add_query_arg('demo_error', 'required', get_permalink()));
        exit;
    }

    // Validate email
    if (!is_email($email)) {
        wp_redirect(add_query_arg('demo_error', 'email', get_permalink()));
        exit;
    }

    // Prepare email
    $to      = get_theme_mod('demo_email_recipient', get_option('admin_email'));
    $subject = sprintf(__('[Vraust.ai Demo Request] %s from %s', 'vraust-ai'), $name, $organization);
    
    $body = sprintf(
        "New demo request received:\n\n" .
        "Name: %s\n" .
        "Organization: %s\n" .
        "Role: %s\n" .
        "Industry: %s\n" .
        "Email: %s\n\n" .
        "Message:\n%s",
        $name,
        $organization,
        $role,
        $industry,
        $email,
        $message
    );

    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'Reply-To: ' . $email,
    );

    // Send email
    $sent = wp_mail($to, $subject, $body, $headers);

    if ($sent) {
        wp_redirect(add_query_arg('demo_success', '1', get_permalink()));
    } else {
        wp_redirect(add_query_arg('demo_error', 'send', get_permalink()));
    }
    exit;
}
add_action('admin_post_vraust_demo_form', 'vraust_handle_demo_form');
add_action('admin_post_nopriv_vraust_demo_form', 'vraust_handle_demo_form');

/**
 * Add body classes
 */
function vraust_body_classes($classes) {
    if (is_front_page()) {
        $classes[] = 'front-page';
    }
    
    if (is_page_template('page-demo.php')) {
        $classes[] = 'demo-page';
    }

    return $classes;
}
add_filter('body_class', 'vraust_body_classes');

/**
 * Add preconnect for Google Fonts
 */
function vraust_preconnect_fonts() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
}
add_action('wp_head', 'vraust_preconnect_fonts', 1);

/**
 * Custom excerpt length
 */
function vraust_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'vraust_excerpt_length');

/**
 * Custom excerpt more
 */
function vraust_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'vraust_excerpt_more');

/**
 * Get theme option with default
 */
function vraust_get_option($option, $default = '') {
    return get_theme_mod($option, $default);
}

/**
 * Custom navigation walker for main menu
 */
class Vraust_Nav_Walker extends Walker_Nav_Menu {
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = implode(' ', $item->classes);
        $is_current = in_array('current-menu-item', $item->classes);
        
        $output .= '<a href="' . esc_url($item->url) . '" class="nav-link ' . ($is_current ? 'active' : '') . '">';
        $output .= esc_html($item->title);
        $output .= '</a>';
    }
    
    public function end_el(&$output, $item, $depth = 0, $args = null) {
        // No closing tag needed
    }
}

/**
 * Include SVG icons
 */
function vraust_get_icon($icon_name) {
    $icons = array(
        'shield' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/></svg>',
        'lock' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>',
        'eye' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>',
        'file-check' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="m9 15 2 2 4-4"/></svg>',
        'database' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M3 5V19A9 3 0 0 0 21 19V5"/><path d="M3 12A9 3 0 0 0 21 12"/></svg>',
        'alert-triangle' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><path d="M12 9v4"/><path d="M12 17h.01"/></svg>',
        'building' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="16" height="20" x="4" y="2" rx="2" ry="2"/><path d="M9 22v-4h6v4"/><path d="M8 6h.01"/><path d="M16 6h.01"/><path d="M12 6h.01"/><path d="M12 10h.01"/><path d="M12 14h.01"/><path d="M16 10h.01"/><path d="M16 14h.01"/><path d="M8 10h.01"/><path d="M8 14h.01"/></svg>',
        'shield-alert' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="M12 8v4"/><path d="M12 16h.01"/></svg>',
        'fingerprint' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 10a2 2 0 0 0-2 2c0 1.02-.1 2.51-.26 4"/><path d="M14 13.12c0 2.38 0 6.38-1 8.88"/><path d="M17.29 21.02c.12-.6.43-2.3.5-3.02"/><path d="M2 12a10 10 0 0 1 18-6"/><path d="M2 16h.01"/><path d="M21.8 16c.2-2 .131-5.354 0-6"/><path d="M5 19.5C5.5 18 6 15 6 12a6 6 0 0 1 .34-2"/><path d="M8.65 22c.21-.66.45-1.32.57-2"/><path d="M9 6.8a6 6 0 0 1 9 5.2v2"/></svg>',
        'user-check' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><polyline points="16 11 18 13 22 9"/></svg>',
        'trending-up' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg>',
        'landmark' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" x2="21" y1="22" y2="22"/><line x1="6" x2="6" y1="18" y2="11"/><line x1="10" x2="10" y1="18" y2="11"/><line x1="14" x2="14" y1="18" y2="11"/><line x1="18" x2="18" y1="18" y2="11"/><polygon points="12 2 20 7 4 7"/></svg>',
        'heart' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>',
        'graduation-cap' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z"/><path d="M22 10v6"/><path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"/></svg>',
        'microscope' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 18h8"/><path d="M3 22h18"/><path d="M14 22a7 7 0 1 0 0-14h-1"/><path d="M9 14h2"/><path d="M9 12a2 2 0 0 1-2-2V6h6v4a2 2 0 0 1-2 2Z"/><path d="M12 6V3a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v3"/></svg>',
        'award' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/></svg>',
        'arrow-right' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>',
        'arrow-left' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>',
        'chevron-down' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>',
        'check' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>',
        'check-circle' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>',
        'menu' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>',
        'x' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>',
    );

    return isset($icons[$icon_name]) ? $icons[$icon_name] : '';
}

/**
 * Add theme info to footer
 */
function vraust_footer_credits() {
    $copyright = get_theme_mod('footer_copyright', 'Vraust.ai. All rights reserved.');
    echo '<p class="text-muted">&copy; ' . date('Y') . ' ' . esc_html($copyright) . '</p>';
}
