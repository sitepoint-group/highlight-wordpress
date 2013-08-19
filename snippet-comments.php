<?php
/*
Plugin Name: Snippet Comments
Plugin URI: http://TBD // TODO
Description: TODO
Version: 0.1
Author: Snippet
Author URI: http://TODO
License:
*/
define( 'SNIPPET_PATH', plugin_dir_path(__FILE__) );
define( 'SNIPPET_LIB_PATH', SNIPPET_PATH . 'lib/' );
define( 'SNIPPET_ASSET_PATH', SNIPPET_PATH . 'assets/' );
define( 'SNIPPET_ASSET_URL', plugins_url('snippet-comments') . '/assets' );
define( 'SNIPPET_API_HOST', 'https://snippet-comments.herokuapp.com' );
//define( 'SNIPPET_API_HOST', 'http://highlight.local:3001' );
define( 'SNIPPET_CLIENT_HOST', SNIPPET_API_HOST );

// Defaults: Do not touch.
define( 'SNIPPET_CONTENT_CLASS_DEFAULT', '.entry-content' );
define( 'SNIPPET_COMMENT_CLASS_DEFAULT', '.comments-area' );
define( 'SNIPPET_TITLE_CLASS_DEFAULT', '.entry-title' );
define( 'SNIPPET_POST_ID_DEFAULT', 'post-{id}' );

// Get our shit together.
require_once SNIPPET_LIB_PATH . 'snippet.php';
require_once SNIPPET_LIB_PATH . 'snippet/admin.php';
require_once SNIPPET_LIB_PATH . 'snippet/client.php';
require_once SNIPPET_LIB_PATH . 'snippet/views/settings_page.php';
require_once SNIPPET_LIB_PATH . 'snippet/views/moderation_page.php';
require_once SNIPPET_LIB_PATH . 'snippet/views/users_page.php';
require_once SNIPPET_LIB_PATH . 'snippet/views/single_post.php';
require_once SNIPPET_LIB_PATH . 'snippet/views/subscription_meta_box.php';

// Bootstrap.
$snippet = new Snippet();
add_action( 'init', Array($snippet, 'init') );
?>
