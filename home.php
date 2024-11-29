<?php
/**
 * 投稿ページ
 *
 * @package Jun
 */

$context = Timber::context();
$post_type_obj = get_post_type_object( get_post_type() );
$context['title'] = apply_filters( 'jun_page_title', $post_type_obj->label, array( 'post_type' => $post_type_obj ) );
$context['posts'] = Timber::get_posts();
$templates        = array( 'home.twig', 'archive.twig', 'index.twig' );
Timber::render( $templates, $context );
