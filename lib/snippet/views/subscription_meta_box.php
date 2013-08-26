<?php

class Snippet_Views_SubscriptionMetaBox extends Snippet_Views_SinglePost{
	public function render(){
		echo "<div id='hl-notifications-container'></div>";
		if(in_array($this->post()->post_status, array('draft', 'publish', 'future', 'pending'))){
			add_filter( 'admin_print_footer_scripts', Array($this, 'subscription_script') );
			wp_enqueue_script( 'snippet-client' );
			wp_enqueue_script( 'snippet-user-management-widget' );
		}else{
			add_filter( 'admin_print_footer_scripts', Array($this, 'message_script') );
		}
	}

	public function subscription_script(){ ?>
<script type="text/javascript">
	$link = jQuery('<a href="#" />').text('Manage Notifications');
	jQuery('#hl-notifications-container').append($link);
	authentication = Highlight.Authentication.instance();
	authentication.accountKey = "<?php echo get_option('snippet_account_key'); ?>";
	$link.on('click', function(e){
		var article = new Highlight.Article('<?php echo $this->post_id() ?>'),
			properties = <?php echo json_encode($this->article_properties()); ?>;
		jQuery.each(properties, function(k,v){
			article[k] = v;
		});
		document.manager = new Highlight.SubscriptionManagement(article, jQuery('#hl-notifications-container'));
	});
</script>
<?php
	}

	public function message_script(){ ?>
<script type="text/javascript">
	jQuery('#hl-notifications-container').text('Please save your article first');
</script>
<?php
	}
	protected function article_properties(){
		return array(
			'url' => get_permalink(),
			'title' => $this->post()->post_title,
			'text' => $this->post()->post_content
		);
	}
	public function js_escape($str){
		return str_replace('\'', '\\\'', $str);
	}
}

