<?php
/**
 * 検索ページ
 *
 * @package Jun
 */

use Timber\Timber;

$templates = array( 'search.twig', 'archive.twig', 'index.twig' );

$context          = Timber::context();
$context['title'] = apply_filters(
	'jun_page_title',
	sprintf(
		/* translators: %s: Search term. */
		esc_html( '検索結果: "%s"' ),
		esc_html( get_search_query() )
	)
);
$context['posts'] = Timber::get_posts();

Timber::render( $templates, $context );
