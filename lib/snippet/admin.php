<?php
class Snippet_Admin{
	public function init(){
		if ( !is_admin() ) return;
		add_action( 'admin_menu', Array($this, 'add_menu') );
		add_action( 'admin_init', Array($this, 'register_settings') );
		add_action( 'admin_notices', Array($this, 'notices') );
	}

	public function add_menu(){
		// Root menu
		add_menu_page(
			'Snippet Comments Plugin Moderation',
			'Snippets',
			'publish_posts',
			'snippet',
			Array($this, 'moderation_page'),
			SNIPPET_ASSET_URL . '/images/snippets.png',
			24
		);
		// Moderation Page
		add_submenu_page(
			'snippet',
			'Snippet Comments Plugin Moderation',
			'Moderation',
			'publish_posts',
			'snippet',
			Array($this, 'moderation_page')
		);
		// Users Page
		add_submenu_page(
			'snippet',
			'Snippet Comments Plugin User Permissions',
			'Users',
			'moderate_comments',
			'snippet-users',
			Array($this, 'users_page')
		);
		// Settings Page
		add_submenu_page(
			'snippet',
			'Snippet Comments Plugin Settings',
			'Settings',
			'activate_plugins',
			'snippet-settings',
			Array($this, 'settings_page')
		);
	}

	public function register_settings(){
		register_setting('snippet-options','snippet_account_key');
		register_setting('snippet-options','snippet_post_id_format');
		register_setting('snippet-options','snippet_post_content_class');
		register_setting('snippet-options','snippet_post_title_class');
		register_setting('snippet-options','snippet_start_date');
		register_setting('snippet-options','snippet_active_period');
	}

	public function notices(){
		$base = function_exists('get_current_screen') ? get_current_screen()->parent_base : '';
		if (!get_option('snippet_account_key') && $base !='snippet-settings' && current_user_can('manage_options')) { ?>
			<div id="message" class="updated"><p><strong>Thanks for installing Snippet Comments.</strong> You need to <a href="<?PHP echo admin_url('admin.php?page=snippet-settings') ?>">set your account key</a> to continue using this plugin.</p></div>
		<?php }
		if(isset($_GET['settings-updated']) && get_option('snippet_account_key')){
			$invalid = $this->invalid_settings();
			if(count($invalid) > 0){ ?>
				<div id="message" class="updated fade"><p><strong>Invalid settings!  <?PHP echo join($invalid, ". ")?></strong></p></div>
<?php
			}else{
		?>
		<div id="message" class="updated fade"><p><strong>Great! Snippet Comments is now ready for use.</strong></p></div>
		<?php }}
	}

	public function invalid_settings(){
		$invalid = array();
		$date = get_option('snippet_start_date');
		if($date && $date != "" && !strtotime($date)){
			$invalid[] = "Start date is not valid";
		}
		return $invalid;
	}

	public function settings_page(){
		$view = new Snippet_Views_SettingsPage();
		$view->render();
	}
	public function moderation_page(){
		$view = new Snippet_Views_ModerationPage();
		$view->render();
	}
	public function users_page(){
		$view = new Snippet_Views_UsersPage();
		$view->render();
	}
}
