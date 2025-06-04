<?php
/**
 * パンくずリストの設定
 *
 * @package Jun
 */

add_filter(
	'inc2734_wp_breadcrumbs',
	function ( $items ) {
		if ( empty( $items ) ) {
			return $items;
		}

		// トップページなら空の配列を返す
		if ( is_front_page() ) {
			return array();
		}

		$items = apply_filters('jun_breadcrumbs', $items );

		return $items;
	}
);