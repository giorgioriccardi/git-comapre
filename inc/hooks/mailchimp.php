<?php
if (!function_exists('minimal_lite_mailchimp_form')) :
    /**
     * Mailchimp Form
     *
     * @since 1.0.0
     */
    function minimal_lite_mailchimp_form()
    {
        $enable_mailchimp = minimal_lite_get_option('enable_mailchimp',true);
        if($enable_mailchimp){
            $mailchimp_title = esc_html(minimal_lite_get_option('mailchimp_title',true));
            $mailchimp_shortcode = wp_kses_post(minimal_lite_get_option('mailchimp_shortcode',true));
            if (!empty($mailchimp_shortcode)) {
                ?>
                <section class="section-mailchimp section-block mailchimp-bgcolor section-bg">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="widget-title text-center">
                                    <?php echo esc_html($mailchimp_title); ?>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <?php echo do_shortcode($mailchimp_shortcode);?>
                            </div>
                        </div>
                    </div>
                </section>
                <?php
            }
        }
    }
endif;
add_action('minimal_lite_before_home_footer', 'minimal_lite_mailchimp_form', 20);