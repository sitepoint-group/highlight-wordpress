<?php
class Snippet {
	public function __construct(){
		$this->_admin = new Snippet_Admin();
		$this->_client = new Snippet_Client();
	}

	public function init(){
		$this->register_assets();
		$this->_admin->init();
		add_action( 'wp', Array($this->_client, 'init') );
	}

	protected function register_assets(){
		wp_register_script( 'snippet-fancybox',
		   	SNIPPET_ASSET_URL . '/javascripts/jquery.fancybox.js', array(), false, true );

		wp_register_script( 'snippet-messaging',
		   	SNIPPET_CLIENT_HOST . '/assets/highlight_messaging.js', array(), null, true );

		wp_register_script( 'snippet-admin',
		   	SNIPPET_ASSET_URL . '/javascripts/admin.js', array(), false, true );

		wp_register_script( 'snippet-moderation',
		   	SNIPPET_ASSET_URL . '/javascripts/moderation.js', array(), false, true );

		wp_register_script( 'snippet-moderation-widget',
		   	SNIPPET_CLIENT_HOST . '/assets/highlight_moderation.js', array(), null, true );

		wp_register_script( 'snippet-user-management',
		   	SNIPPET_ASSET_URL . '/javascripts/user_management.js', array(), false, true );

		wp_register_script( 'snippet-user-management-widget',
		   	SNIPPET_CLIENT_HOST . '/assets/highlight_user_management.js', array(), null, true );

		wp_register_script( 'snippet-client',
		   	SNIPPET_CLIENT_HOST . '/assets/highlight.js', array(), null, true );

		wp_register_style( 'snippet-fancybox',
		   	SNIPPET_ASSET_URL . '/stylesheets/fancybox.css' );

		wp_register_style( 'snippet-client',
		   	SNIPPET_CLIENT_HOST . '/assets/highlight.css', array(), null );
	}
}

