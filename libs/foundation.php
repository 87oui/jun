<?php
/**
 * 基本設定
 *
 * @package Jun
 */

if ( ! function_exists( 'jun_custom_document_title_separator' ) ) {
	/**
	 * タイトルの区切り文字を変更
	 *
	 * @return string  区切り文字
	 */
	function jun_custom_document_title_separator() {
		return '|';
	}
}
add_filter( 'document_title_separator', 'jun_custom_document_title_separator' );

// WordPressのバージョン情報を削除
remove_action( 'wp_head', 'wp_generator' );

// RSDリンクを削除
remove_action( 'wp_head', 'rsd_link' );

// Windows Live Writer用タグを削除
remove_action( 'wp_head', 'wlwmanifest_link' );

// oEmbedタグを削除
remove_action( 'wp_head', 'rest_output_link_wp_head' );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'wp_head', 'wp_oembed_add_host_js' );

if ( ! function_exists( 'jun_disable_emoji' ) ) {
	/**
	 * 絵文字を無効化
	 *
	 * @return void
	 */
	function jun_disable_emoji() {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	}
}
add_action( 'init', 'jun_disable_emoji' );
