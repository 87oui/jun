<?php
/**
 * 投稿ページ
 *
 * @package Jun
 */

$context = Timber::context();
$post_type_obj = get_post_type_object( get_post_type() );
$context['title'] = apply_filters( 'jun_page_title', $post_type_obj->label, array( 'post_type' => $post_type_obj ) );
$context['posts'] = new Timber\PostQuery();
$sidebar_config = get_stylesheet_directory() . '/sidebar-config.php';
if ( file_exists( $sidebar_config ) ) {
	include_once $sidebar_config;
	$sidebar_context = jun_get_sidebar_config( $post_type );
	$context['sidebar'] = Timber::get_sidebar( 'sidebar.twig', $sidebar_context );
}
$templates        = array( 'home.twig', 'archive.twig', 'index.twig' );
Timber::render( $templates, $context );
