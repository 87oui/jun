<?php
/**
 * 管理画面の設定
 *
 * @package Jun
 */

if ( ! function_exists( 'jun_admin_init' ) ) {
	/**
	 * 管理画面初期化時の処理
	 *
	 * @return void
	 */
	function jun_admin_init() {
		// 管理者権限のないユーザにアップデートのお知らせを非表示
		if ( ! current_user_can( 'administrator' ) ) {
			remove_action( 'admin_notices', 'update_nag', 3 );
		}
	}
}
add_action( 'admin_init', 'jun_admin_init' );

if ( ! function_exists( 'jun_remove_admin_bar_menus' ) ) {
	/**
	 * 管理バーを変更
	 *
	 * @param object $wp_admin_bar 管理バー
	 *
	 * @return void
	 */
	function jun_remove_admin_bar_menus( $wp_admin_bar ) {
		if ( ! current_user_can( 'administrator' ) ) {
			$wp_admin_bar->remove_menu( 'wp-logo' ); // WordPressロゴ
			$wp_admin_bar->remove_menu( 'about' ); // WordPressロゴ / WordPressについて
			$wp_admin_bar->remove_menu( 'wporg' ); // WordPressロゴ / WordPress.org
			$wp_admin_bar->remove_menu( 'documentation' ); // WordPressロゴ / ドキュメンテーション
			$wp_admin_bar->remove_menu( 'support-forums' ); // WordPressロゴ / サポート
			$wp_admin_bar->remove_menu( 'feedback' ); // WordPressロゴ / フィードバック

			$wp_admin_bar->remove_menu( 'updates' ); // 更新

			$wp_admin_bar->remove_menu( 'comments' ); // コメント

			$wp_admin_bar->remove_menu( 'new-page' ); // 新規投稿 / 固定
		}
	}
}
add_action( 'admin_bar_menu', 'jun_remove_admin_bar_menus', 999 );

if ( ! function_exists( 'jun_skip_dashboard' ) ) {
	/**
	 * 管理者ユーザ以外はダッシュボードを飛ばして投稿一覧にリダイレクト
	 *
	 * @return void
	 */
	function jun_skip_dashboard() {
		if ( ! current_user_can( 'administrator' ) ) {
			wp_redirect( get_bloginfo( 'wpurl' ) . '/wp-admin/edit.php' );
			exit();
		}
	}
}
add_action( 'wp_login', 'jun_skip_dashboard', 10, 2 );

if ( ! function_exists( 'jun_admin_head_modify' ) ) {
	/**
	 * 管理画面ヘルプを非表示
	 *
	 * @return void
	 */
	function jun_admin_head_modify() {
		if ( ! current_user_can( 'administrator' ) ) {
			echo '<style>#screen-meta-links .screen-meta-toggle{display:none;}</style>';
		}
	}
}
add_action( 'admin_head', 'jun_admin_head_modify' );
