<?php
/**
 * Front Page Template
 *
 * @package Vraust_AI
 */

get_header();

// Hero Section
get_template_part('template-parts/section', 'hero');

// Problem Section
get_template_part('template-parts/section', 'problem');

// Solution Section
get_template_part('template-parts/section', 'solution');

// How It Works Section
get_template_part('template-parts/section', 'how');

// Use Cases Section
get_template_part('template-parts/section', 'usecases');

// Target Clients Section
get_template_part('template-parts/section', 'clients');

// Trust Section
get_template_part('template-parts/section', 'trust');

// CTA Section
get_template_part('template-parts/section', 'cta');

get_footer();
