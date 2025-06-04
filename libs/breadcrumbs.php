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

		// 最後の項目のリンクを外す
		unset( $items[ count( $items ) - 1 ]['link'] );

		return $items;
	}
);
