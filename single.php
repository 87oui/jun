<?php
/**
 * 投稿
 *
 * @package Jun
 */

namespace App;

use Timber\Timber;

$context = Timber::context();
$post_content = $context['post'];
$post_type_obj = get_post_type_object( get_post_type() );
$context['title'] = apply_filters( 'jun_page_title', $post_type_obj->label, array( 'post' => $post_content ) );

if ( post_password_required( $post_content->ID ) ) {
	$templates = 'single-password.twig';
} else {
	$templates = array(
		'single-' . $post_content->slug . '.twig',
		'single-' . $post_content->post_type . '.twig',
		'single.twig',
	);
}

Timber::render(
	$templates,
	$context
);
