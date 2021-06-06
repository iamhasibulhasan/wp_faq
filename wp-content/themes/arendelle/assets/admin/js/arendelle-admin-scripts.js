(function ($) {
	'use strict';

	var pluginsBadge = $('.plugin-item-content-title h3 + span');
	var premiumPlugin = pluginsBadge.parents('.plugin-item');

	var recommended = $('.ocdi-recommended-star');
	var notice = recommended.parents('.ocdi-content-notice');

	premiumPlugin.hide();
	notice.hide();

})(jQuery);