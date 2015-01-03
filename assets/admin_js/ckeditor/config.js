/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.filebrowserBrowseUrl = '/assets/admin_js/ckfinder/ckfinder.html';
	config.filebrowserImageBrowseUrl = '/assets/admin_js/ckfinder/ckfinder.html?Type=Images';
	config.filebrowserFlashBrowseUrl = '/assets/admin_js/ckfinder/ckfinder.html?Type=Flash';
	config.filebrowserUploadUrl = '/assets/admin_js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'; //可上傳一般檔案
	config.filebrowserImageUploadUrl = '/assets/admin_js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';//可上傳圖檔
	config.filebrowserFlashUploadUrl = '/assets/admin_js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';//可上傳Flash檔案
};
