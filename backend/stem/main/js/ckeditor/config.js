/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.language = 'zh-cn';
	config.uiColor = '#F8F6F3';
	// config.removePlugins = 'colorbutton,find,flash,font,' +
	// 					'forms,iframe,image,newpage,removeformat,' +
	// 					'smiley,specialchar,stylescombo,templates';

	config.extraPlugins = 'abbr,wordcount';

	config.toolbar = [
    	{ name: 'basicstyles', items: [ 'Bold', 'Italic','Underline','Strike','-','Subscript','Superscript'] },
    	{ name: '', items: ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','Abbr']},
    	{ name: '', items: ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock']},
    	'/',
		{ name: 'styles' , items: [ 'Font','Format']},
		{ name: 'tools', items: ['Image','Table','HorizontalRule','SpecialChar',]},
    	{ name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord'] },
    	{ name: '', items: ['Source','SelectAll','RemoveFormat','-','Undo', 'Redo']}
	];

    config.wordcount = {

        // Whether or not you want to show the Word Count
        showWordCount: true,
        // Whether or not you want to show the Char Count
        showCharCount: true,
        // Option to limit the characters in the Editor
        charLimit: 'unlimited',
        // Option to limit the words in the Editor
        wordLimit: 'unlimited'
    };

	config.contentsCss = '/js/ckeditor/contents.css' + '?code=' + Math.random();
	config.height = 400;
	config.filebrowserBrowseUrl = '/kcfinder/browse.php?type=files';
    config.filebrowserImageBrowseUrl = '/files/load/images';
    config.filebrowserFlashBrowseUrl = '/kcfinder/browse.php?type=flash';
    config.filebrowserUploadUrl = '/kcfinder/upload.php?type=files';
    config.filebrowserImageUploadUrl = '/files/upload/images';
    config.filebrowserFlashUploadUrl = '/kcfinder/upload.php?type=flash';

};
