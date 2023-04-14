<?php
/**
 * ホームページ
 *
 * @package Jun
 */

$context = Timber::context();
$context['title'] = apply_filters( '87oui_jun_title', '' );
$context['posts'] = new Timber\PostQuery();
$templates = array( 'front-page.twig', 'index.twig' );
Timber::render( $templates, $context );
