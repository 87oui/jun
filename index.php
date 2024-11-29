<?php
/**
 * インデックスページ
 *
 * @package Jun
 */

$context          = Timber::context();
$context['posts'] = Timber::get_posts();
$templates        = array( 'index.twig' );
use Timber\Timber;

Timber::render( $templates, $context );
