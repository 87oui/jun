<?php
/**
 * The template for displaying Archive pages.
 *
 * @package Jun
 */

$templates = array( 'archive.twig', 'index.twig' );

$context = Timber::context();
$context['title'] = 'Archive';

global $post_type;

array_unshift( $templates, 'archive-post.twig' );

if ( is_day() ) {
	$context['title'] = get_the_date( 'Y年M月D日' );
	array_unshift( $templates, 'archive-' . $post_type . '-day.twig' );
} elseif ( is_month() ) {
	$context['title'] = get_the_date( 'Y年M月' );
	array_unshift( $templates, 'archive-' . $post_type . '-month.twig' );
} elseif ( is_year() ) {
	$context['title'] = get_the_date( 'Y年' );
	array_unshift( $templates, 'archive-' . $post_type . '-year.twig' );
} elseif ( is_tag() ) {
	$context['title'] = single_tag_title( '', false );
	array_unshift( $templates, 'archive-' . $post_type . '-tag.twig' );
} elseif ( is_category() ) {
	$context['title'] = single_cat_title( '', false );
	array_unshift( $templates, 'archive-' . get_query_var( 'cat' ) . '.twig' );
} elseif ( is_author() ) {
	$author = new Timber\User( $wp_query->query_vars['author'] );
	$context['author'] = $author;
	$context['title']  = $author->name() . 'の記事';
	array_unshift( $templates, 'archive-' . $author->slug . '.twig' );
} elseif ( is_post_type_archive() ) {
	$context['title'] = post_type_archive_title( '', false );
	array_unshift( $templates, 'archive-' . $post_type . '.twig' );
} elseif ( is_tax() ) {
	$context['title'] = single_term_title( '', false );
	array_unshift(
		$templates,
		'archive-' . get_taxonomy( get_query_var( 'taxonomy' ) )->object_type[0] . '.twig'
	);
}

$context['posts'] = new Timber\PostQuery();

$sidebar_config = get_stylesheet_directory() . '/sidebar-config.php';
if ( file_exists( $sidebar_config ) ) {
	include_once $sidebar_config;
	$sidebar_context = jun_get_sidebar_config( $post_type );
	$context['sidebar'] = Timber::get_sidebar( 'sidebar.twig', $sidebar_context );
}

Timber::render( $templates, $context );
