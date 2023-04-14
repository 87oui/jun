<?php
/**
 * インデックスページ
 *
 * @package Jun
 */

$context          = Timber::context();
$context['posts'] = new Timber\PostQuery();
$templates        = array( 'index.twig' );
Timber::render( $templates, $context );
