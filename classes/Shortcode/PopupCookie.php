<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class PUM_Shortcode_PopupCookie
 *
 * Registers the popup_cookie shortcode.
 */
class PUM_Shortcode_PopupCookie extends PUM_Shortcode {

	public $version = 2;

	public $has_content = false;

	/**
	 * The shortcode tag.
	 */
	public function tag() {
		return 'popup_cookie';
	}

	public function label() {
		return __( 'Popup Cookie', 'popup-maker' );
	}

	public function description() {
		return __( 'Insert this to manually set cookies when users view the content containing the code.', 'popup-maker' );
	}

	public function post_types() {
		return array( '*' );
	}

	public function fields() {
		return [
			'general' => [
				'main' => [
					'name'          => [
						'label'       => __( 'Cookie Name', 'popup-maker' ),
						'placeholder' => __( 'Cookie Name ex. popmaker-123', 'popup-maker' ),
						'desc'        => __( 'The name that will be used when checking for or saving this cookie.', 'popup-maker' ),
						'std'         => '',
					],
					'expires'          => [
						'label'       => __( 'Cookie Time', 'popup-maker' ),
						'placeholder' => __( '364 days 23 hours 59 minutes 59 seconds', 'popup-maker' ),
						'desc'        => __( 'Enter a plain english time before cookie expires.', 'popup-maker' ),
						'std'         => '1 month',
					],
					'sitewide'      => [
						'label' => __( 'Sitewide Cookie', 'popup-maker' ),
						'desc'  => __( 'This will prevent the popup from triggering on all pages until the cookie expires.', 'popup-maker' ),
						'type'  => 'checkbox',
						'std'   => true,
					],
					'only_onscreen' => [
						'label' => __( 'Only when visible on-screen', 'popup-maker' ),
						'desc'  => __( 'This will prevent the cookie from getting set until the user scrolls it into viewport.', 'popup-maker' ),
						'type'  => 'checkbox',
						'std'   => false,
					],
				],
			],
		];
	}

	/**
	 * Shortcode handler
	 *
	 * @param array  $atts    shortcode attributes
	 * @param string $content shortcode content
	 *
	 * @return string
	 */
	public function handler( $atts, $content = null ) {
		$atts = $this->shortcode_atts( $atts );

		$args = [
			'name' => $atts['name'],
			'time' => $atts['expires'],
			'path' => $atts['sitewide'],
		];

		$onscreen = 'data-only-onscreen="' . ( $atts['only_onscreen'] ? 1 : 0 ) . '"';

		return "<div class='pum-cookie' data-cookie-args='" . json_encode( $args ) . "' $onscreen />";
	}

	public function template() { ?>
		<div class="pum-cookie"><?php echo __( 'Popup Cookie', 'popup-maker' ); ?></div><?php
	}

}

