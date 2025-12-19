<?php
/**
 * Template Name: Demo Request
 */
get_header();
$success = isset($_GET['demo_success']);
$error = isset($_GET['demo_error']) ? $_GET['demo_error'] : '';
?>

<div class="demo-page grain-overlay">
    <div class="demo-bg"></div>
    <div class="demo-glow-1"></div>
    <div class="demo-glow-2"></div>

    <div class="container demo-container">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="demo-back-link">
            <?php echo vraust_get_icon('arrow-left'); ?>
            <?php _e('Back to Home', 'vraust-ai'); ?>
        </a>

        <div class="demo-grid">
            <div class="demo-info reveal">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
                    <div class="logo-icon"><span>V</span></div>
                    <span class="logo-text">Vraust<span>.ai</span></span>
                </a>
                <h1><?php echo esc_html(get_theme_mod('demo_title', 'Request a')); ?> <span class="text-primary"><?php _e('Demo', 'vraust-ai'); ?></span></h1>
                <p><?php echo esc_html(get_theme_mod('demo_description', 'Discover how Vraust.ai can help your organization fight fraud collaboratively while maintaining complete data privacy.')); ?></p>
                
                <div class="demo-trust-indicators">
                    <div class="demo-trust-item"><div class="demo-trust-icon demo-trust-icon-primary"><?php echo vraust_get_icon('shield'); ?></div><div class="demo-trust-text"><h3><?php _e('Enterprise Security', 'vraust-ai'); ?></h3><p><?php _e('Your information is encrypted and protected', 'vraust-ai'); ?></p></div></div>
                    <div class="demo-trust-item"><div class="demo-trust-icon demo-trust-icon-accent"><?php echo vraust_get_icon('lock'); ?></div><div class="demo-trust-text"><h3><?php _e('Confidential', 'vraust-ai'); ?></h3><p><?php _e('We never share your data with third parties', 'vraust-ai'); ?></p></div></div>
                </div>
                
                <div class="demo-quote">
                    <p>"<?php echo esc_html(get_theme_mod('demo_quote', 'The demo helped us understand how federated learning could transform our fraud detection capabilities.')); ?>"</p>
                    <cite><?php echo esc_html(get_theme_mod('demo_quote_author', '— Financial Institution Partner')); ?></cite>
                </div>
            </div>

            <div class="reveal reveal-delay-1">
                <?php if ($success) : ?>
                    <div class="demo-form-card demo-success">
                        <div class="demo-success-icon"><?php echo vraust_get_icon('check-circle'); ?></div>
                        <h2><?php echo esc_html(get_theme_mod('demo_success_title', 'Thank You!')); ?></h2>
                        <p><?php echo esc_html(get_theme_mod('demo_success_message', 'Your demo request has been received. Our team will contact you within 24 hours.')); ?></p>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-outline"><?php _e('Return to Homepage', 'vraust-ai'); ?></a>
                    </div>
                <?php else : ?>
                    <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" class="demo-form-card">
                        <?php wp_nonce_field('vraust_demo_submission', 'vraust_demo_nonce'); ?>
                        <input type="hidden" name="action" value="vraust_demo_form">
                        
                        <h2><?php _e('Tell us about yourself', 'vraust-ai'); ?></h2>
                        
                        <?php if ($error) : ?>
                            <div class="badge badge-accent mb-4" style="background: rgba(255,100,100,0.1); border-color: rgba(255,100,100,0.3); color: #ff6b6b;">
                                <?php
                                if ($error === 'required') echo __('Please fill in all required fields.', 'vraust-ai');
                                elseif ($error === 'email') echo __('Please enter a valid email address.', 'vraust-ai');
                                else echo __('Something went wrong. Please try again.', 'vraust-ai');
                                ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="form-group"><label class="form-label" for="name"><?php _e('Full Name *', 'vraust-ai'); ?></label><input type="text" id="name" name="name" class="form-input" required placeholder="<?php esc_attr_e('John Smith', 'vraust-ai'); ?>"></div>
                        <div class="form-group"><label class="form-label" for="organization"><?php _e('Organization *', 'vraust-ai'); ?></label><input type="text" id="organization" name="organization" class="form-input" required placeholder="<?php esc_attr_e('Your company name', 'vraust-ai'); ?>"></div>
                        <div class="form-group"><label class="form-label" for="role"><?php _e('Role *', 'vraust-ai'); ?></label><input type="text" id="role" name="role" class="form-input" required placeholder="<?php esc_attr_e('e.g., VP of Data Science', 'vraust-ai'); ?>"></div>
                        <div class="form-group"><label class="form-label" for="industry"><?php _e('Industry *', 'vraust-ai'); ?></label><select id="industry" name="industry" class="form-select" required><option value="" disabled selected><?php _e('Select your industry', 'vraust-ai'); ?></option><option value="Banking"><?php _e('Banking', 'vraust-ai'); ?></option><option value="FinTech"><?php _e('FinTech', 'vraust-ai'); ?></option><option value="Insurance"><?php _e('Insurance', 'vraust-ai'); ?></option><option value="Healthcare"><?php _e('Healthcare', 'vraust-ai'); ?></option><option value="Other"><?php _e('Other', 'vraust-ai'); ?></option></select></div>
                        <div class="form-group"><label class="form-label" for="email"><?php _e('Work Email *', 'vraust-ai'); ?></label><input type="email" id="email" name="email" class="form-input" required placeholder="<?php esc_attr_e('john@company.com', 'vraust-ai'); ?>"></div>
                        <div class="form-group"><label class="form-label" for="message"><?php _e('How can we help? (optional)', 'vraust-ai'); ?></label><textarea id="message" name="message" class="form-textarea" rows="3" placeholder="<?php esc_attr_e('Tell us about your use case...', 'vraust-ai'); ?>"></textarea></div>
                        
                        <button type="submit" class="btn btn-cta demo-form-submit"><?php _e('Request Demo', 'vraust-ai'); ?></button>
                        <p class="demo-form-security"><?php echo vraust_get_icon('lock'); ?> <?php _e('Your information is secure and will never be shared.', 'vraust-ai'); ?></p>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
