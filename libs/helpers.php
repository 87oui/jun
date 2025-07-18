<?php
/**
 * ヘルパー関数
 *
 * @package Jun
 */

if ( ! function_exists( 'dump' ) ) {
	/**
	 * var_dumpラッパー
	 *
	 * @param   mixed ...$contents  ダンプする内容
	 *
	 * @return  void
	 */
	function dump( ...$contents ) {
		// ローカル環境のみ
		$env = wp_get_environment_type();
		if ( WP_DEBUG ) {
			foreach ( $contents as $content ) {
				if ( is_string( $content ) ) {
					$content = htmlspecialchars( $content );
				}
				echo '<pre>';
				var_dump( $content );
				echo '</pre>';
			}
		}
	}
}

if ( ! function_exists( 'get_static_file_path' ) ) {
	/**
	 * ファイルをパラメータ付きで呼び出し
	 *
	 * @param   String $path  assetsより下のパス
	 *
	 * @return  String        絶対パスのURL
	 */
	function get_static_file_path( $path ) {
		if ( path_is_absolute( $path ) ) {
			$path = preg_replace( '/^\//', '', $path );
		}

		if ( ! WP_DEBUG ) {
			$absolute_path = get_theme_file_path( path_join( 'assets', $path ) );
			if ( file_exists( $absolute_path ) ) {
				$path = $path . '?v=' . gmdate( 'YmdHi', filemtime( $absolute_path ) );
			}
		}

		return path_join( get_stylesheet_directory_uri() . '/assets', $path );
	}
}

if ( ! function_exists( 'get_image_path' ) ) {
	/**
	 * 画像ファイルパスを取得
	 *
	 * @param  String $path 画像ディレクトリからの相対パス
	 *
	 * @return String       ファイルパス
	 */
	function get_image_path( $path ) {
		return get_static_file_path( path_join( 'images', $path ) );
	}
}
