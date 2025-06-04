<?php
/**
 * 管理画面の設定
 *
 * @package Jun
 */

add_action(
	'admin_init',
	function () {
		// 管理者権限のないユーザにアップデートのお知らせを非表示
		if ( ! current_user_can( 'administrator' ) ) {
			remove_action( 'admin_notices', 'update_nag', 3 );
		}
	}
);

add_action(
	'admin_bar_menu',
	function ( $wp_admin_bar ) {
		// 不要な項目を除去
		$menu_to_remove = apply_filters(
			'jun_remove_admin_bar_menus',
			array(
				'wp-logo',
				'customize',
				'updates',
				'comments',
			)
		);
		foreach ( $menu_to_remove as $menu ) {
			$wp_admin_bar->remove_menu( $menu );
		}

		// サイトタイトルに環境名を追加
		$env = wp_get_environment_type();
		switch ( $env ) {
			case 'production':
				$env_label = '本番環境';
				break;
			case 'staging':
				$env_label = 'ステージング・テスト環境';
				break;
			case 'development':
				break;

			default:
				$env_label = $env;
				break;
		}
		$wp_admin_bar->add_node(
			array(
				'id' => 'site-name',
				'title' => get_option( 'blogname' ) . ' - ' . $env,
			)
		);
	},
	999
);

add_action(
	'wp_login',
	function () {
		// 管理者ユーザ以外はダッシュボードを飛ばして投稿一覧にリダイレクト
		if ( ! current_user_can( 'administrator' ) ) {
			$to = apply_filters( 'jun_skip_dashboard', get_bloginfo( 'wpurl' ) . '/wp-admin/edit.php' );
			if ( ! empty( $to ) ) {
				wp_redirect( $to );
			}
			exit();
		}
	},
	10,
	2
);

add_action(
	'admin_head',
	function () {
		// 管理画面ヘルプを非表示
		if ( ! current_user_can( 'administrator' ) ) {
			echo '<style>#screen-meta-links .screen-meta-toggle{display:none;}</style>';
		}
	}
);
