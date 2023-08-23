<?php
/**
 * テーマ用関数
 *
 * @package Jun
 */

/**
 * var_dump wrapper
 *
 * @param  String $content dumpしたい内容
 * @return void
 */
function v6p( $content ) {
	if ( is_string( $content ) ) {
		$content = htmlspecialchars( $content );
	}

	echo '<pre><code>';
	var_dump( $content );
	echo '</code></pre>';
}

/**
 * ファイルをパラメータ付きで呼び出し
 *
 * @param   String $path  assetsより下のパス
 *
 * @return  String        絶対パスのURL
 */
function get_static_file_path( $path ) {
	if ( ! WP_DEBUG ) {
		$manifest_path = path_join(
			get_stylesheet_directory(),
			apply_filters( 'jun_assets_manifest_path', 'assets/mix-manifest.json' )
		);
		$manifest = file_exists( $manifest_path )
			? json_decode( file_get_contents( $manifest_path ), true )
			: array();
		$manifest_index = apply_filters( 'jun_assets_manifest_index_prefix', '/' ) . $path;
		if ( ! empty( $manifest ) && isset( $manifest[ $manifest_index ] ) ) {
			$path = $manifest[ $manifest_index ];
		} else {
			$absolute_path = get_theme_file_path( path_join( 'assets', $path ) );
			if ( file_exists( $absolute_path ) ) {
				$path = $path . '?' . gmdate( 'YmdHi', filemtime( $absolute_path ) );
			}
		}
	}

	if ( path_is_absolute( $path ) ) {
		$path = preg_replace( '/^\//', '', $path );
	}

	return path_join( get_stylesheet_directory_uri() . '/assets', $path );
}

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
