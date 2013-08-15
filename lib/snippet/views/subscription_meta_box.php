<?php

class Snippet_Views_SubscriptionMetaBox extends Snippet_Views_SinglePost{
	public function render(){
		wp_enqueue_script( 'snippet-client' );
		wp_enqueue_style( 'snippet-client' );
		echo "<div id='hl-notifications-container'></div>";
		if(in_array($this->post()->post_status, array('draft', 'published', 'future', 'pending'))){
			add_filter( 'admin_print_footer_scripts', Array($this, 'subscription_script') );
		}else{
			add_filter( 'admin_print_footer_scripts', Array($this, 'message_script') );
		}
	}

	public function subscription_script(){ ?>
<script type="text/javascript">
	$link = $('<a href="#" />').text('Change notification settings');
	$('#hl-notifications-container').append($link);
	$link.on('click', function(e){
		e.preventDefault()
		$overlay = $('<div style="background-color: RGBA(0,0,0,0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 88;" />');
		$iframe = $('<iframe src="<?php echo get_permalink(); ?>#hl:s" style="width:60%; height: 60%; margin-top: 15%; margin-left: 20%; position: fixed; z-index: 89; left: 0; top: 0;" />');

		$overlay.on('click', function(e){
			$iframe.remove();
			$overlay.remove();
		});
		$('body').append($overlay).append($iframe);
	});
</script>
<?php
	}

	public function message_script(){ ?>
<script type="text/javascript">
	$('#hl-notifications-container').text('Please save your article first.');
</script>
<?php
	}

	public function scripts(){
		wp_enqueue_script( 'snippet-messaging' );
		wp_enqueue_script( 'snippet-fancybox' );
		wp_enqueue_script( 'snippet-admin' );
		wp_enqueue_style( 'snippet-fancybox' );
	}
}

