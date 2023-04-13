<?php
/**
 * Timber関連
 *
 * @package Jun
 */

$timber = new Timber\Timber();

if ( ! class_exists( 'Timber' ) ) {
	add_action(
		'admin_notices',
		function () {
			// phpcs:ignore Generic.Files.LineLength
			echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
		}
	);

	add_filter(
		'template_include',
		function ( $template ) {
			return get_stylesheet_directory() . '/static/no-timber.html';
		}
	);

	return;
}

Timber::$dirname = array( 'templates', 'views' );

/**
 * Timber初期化クラス
 */
class StarterSite extends Timber\Site {

	/**
	 * Add timber support.
	 */
	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'theme_supports' ) );
		add_filter( 'timber/context', array( $this, 'add_to_context' ) );
		add_filter( 'timber/twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		parent::__construct();
	}

	/**
	 * テンプレートへ渡す変数
	 *
	 * @param string $context context['this'] Being the Twig's {{ this }}.
	 */
	public function add_to_context( $context ) {
		// パンくずリスト
		$breadcrumbs = new Inc2734\WP_Breadcrumbs\Bootstrap();
		$context['breadcrumbs'] = $breadcrumbs->get();

		$context['menu']  = new Timber\Menu( 'global' );
		$context['site']  = $this;

		return $context;
	}

	/**
	 * 独自関数
	 *
	 * @param string $twig get extension.
	 */
	public function add_to_twig( $twig ) {
		$twig->addExtension( new Twig\Extension\StringLoaderExtension() );

		$twig->addFunction(
			new Timber\Twig_function( 'get_static_file_path', 'get_static_file_path' )
		);
		$twig->addFunction( new Timber\Twig_function( 'get_image_path', 'get_image_path' ) );

		return $twig;
	}

}

new StarterSite();
