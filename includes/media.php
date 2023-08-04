<?php
/**
 * アップロード画像まわりの設定
 *
 * @package Jun
 */

// アイキャッチ画像を有効化
add_theme_support( 'post-thumbnails' );

/**
 * Instagramから投稿を取得する
 *
 * @param string  $userid ビジネスアカウントID
 * @param string  $token  アクセストークン
 * @param integer $count  取得件数
 *
 * @return object         APIで取得したデータ
 */
function get_instagram_photos( $userid, $token, $count = 10 ) {
	 // アカウントかトークンがなければfalseを返す
	if ( ! $userid || ! $token ) {
		return false;
	}

	// phpcs:ignore Generic.Files.LineLength
	$url = "https://graph.facebook.com/v10.0/{$userid}?fields=name%2Cmedia.limit({$count})%7Bcaption%2Cmedia_url%2Cthumbnail_url%2Cpermalink%7D&access_token={$token}";
	$ch = curl_init();
	curl_setopt( $ch, CURLOPT_URL, $url );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	$result = curl_exec( $ch );
	curl_close( $ch );

	$result = json_decode( $result );
	if ( ! isset( $result->error ) ) {
		return $result->media->data;
	} else {
		return false;
	}
}
