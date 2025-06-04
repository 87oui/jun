<?php
/**
 * テーマ用関数、定数
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Jun
 */

namespace App;

use Timber\Timber;

require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/libs/StarterSite.php';
require_once __DIR__ . '/libs/admin-init.php';
require_once __DIR__ . '/libs/breadcrumbs.php';
require_once __DIR__ . '/libs/foundation.php';
require_once __DIR__ . '/libs/helpers.php';
require_once __DIR__ . '/libs/seo.php';

Timber::init();

new StarterSite();
