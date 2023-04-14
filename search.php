<?php
/**
 * 検索ページ
 *
 * @package Jun
 */

$templates = array( 'search.twig', 'archive.twig', 'index.twig' );

$context          = Timber::context();
$context['title'] = apply_filters(
	'87oui_jun_title',
	sprintf(
		/* translators: %s: Search term. */
		esc_html( '検索結果: "%s"' ),
		esc_html( get_search_query() )
	)
);
$context['posts'] = new Timber\PostQuery();

Timber::render( $templates, $context );
