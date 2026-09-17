<?php
/**
 * セキュリティ設定
 *
 * @package Jun
 */

// WordPressのバージョン情報を削除
remove_action( 'wp_head', 'wp_generator' );

// ログインユーザー以外には著者アーカイブを無効化
add_action(
	'template_redirect',
	function () {
		$jun_disable_author_archive = apply_filters( 'jun_disable_author_archive', true );
		if ( $jun_disable_author_archive && is_author() && ! is_user_logged_in() ) {
			wp_safe_redirect( home_url(), 301 );
			exit;
		}
	}
);

// ログインユーザー以外にはREST APIを無効化
add_filter(
	'rest_authentication_errors',
	function ( $result ) {
		// すでに認証チェックが適用されている場合はそのまま返す
		if ( $result === true || is_wp_error( $result ) ) {
			return $result;
		}

		// ログイン済みユーザーには許可
		if ( is_user_logged_in() ) {
			return $result;
		}

		// 許可するルート
		$allowed_routes = apply_filters( 'jun_allowed_rest_routes', array() );
		if ( ! empty( $allowed_routes ) ) {
			global $wp;
			$rest_route = $wp->query_vars['rest_route'] ?? '';
			foreach ( $allowed_routes as $route ) {
				if ( strpos( $rest_route, $route ) === 0 ) {
					return $result;
				}
			}
		}

		// 無効化設定が有効な場合はそのまま返す
		if ( apply_filters( 'jun_disable_rest_api', true ) ) {
			return $result;
		}

		return new WP_Error(
			'rest_not_logged_in',
			__( 'You are not currently logged in.', 'text-domain' ),
			array( 'status' => 401 )
		);
	}
);
