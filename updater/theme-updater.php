<?php
/**
 * Easy Digital Downloads Theme Updater
 *
 * @package EDD Sample Theme
 */

// Includes the files needed for the theme updater
if (!class_exists('EDD_Theme_Updater_Admin')) {
	include (dirname(__FILE__).'/theme-updater-admin.php');
}

// Loads the updater classes
$updater = new EDD_Theme_Updater_Admin(

	// Config settings
	$config = array(
		'remote_api_url' => 'https://thememattic.com', // Site where EDD is hosted
		'item_name'      => 'Minimal Lite Pro', // Name of theme
		'theme_slug'     => 'minimal-lite', // Theme slug
		'version'        => '1.0.3', // The current version of this theme
		'author'         => 'Thememattic', // The author of this theme
		'download_id'    => '', // Optional, used for generating a license renewal link
		'renew_url'      => 'https://thememattic.com/my-profile/'// Optional, allows for a custom license renewal link
	),

	// Strings
	$strings = array(
		'theme-license'             => __('Theme License', 'minimal-lite'),
		'enter-key'                 => __('Enter your theme license key.', 'minimal-lite'),
		'license-key'               => __('License Key', 'minimal-lite'),
		'license-action'            => __('License Action', 'minimal-lite'),
		'deactivate-license'        => __('Deactivate License', 'minimal-lite'),
		'activate-license'          => __('Activate License', 'minimal-lite'),
		'status-unknown'            => __('License status is unknown.', 'minimal-lite'),
		'renew'                     => __('Renew?', 'minimal-lite'),
		'unlimited'                 => __('unlimited', 'minimal-lite'),
		'license-key-is-active'     => __('License key is active.', 'minimal-lite'),
		'expires%s'                 => __('Expires %s.', 'minimal-lite'),
		'%1$s/%2$-sites'            => __('You have %1$s / %2$s sites activated.', 'minimal-lite'),
		'license-key-expired-%s'    => __('License key expired %s.', 'minimal-lite'),
		'license-key-expired'       => __('License key has expired.', 'minimal-lite'),
		'license-keys-do-not-match' => __('License keys do not match.', 'minimal-lite'),
		'license-is-inactive'       => __('License is inactive.', 'minimal-lite'),
		'license-key-is-disabled'   => __('License key is disabled.', 'minimal-lite'),
		'site-is-inactive'          => __('Site is inactive.', 'minimal-lite'),
		'license-status-unknown'    => __('License status is unknown.', 'minimal-lite'),
		'update-notice'             => __("Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'minimal-lite'),
		'update-available'          => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'minimal-lite')
	)

);
