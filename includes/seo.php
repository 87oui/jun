<?php
/**
 * SEO関係
 *
 * @package Jun
 */

// SEOライブラリ読み込み
new Inc2734\WP_SEO\Bootstrap();

if ( ! function_exists( 'jun_add_ogp' ) ) {
	/**
	 * OGPメタタグを追加
	 */
	function jun_add_ogp() {
		$ogp = new Inc2734\WP_OGP\Bootstrap(); ?>
		<meta name="description" content="<?php echo esc_attr( $ogp->get_description() ); ?>">
		<meta property="og:title" content="<?php echo esc_attr( $ogp->get_title() ); ?>">
		<meta property="og:type" content="<?php echo esc_attr( $ogp->get_type() ); ?>">
		<meta property="og:url" content="<?php echo esc_attr( $ogp->get_url() ); ?>">
		<meta property="og:image" content="<?php echo esc_attr( $ogp->get_image() ); ?>">
		<meta property="og:site_name" content="<?php echo esc_attr( $ogp->get_site_name() ); ?>">
		<meta property="og:description" content="
			<?php echo esc_attr( $ogp->get_description() ); ?>
		">
		<meta property="og:locale" content="<?php echo esc_attr( $ogp->get_locale() ); ?>">
		<?php
	}
}
add_action( 'wp_head', 'jun_add_ogp' );

if ( ! function_exists( 'jun_ogp_image_default' ) ) {
	/**
	 * デフォルトOGP画像を設定
	 *
	 * @return string
	 */
	function jun_ogp_image_default() {
		return get_stylesheet_directory_uri() . '/assets/images/common/ogp.png';
	}
}
add_filter( 'inc2734_wp_seo_defult_ogp_image_url', 'jun_ogp_image_default' );
