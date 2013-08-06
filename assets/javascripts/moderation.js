(function(){
	document.highlight = new Highlight(document.snippetKey);
	document.moderator = new Highlight.Moderation($('#hl-container'));
})();
