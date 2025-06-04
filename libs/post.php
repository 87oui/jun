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
