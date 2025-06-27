<?php
/**
 * StarterSite
 */

namespace App;

use Timber\Site;
use Timber\Timber;

/**
 * Class StarterSite
 */
class StarterSite extends Site {

	/**
	 * constructor
	 *
	 * @return  void
	 */
	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'theme_supports' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );

		add_filter( 'timber/context', array( $this, 'add_to_context' ) );
		add_filter( 'timber/twig', array( $this, 'add_to_twig' ) );
		add_filter( 'timber/twig/environment/options', array( $this, 'update_twig_environment_options' ) );

		parent::__construct();
	}

	/**
	 * This is where you can register custom post types.
	 */
	public function register_post_types() {
	}

	/**
	 * This is where you can register custom taxonomies.
	 */
	public function register_taxonomies() {
	}

	/**
	 * This is where you add some context
	 *
	 * @param string $context context['this'] Being the Twig's {{ this }}.
	 */
	public function add_to_context( $context ) {
		$context['site'] = $this;

		// 環境変数
		$context['env'] = wp_get_environment_type();

		// パンくずリスト
		$breadcrumbs            = new \Inc2734\WP_Breadcrumbs\Bootstrap();
		$context['breadcrumbs'] = $breadcrumbs->get();

		// メニュー
		$menu            = Timber::get_menu( 'global' );
		$context['menu'] = $menu;

		return $context;
	}

	/**
	 * theme supports
	 *
	 * @return  void
	 */
	public function theme_supports() {
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'audio',
			)
		);

		add_theme_support( 'menus' );
		register_nav_menus(
			array(
				'global' => 'グローバルナビゲーション',
			)
		);

		/**
		 * 埋め込みコンテンツのレスポンシブ化を有効化
		 * 
		 * See: https://ja.wordpress.org/team/handbook/block-editor/how-to-guides/themes/theme-support/
		 */
		add_theme_support( 'responsive-embeds' );
	}

	/**
	 * This is where you can add your own functions to twig.
	 *
	 * @param Twig\Environment $twig get extension.
	 */
	public function add_to_twig( $twig ) {
		/**
		 * Required when you want to use Twig’s template_from_string.
		 *
		 * @link https://twig.symfony.com/doc/3.x/functions/template_from_string.html
		 */
		$twig->addFunction( new \Twig\TwigFunction( 'get_static_file_path', 'get_static_file_path' ) );
		$twig->addFunction( new \Twig\TwigFunction( 'get_image_path', 'get_image_path' ) );
		$twig->addFunction(
			new \Twig\TwigFunction(
				'clsx',
				function ( ...$classnames ) {
					$classnames = array_filter(
						$classnames,
						function ( $classname ) {
							return ! empty( $classname ) && is_string( $classname );
						}
					);

					return implode( ' ', $classnames );
				}
			)
		);

		return $twig;
	}

	/**
	 * Updates Twig environment options.
	 *
	 * @link https://twig.symfony.com/doc/2.x/api.html#environment-options
	 *
	 * @param array $options An array of environment options.
	 *
	 * @return array
	 */
	public function update_twig_environment_options( $options ) {
		return $options;
	}
}
