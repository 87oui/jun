<?php
/**
 * アーカイブページ
 *
 * @package Jun
 */

$templates = array( 'archive.twig', 'index.twig' );

$context = Timber::context();
$archive_title = 'アーカイブ';
$archive_args = array();

global $post_type;

array_unshift( $templates, 'archive-post.twig' );

if ( is_day() ) {
	$archive_title = get_the_date( 'Y年n月j日' );
	array_unshift( $templates, 'date.twig' );
} elseif ( is_month() ) {
	$archive_title = get_the_date( 'Y年n月' );
	array_unshift( $templates, 'date.twig' );
} elseif ( is_year() ) {
	$archive_title = get_the_date( 'Y年' );
	array_unshift( $templates, 'date.twig' );
} elseif ( is_tag() ) {
	$term_object = get_queried_object();
	$archive_title = single_tag_title( '', false );
	$archive_args['tag'] = $term_object;
	array_unshift( $templates, "tag-{$term_object->slug}.twig", 'tag.twig' );
} elseif ( is_category() ) {
	$term_object = get_queried_object();
	$archive_title = single_cat_title( '', false );
	$archive_args['category'] = $term_object;
	array_unshift( $templates, "category-{$term_object->slug}.twig", 'category.twig' );
} elseif ( is_author() ) {
	$author = new Timber\User();
	$context['author'] = $author;
	$archive_args['author'] = $author;
	$archive_title  = $author->name() . 'の記事';
	array_unshift( $templates, "author-{$author->slug}.twig", 'author.twig' );
} elseif ( is_post_type_archive() ) {
	$archive_title = post_type_archive_title( '', false );
	$archive_args['post_type'] = get_post_type_object( $post_type );
	array_unshift( $templates, 'archive-' . $post_type . '.twig' );
} elseif ( is_tax() ) {
	$term_object = get_queried_object();
	$archive_title = single_term_title( '', false );
	$archive_args['taxonomy'] = $term_object;
	array_unshift(
		$templates,
		"taxonomy-{$term_object->slug}.twig",
		'taxonomy.twig'
	);
}

$context['title'] = apply_filters( '87oui_jun_title', $archive_title, $archive_args );
$context['posts'] = new Timber\PostQuery();

$sidebar_config = get_stylesheet_directory() . '/sidebar-config.php';
if ( file_exists( $sidebar_config ) ) {
	include_once $sidebar_config;
	$sidebar_context = jun_get_sidebar_config( $post_type );
	$context['sidebar'] = Timber::get_sidebar( 'sidebar.twig', $sidebar_context );
}

Timber::render( $templates, $context );
