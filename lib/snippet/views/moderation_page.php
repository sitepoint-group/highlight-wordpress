<?php

class Snippet_Views_ModerationPage{
	public function render(){
		screen_icon(); ?>
		<h2>Snippet Comments Moderation</h2>
		<div class="wrap" id="hl-container">
		</div>
		<script type="text/javascript">
			document.snippetKey ="<?php echo get_option('snippet_account_key') ?>";
		</script>
		<?php
		$this->scripts();
	}

	protected function scripts(){
		wp_enqueue_script( 'snippet-messaging' );
		wp_enqueue_script( 'snippet-client' );
		wp_enqueue_script( 'snippet-moderation-widget' );
		wp_enqueue_script( 'snippet-moderation' );
	}
}
