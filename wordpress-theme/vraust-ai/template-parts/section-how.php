<?php
/**
 * How It Works Section Template Part
 */

$steps = array(
    array('num' => '01', 'title' => get_theme_mod('step_1_title', 'Local Training'), 'desc' => get_theme_mod('step_1_desc', 'Each institution trains models on their own data within their secure environment.')),
    array('num' => '02', 'title' => get_theme_mod('step_2_title', 'Secure Aggregation'), 'desc' => get_theme_mod('step_2_desc', 'Only encrypted model updates—never raw data—are shared with the central aggregator.')),
    array('num' => '03', 'title' => get_theme_mod('step_3_title', 'Collective Intelligence'), 'desc' => get_theme_mod('step_3_desc', 'The improved global model is distributed back, benefiting all participants.')),
);
?>

<section id="how-it-works" class="section grain-overlay">
    <div class="container">
        <div class="section-header reveal">
            <span class="badge badge-primary mb-6"><?php echo esc_html(get_theme_mod('how_badge', 'How It Works')); ?></span>
            <h2><?php _e('Federated Learning', 'vraust-ai'); ?> <span class="text-primary"><?php _e('Explained', 'vraust-ai'); ?></span></h2>
            <p><?php echo esc_html(get_theme_mod('how_description', 'Train AI models collaboratively without ever moving sensitive data. Your data stays secure while collective intelligence grows.')); ?></p>
        </div>

        <div class="diagram-container reveal">
            <div class="diagram-glow"></div>
            <div class="diagram-card">
                <svg viewBox="0 0 800 400" class="diagram-svg" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                            <path d="M 40 0 L 0 0 0 40" fill="none" stroke="hsl(210, 30%, 20%)" stroke-width="0.5" opacity="0.3"/>
                        </pattern>
                        <linearGradient id="primaryGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="hsl(206, 88%, 40%)"/>
                            <stop offset="100%" stop-color="hsl(185, 75%, 50%)"/>
                        </linearGradient>
                        <filter id="glow"><feGaussianBlur stdDeviation="3" result="coloredBlur"/><feMerge><feMergeNode in="coloredBlur"/><feMergeNode in="SourceGraphic"/></feMerge></filter>
                    </defs>
                    <rect width="800" height="400" fill="url(#grid)"/>
                    <g class="node-pulse"><circle cx="120" cy="100" r="45" fill="hsl(210, 40%, 15%)" stroke="url(#primaryGradient)" stroke-width="2"/><text x="120" y="95" text-anchor="middle" fill="hsl(210, 20%, 90%)" font-size="11" font-weight="600">Bank A</text><text x="120" y="112" text-anchor="middle" fill="hsl(210, 15%, 60%)" font-size="9">Local Training</text></g>
                    <g class="node-pulse" style="animation-delay: 0.3s"><circle cx="120" cy="300" r="45" fill="hsl(210, 40%, 15%)" stroke="url(#primaryGradient)" stroke-width="2"/><text x="120" y="295" text-anchor="middle" fill="hsl(210, 20%, 90%)" font-size="11" font-weight="600">Bank B</text><text x="120" y="312" text-anchor="middle" fill="hsl(210, 15%, 60%)" font-size="9">Local Training</text></g>
                    <g class="node-pulse" style="animation-delay: 0.6s"><circle cx="120" cy="200" r="45" fill="hsl(210, 40%, 15%)" stroke="url(#primaryGradient)" stroke-width="2"/><text x="120" y="195" text-anchor="middle" fill="hsl(210, 20%, 90%)" font-size="11" font-weight="600">Insurer</text><text x="120" y="212" text-anchor="middle" fill="hsl(210, 15%, 60%)" font-size="9">Local Training</text></g>
                    <path d="M165 100 Q 280 100 400 200" fill="none" stroke="url(#primaryGradient)" stroke-width="2" class="flow-line" filter="url(#glow)"/>
                    <path d="M165 200 L 350 200" fill="none" stroke="url(#primaryGradient)" stroke-width="2" class="flow-line" filter="url(#glow)"/>
                    <path d="M165 300 Q 280 300 400 200" fill="none" stroke="url(#primaryGradient)" stroke-width="2" class="flow-line" filter="url(#glow)"/>
                    <g filter="url(#glow)"><rect x="350" y="140" width="100" height="120" rx="12" fill="hsl(210, 40%, 12%)" stroke="url(#primaryGradient)" stroke-width="3"/><text x="400" y="185" text-anchor="middle" fill="hsl(206, 88%, 50%)" font-size="24">🔐</text><text x="400" y="210" text-anchor="middle" fill="hsl(210, 20%, 90%)" font-size="10" font-weight="600">Secure</text><text x="400" y="225" text-anchor="middle" fill="hsl(210, 20%, 90%)" font-size="10" font-weight="600">Aggregation</text><text x="400" y="245" text-anchor="middle" fill="hsl(185, 75%, 50%)" font-size="8">No raw data</text></g>
                    <path d="M450 200 L 580 200" fill="none" stroke="url(#primaryGradient)" stroke-width="2" class="flow-line" filter="url(#glow)"/>
                    <g class="node-pulse" style="animation-delay: 0.9s"><circle cx="680" cy="200" r="60" fill="hsl(210, 40%, 12%)" stroke="url(#primaryGradient)" stroke-width="3" filter="url(#glow)"/><text x="680" y="185" text-anchor="middle" fill="hsl(210, 20%, 90%)" font-size="12" font-weight="700">Global</text><text x="680" y="205" text-anchor="middle" fill="hsl(210, 20%, 90%)" font-size="12" font-weight="700">Model</text><text x="680" y="225" text-anchor="middle" fill="hsl(185, 75%, 50%)" font-size="9">Shared Intelligence</text></g>
                    <path d="M620 170 Q 400 50 170 95" fill="none" stroke="hsl(185, 75%, 50%)" stroke-width="1.5" stroke-dasharray="6 3" opacity="0.6"/>
                    <path d="M620 200 L 170 200" fill="none" stroke="hsl(185, 75%, 50%)" stroke-width="1.5" stroke-dasharray="6 3" opacity="0.6"/>
                    <path d="M620 230 Q 400 350 170 305" fill="none" stroke="hsl(185, 75%, 50%)" stroke-width="1.5" stroke-dasharray="6 3" opacity="0.6"/>
                    <text x="255" y="145" text-anchor="middle" fill="hsl(210, 15%, 60%)" font-size="9">Encrypted</text>
                    <text x="255" y="158" text-anchor="middle" fill="hsl(210, 15%, 60%)" font-size="9">Gradients</text>
                    <text x="520" y="185" text-anchor="middle" fill="hsl(210, 15%, 60%)" font-size="9">Improved</text>
                    <text x="520" y="198" text-anchor="middle" fill="hsl(210, 15%, 60%)" font-size="9">Model</text>
                    <text x="400" y="380" text-anchor="middle" fill="hsl(185, 75%, 50%)" font-size="11" font-weight="600">← Model updates flow back to each institution →</text>
                </svg>
                <div class="diagram-key-message">
                    <div class="key-message-badge">
                        <span class="badge-dot animate-pulse"></span>
                        <span><?php echo esc_html(get_theme_mod('how_key_message', 'Data never leaves your environment')); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="steps-grid">
            <?php foreach ($steps as $i => $step) : ?>
                <div class="step reveal reveal-delay-<?php echo $i + 1; ?>">
                    <div class="step-number"><?php echo esc_html($step['num']); ?></div>
                    <h3><?php echo esc_html($step['title']); ?></h3>
                    <p><?php echo esc_html($step['desc']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
