/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.uiColor = '#AADC6E';
	config.language = 'vi';
	config.extraPlugins = 'youtube,widget,widgetbootstrap,blockquote,glyphicons,emojione,btbutton,lineutils';

	config.youtube_width = '500';
	config.youtube_height = '480';
	config.youtube_related = true;
	config.youtube_older = false;
	config.youtube_privacy = false;

	config.allowedContent = true;
	config.bootstrapTab_managePopupContent = true;
	config.mj_variables_allow_html = false;
	config.image_removeLinkByEmptyURL = false;
};
