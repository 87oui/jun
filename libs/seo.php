<?php
/**
 * SEO関係
 *
 * @package Jun
 */

new \Inc2734\WP_SEO\Bootstrap();

add_filter( 'inc2734_wp_seo_ogp', '__return_true' );
add_filter( 'inc2734_wp_seo_use_json_ld', '__return_true' );

add_filter(
	'inc2734_wp_seo_twitter_card',
	function () {
		return 'summary';
	}
);

add_filter(
	'inc2734_wp_seo_twitter_site',
	function () {
		// NOTE: 文字列型でないとDeprecatedになるため記述
		return '';
	}
);
