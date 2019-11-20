<?php
// based on https://gist.github.com/cosmocatalano/4544576
function wb_scrape_instagram( $username, $access_token, $slice = 9)
{
    $username = strtolower($username);
    $username = str_replace('@', '', $username);

    if (false === ($instagram = get_transient('instagram-a3-' . sanitize_title_with_dashes($username)))) {

        $remote = wp_remote_get('https://api.instagram.com/v1/users/self/media/recent/?access_token='.$access_token);

        if (is_wp_error($remote)) {
            return new WP_Error('site_down', esc_html__('Unable to communicate with Instagram.', 'minimal-lite'));
        }

        if (200 != wp_remote_retrieve_response_code($remote)) {
            return new WP_Error('invalid_response', esc_html__('Instagram did not return a 200.', 'minimal-lite'));
        }

        $response = wp_remote_retrieve_body( $remote );
        if ($response === false) {
            return new WP_Error('invalid_body', esc_html__('Instagram did not return a 200.', 'minimal-lite'));
        }

        $data = json_decode($response, true);

        if ( $data === null) {
            return new WP_Error('bad_json', esc_html__('Instagram has returned invalid data.', 'minimal-lite'));
        }

        if (isset($data['data'])) {
            $images = $data['data'];
        } else {
            return new WP_Error('bad_json_2', esc_html__('Instagram has returned invalid data.', 'minimal-lite'));
        }

        if (!is_array($images)) {
            return new WP_Error('bad_array', esc_html__('Instagram has returned invalid data.', 'minimal-lite'));
        }

        $instagram = array();


        if (isset($images)) {

            foreach ($images as $node) {

                $node['thumbnail_src'] = preg_replace('/^https?\:/i', '', $node['images']['thumbnail']['url']);
                $node['low_resolution'] = preg_replace('/^https?\:/i', '', $node['images']['low_resolution']['url']);
                $node['standard_resolution'] = preg_replace('/^https?\:/i', '', $node['images']['standard_resolution']['url']);

                $instagram[] = array(
                    'thumbnail' => $node['thumbnail_src'],
                    'small' => $node['low_resolution'],
                    'original' => $node['standard_resolution'],
                );
            }
        }

        // do not set an empty transient - should help catch private or empty accounts
        if (!empty($instagram)) {
            set_transient('instagram-a3-' . sanitize_title_with_dashes($username), $instagram, apply_filters('minimal_lite_instagram_cache_time', HOUR_IN_SECONDS * 1));
        }
    }

    if (!empty($instagram)) {
        return array_slice($instagram, 0, $slice);
    } else {
        return new WP_Error('no_images', esc_html__('Instagram did not return any images.', 'minimal-lite'));
    }
}

if (!function_exists('minimal_lite_instagram_images')) :
    /**
     * Instagram Images
     *
     * @since 1.0.0
     */
    function minimal_lite_instagram_images()
    {
        $enable_instagram = minimal_lite_get_option('enable_instagram',true);
        $enable_instagram_slider = minimal_lite_get_option('enable_instagram_slider');
        if($enable_instagram){
            $username = esc_attr(minimal_lite_get_option('instagram_user_name',true));
            $access_token = esc_attr(minimal_lite_get_option('instagram_access_token',true));
            $number = absint(minimal_lite_get_option('number_of_insta_img',true) );

            if (!empty($username) && !empty($access_token) && !empty($number) ) {
                $media_array = wb_scrape_instagram($username, $access_token, $number);
                if (is_wp_error($media_array)) {
                    echo wp_kses_post($media_array->get_error_message());
                } else {
                $enable_instagram_slider_style = '';
                if ($enable_instagram_slider == true) {
                    $enable_instagram_slider_style = "insta-slider-enable";
                } else {
                    $enable_instagram_slider_style = "insta-slider-disable";
                }
                    ?>
                    <div class="section-block section-insta-block">
                        <div class="insta-slider-wrapper">
                            <div class="insta-slider <?php echo esc_attr($enable_instagram_slider_style); ?>">
                                <?php
                                foreach ($media_array as $item) { ?>
                                    <div class="insta-item zoom-gallery">
                                        <figure>
                                            <a href="<?php echo esc_url($item['original'])?>" target="_self" class="insta-hover">
                                                <img src="<?php echo esc_url($item['small']) ?>"  />
                                            </a>
                                        </figure>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class ="insta-button">
                                <a href="//instagram.com/<?php echo esc_attr( trim( $username ) ); ?>" rel="me" class="moretag" target="_blank">
                                    <span class="ion-social-instagram"></span> <?php echo esc_html__( 'view On Instagram', 'minimal-lite' ); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
        }
    }
endif;
add_action('minimal_lite_before_home_footer', 'minimal_lite_instagram_images', 10);