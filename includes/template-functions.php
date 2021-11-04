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
 * ファイルの更新日をもとにバージョン番号を生成
 *
 * @param  String $path テーマディレクトリからの相対パス
 * @return String         バージョン番号
 */
function get_version( $path ) {
	if ( ! WP_DEBUG ) {
		return false;
	}

	$path_absolute = get_theme_file_path( $path );
	if ( file_exists( $path_absolute ) ) {
		return date_i18n( 'YmdHi', filemtime( $path_absolute ) );
	} else {
		return false;
	}
}

/**
 * 静的ファイルのパスを取得してバージョン番号も付与
 *
 * @param  String $path テーマディレクトリからの相対パス
 * @return String         ファイルパス
 */
function get_static_file_path( $path ) {
	$version = get_version( $path );
	$version = $version ? '?ver=' . $version : '';

	return path_join( get_stylesheet_directory_uri(), $path ) . $version;
}

/**
 * 画像ファイルパスを取得
 *
 * @param String $path 画像ディレクトリからの相対パス
 *
 * @return String         ファイルパス
 */
function get_image_path( $path ) {
	return get_static_file_path( path_join( 'assets/images', $path ) );
}
