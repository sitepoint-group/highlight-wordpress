(function() {
  var _this = this, $ = jQuery;

  this.SnippetAdmin = (function() {

    function SnippetAdmin() {
      var _this = this;
      this.didSelectAccount = function(account) {
        return SnippetAdmin.prototype.didSelectAccount.apply(_this, arguments);
      };
      this.bindMessaging();
	  this.setupForm();
	  this.bindSettings();
    }

    SnippetAdmin.prototype.bindMessaging = function() {
	  Highlight.Message.receive(this.didSelectAccount, '*');
    };

	SnippetAdmin.prototype.bindSettings = function() {
		var $table = $('.advanced-settings'), link = $('.hl-toggle');
		$table.toggle();
		link.click(function(e){
			e.preventDefault();
			$table.toggle();
			link.text($table.is(':visible') ? 'hide' : 'show');
		});
	};

	SnippetAdmin.prototype.setupForm = function(){
		var _this = this;
		if(this.welcome().size() > 0){
			this.form().hide();
		}
		$('.snippet-welcome-toggle').on('click', function(e){
			e.preventDefault()
			_this.form().show();
			_this.welcome().hide();
		});
	}

    SnippetAdmin.prototype.didSelectAccount = function(e, type, data) {
	  if(type != "accountSelected") return;
	  $('#snippet-account-key').val(data);
	  $('.fancybox-close').click()
	  this.form().show();
	  this.welcome().hide();
	};
	SnippetAdmin.prototype.welcome = function() {
      return this._welcome || (this._welcome = $('#snippet-welcome'));
    };
	SnippetAdmin.prototype.form = function() {
      return this._form || (this._form = $('#snippet-form'));
    };
    return SnippetAdmin;

  })();
  $('.fancybox').fancybox({type: 'iframe', width: 320, height: 400});
  this.SnippetAdmin = new SnippetAdmin();

}).call(this);
