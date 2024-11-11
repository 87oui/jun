<?php
/**
 * Not Foundページ
 *
 * @package Jun
 */

namespace App;

use Timber\Timber;

$context = Timber::context();
$context['title'] = apply_filters( 'jun_page_title', 'ページが見つかりませんでした' );
Timber::render( '404.twig', $context );
