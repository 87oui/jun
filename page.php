<?php
/**
 * 固定ページ
 *
 * @package Jun
 */

namespace App;

$context = Timber::context();

$timber_post     = new Timber\Post();
$context['title'] = apply_filters( 'jun_page_title', $timber_post->post_title, array( 'post' => $timber_post ) );
$context['post'] = $timber_post;
use Timber\Timber;

$ancestors = array_map(
	function ( $ancestor ) {
		return get_post( $ancestor )->post_name;
	},
	array_reverse( get_post_ancestors( $timber_post->ID ) )
);
$page_theme = implode( '-', array( 'page', ...$ancestors, $timber_post->post_name ) ) . '.twig';
$ancestor_themes = array();
while ( ! empty( $ancestors ) ) {
	array_push( $ancestor_themes, implode( '-', array( 'page', ...$ancestors ) ) . '.twig' );
	array_pop( $ancestors );
}

Timber::render( array( $page_theme, ...$ancestor_themes, 'page.twig' ), $context );
