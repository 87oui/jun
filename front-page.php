<?php
/**
 * ホームページ
 *
 * @package Jun
 */

$context = Timber::context();
$context['title'] = apply_filters( 'jun_page_title', '' );
$context['posts'] = new Timber\PostQuery();
$templates = array( 'front-page.twig', 'index.twig' );
Timber::render( $templates, $context );
