/******************* FREESIAEMPIRE CUSTOMIZER CUSTOM SCRIPTS ******************************/
(function($) {
	$('.preview-notice').prepend('<span id="freesiaempire_upgrade"><a target="_blank" class="button btn-upgrade" href="' + freesiaempire_upgrade_links.upgrade_link + '">' + freesiaempire_upgrade_links.upgrade_text + '</a></span>');
	jQuery('#customize-info .btn-upgrade, .misc_links').click(function(event) {
		event.stopPropagation();
	});
})(jQuery);