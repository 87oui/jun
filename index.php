<?php
/**
 * インデックスページ
 *
 * @package Jun
 */

namespace App;

use Timber\Timber;

$context          = Timber::context();
$context['posts'] = Timber::get_posts();
$templates        = array( 'index.twig' );

Timber::render( $templates, $context );
