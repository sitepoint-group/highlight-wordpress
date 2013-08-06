<?php

class Snippet_Views_SettingsPage{
	public function render(){
		?>
		<div class="wrap">
			<?php screen_icon(); ?>
			<h2>Snippet Comments Settings</h2>
			<?php if(!get_option('snippet_account_key')){ ?>
				<div id="snippet-welcome">
				<h3>Thank you for choosing to install Snippet Comments!</h3>
				<p>To get started, we need you to sign up for a free account key. We use the account key to group comments across your site.</p>
				<p><a href="<?php echo SNIPPET_API_HOST ?>/account_selector" class="button button-hero button-primary fancybox">Get your Account Key</a></p>
				<p class="description">Already have a key? <a href="" class="snippet-welcome-toggle">Enter it here</a></p>
				</div>
			<?php } ?>
			<form method="post" id="snippet-form" action="options.php">
				<?php settings_fields( 'snippet-options' ); ?>
				<h3>Required Settings</h3>
				<table class="form-table">
					<tr valign="top">
					<th scope="row">Account Key</th>
					<td>
						<input type="text" name="snippet_account_key" id="snippet-account-key" value="<?php echo get_option('snippet_account_key'); ?>" /><a href="<?php echo SNIPPET_API_HOST ?>/account_selector" class="button button-primary fancybox">Change Account Key</a>
						<?php if(get_option('snippet_account_key')){ ?>
						<p class="description">Note: Changing your account key means comments from the current account will no longer be shown.</p>
						<?php } ?>
					</td>
					</tr>
				</table>
				<h3>Advanced Settings</h3>
				<table class="form-table">
					<tr><th scope="row">Post ID Format</th>
					<td>
						<input type="text" name="snippet_post_id_format" value="<?php echo get_option('snippet_post_id_format', SNIPPET_POST_ID_DEFAULT); ?>" />
						<p class="description">If your theme differs from the standard format, please update this value. '{id}' will be replaced with the posts ID. The default is "<?PHP echo SNIPPET_POST_ID_DEFAULT ?>".</p>
					</td>
					<tr><th scope="row">Post content class</th>
					<td>
						<input type="text" name="snippet_post_content_class" value="<?php echo get_option('snippet_post_content_class', SNIPPET_CONTENT_CLASS_DEFAULT); ?>" />
						<p class="description">If your theme differs from the standard format, please update this value. The default is "<?PHP echo SNIPPET_CONTENT_CLASS_DEFAULT ?>".</p>
					</td>
					<tr><th scope="row">Post title class</th>
					<td>
						<input type="text" name="snippet_post_title_class" value="<?php echo get_option('snippet_post_title_class', SNIPPET_TITLE_CLASS_DEFAULT); ?>" />
						<p class="description">If your theme differs from the standard format, please update this value. The default is "<?PHP echo SNIPPET_TITLE_CLASS_DEFAULT ?>".</p>
					</td>
				</table>
			<?php submit_button(); ?>
			</form>
		</div>
		<?php
		$this->scripts();
	}

	public function scripts(){
		wp_enqueue_script( 'snippet-messaging' );
		wp_enqueue_script( 'snippet-fancybox' );
		wp_enqueue_script( 'snippet-admin' );
		wp_enqueue_style( 'snippet-fancybox' );
	}
}
