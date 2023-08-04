<?php
/**
 * 投稿まわりの設定
 *
 * @package Jun
 */

if ( ! function_exists( 'jun_excerpt_length' ) ) {
	/**
	 * 抜粋の文字数を変更する
	 *
	 * @return Integer         変更された文字数
	 */
	function jun_excerpt_length() {
		return 110;
	}
}
add_filter( 'excerpt_length', 'jun_excerpt_length', 999 );

if ( ! function_exists( 'jun_excerpt_more' ) ) {
	/**
	 * 抜粋の省略文字を変更する
	 *
	 * @return String       変更された省略文字
	 */
	function jun_excerpt_more() {
		return '...';
	}
}
add_filter( 'excerpt_more', 'jun_excerpt_more' );

// 投稿のアーカイブページを設定
if ( defined( 'POST_TYPE_DEFAULT_SLUG' ) && defined( 'POST_TYPE_DEFAULT_LABEL' ) ) {
	add_filter(
		'register_post_type_args',
		function ( $args, $post_type ) {
			if ( 'post' === $post_type ) {
				global $wp_rewrite;
				$archive_slug = POST_TYPE_DEFAULT_SLUG;
				$args['label'] = POST_TYPE_DEFAULT_LABEL;
				$args['has_archive'] = $archive_slug;
				$archive_slug = $wp_rewrite->root . $archive_slug;
				$feeds = '(' . trim( implode( '|', $wp_rewrite->feeds ) ) . ')';
				add_rewrite_rule( "{$archive_slug}/?$", "index.php?post_type={$post_type}", 'top' );
				add_rewrite_rule(
					"{$archive_slug}/feed/{$feeds}/?$",
					"index.php?post_type={$post_type}" . '&feed=$matches[1]',
					'top'
				);
				add_rewrite_rule(
					"{$archive_slug}/{$feeds}/?$",
					"index.php?post_type={$post_type}" . '&feed=$matches[1]',
					'top'
				);
				add_rewrite_rule(
					"{$archive_slug}/{$wp_rewrite->pagination_base}/([0-9]{1,})/?$",
					"index.php?post_type={$post_type}" . '&paged=$matches[1]',
					'top'
				);
			}
			return $args;
		},
		10,
		2
	);
	add_filter(
		'post_type_archive_link',
		function ( $link, $post_type ) {
			if ( 'post' === $post_type ) {
				return home_url( '/' . POST_TYPE_DEFAULT_SLUG . '/' );
			}
			return $link;
		},
		10,
		2
	);
}
