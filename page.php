<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * To generate specific templates for your pages you can use:
 * /mytheme/templates/page-mypage.twig
 * (which will still route through this PHP file)
 * OR
 * /mytheme/page-mypage.php
 * (in which case you'll want to duplicate this file and save to the above path)
 *
 * @package Jun
 */

$context = Timber::context();

$timber_post     = new Timber\Post();
$context['post'] = $timber_post;

$ancestors = array_map(
	function( $ancestor ) {
		return get_post( $ancestor )->post_name;
	},
	array_reverse( get_post_ancestors( $timber_post->ID ) )
);
$ancestor_themes = array();
while ( ! empty( $ancestors ) ) {
	array_push( $ancestor_themes, implode( '-', array( 'page', ...$ancestors ) ) . '.twig' );
	array_pop( $ancestors );
}

Timber::render(
	array(
		implode( '-', array( 'page', ...$ancestors, $timber_post->post_name ) ) . '.twig',
		...$ancestor_themes,
		'page.twig',
	),
	$context
);
