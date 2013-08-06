<div class="wrap">
<?php screen_icon(); ?>
<h2>Your Plugin Page Title</h2>
<form method="post" action="options.php">
<?php  settings_fields( 'snippet-account-key' ); do_settings_fields( 'snippet-account-key' ); ?>
<?php submit_button(); ?>
</form>
</div>
