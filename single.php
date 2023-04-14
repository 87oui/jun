<?php
/**
 * 投稿
 *
 * @package Jun
 */

$context = Timber::context();
$timber_post = Timber::query_post();
$post_type_obj = get_post_type_object( get_post_type() );
$context['title'] = apply_filters( '87oui_jun_title', $post_type_obj->label, array( 'post' => $timber_post ) );
$context['post'] = $timber_post;

$sidebar_config = get_stylesheet_directory() . '/sidebar-config.php';
if ( file_exists( $sidebar_config ) ) {
	include_once $sidebar_config;
	$sidebar_context = jun_get_sidebar_config();
	$context['sidebar'] = Timber::get_sidebar( 'sidebar.twig', $sidebar_context );
}

Timber::render(
	array(
		'single-' . $timber_post->slug . '.twig',
		'single-' . $timber_post->post_type . '.twig',
		'single.twig',
	),
	$context
);
