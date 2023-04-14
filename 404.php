<?php
/**
 * Not Foundページ
 *
 * @package Jun
 */

$context = Timber::context();
$context['title'] = apply_filters( '87oui_jun_title', 'ページが見つかりませんでした' );
Timber::render( '404.twig', $context );
