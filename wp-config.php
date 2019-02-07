<?php

define('DISALLOW_FILE_EDIT', true);

define('DB_NAME', 'bitnami_wordpress');
define('DB_USER', 'bn_wordpress');
define('DB_PASSWORD', '45bee7e8ac');
define('DB_HOST', 'localhost:3306');

define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

define('AUTH_KEY', 'e9fadcb21495901bc9cb3038ecaee7be15c32ada74a0fa0eebbd21c28576f943');
define('SECURE_AUTH_KEY', 'f8ad15dc766695876eaab16acd27a2f63f1dc905e87501954a71d2b23f622b30');
define('LOGGED_IN_KEY', 'da892fffc97926cf1c5fa86a04d4ccbc4944609d3bab3f3a99ecf2dc48af8a89');
define('NONCE_KEY', '28f046fdd3750cb0b6e868d846f03703c15f7141eabd354564eeb26f4c5619b3');
define('AUTH_SALT', 'beb9c99c3356898bc22f8c31110075c0b00473a811a9fad0b894ff8765ab1309');
define('SECURE_AUTH_SALT', '44a473b456bef0963e84a9fafffc49135a050a34d3d7975d927e55ca995d13ba');
define('LOGGED_IN_SALT', '62db03b6da0a7ffc014935c2df6072e79a52981e590cdff90a47d0b4ed544c60');
define('NONCE_SALT', 'd62e802c2b0f91f7049d47305fc1c9f29fc095ad562e7545300c673c86c5b67b');

$table_prefix  = 'wp_';

define('WP_DEBUG', false);

define('FS_METHOD', 'direct');

define('AUTOSAVE_INTERVAL', 300);
define('WP_POST_REVISIONS', false);

if(defined( 'WP_CLI')) {
    $_SERVER['HTTP_HOST'] = 'localhost';
}

define('WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/');
define('WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/');

if(!defined('ABSPATH')) {
	define('ABSPATH', dirname(__FILE__) . '/');
}

require_once(ABSPATH . 'wp-settings.php');

define('WP_TEMP_DIR', '/opt/bitnami/apps/wordpress/tmp');

if(!defined('WP_CLI')) {
    add_filter('wp_headers', function($headers) {
        unset($headers['X-Pingback']);
        return $headers;
    });
    add_filter( 'xmlrpc_methods', function( $methods ) {
            unset( $methods['pingback.ping'] );
            return $methods;
    });
    add_filter( 'auto_update_translation', '__return_false' );
}
