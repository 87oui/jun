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

		// 投稿ポストタイプにスラッグが設定されている場合、パンくずリストにアーカイブページを挿入
		if ( defined( 'POST_TYPE_DEFAULT_LABEL' )
			&& ( is_post_type_archive( 'post' ) || is_singular( 'post' ) )
		) {
			array_splice(
				$items,
				1,
				0,
				array(
					array(
						'title' => POST_TYPE_DEFAULT_LABEL,
						'link' => get_post_type_archive_link( 'post' ),
					),
				)
			);
		}

		// 最後の項目のリンクを外す
		unset( $items[ count( $items ) - 1 ]['link'] );

		return $items;
	}
);
