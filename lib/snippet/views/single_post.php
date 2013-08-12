<?php

class Snippet_Views_SinglePost{
	public function init(){
		if( !$this->active_for_post() ){
			return;
		}
		if( is_singular() ){
			wp_enqueue_script( 'snippet-client' );
			wp_enqueue_style( 'snippet-client' );
			add_filter( 'wp_head', Array($this, 'inject_account_key') );
			add_filter( 'wp_footer', Array($this, 'snippet_setup_script'), 30 );
		}
	}

	public function active_for_post(){
		$start_time = strtotime(get_option('snippet_start_date'));
		if( !$start_time ){
			// Start date option is not valid, display
			return true;
		}
		if( $start_time < strtotime(get_the_date())){
			return true;
		}else{
			return false;
		}
	}

	public function inject_account_key(){
		if( get_option('account_key') ){ ?>
			<meta title="snippet-account-key" value="<?php echo get_option('snippet_account_key') ?>" />
		<?php }
	}

	public function snippet_setup_script(){ ?>
		<script type="text/javascript">
		var snippet = new Highlight("<?php echo get_option('snippet_account_key') ?>", "<?php echo $this->post_id() ?>", { contentSelector: ".<?php echo get_option('snippet_post_content_class', SNIPPET_CONTENT_CLASS_DEFAULT) ?>", titleSelector: ".<?php echo get_option('snippet_post_title_class', SNIPPET_TITLE_CLASS_DEFAULT) ?>"});
		snippet.start();
		</script>
	<?php }

	protected function post_id(){
		return str_replace(
			"{id}", get_the_ID(), get_option('post_id_format', SNIPPET_POST_ID_DEFAULT)
		);
	}
}
