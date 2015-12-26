/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	//config.uiColor = '#2b3e50';							//Цвет редактора
    config.removePlugins = 'image';
    //config.disableNativeSpellChecker = false;			//Отключаем проверку орфографии CKEditor'a
    config.extraPlugins = 'base64image';  				//Загрузка изображений в формат base64
    //config.extraPlugins = 'menus';
};
