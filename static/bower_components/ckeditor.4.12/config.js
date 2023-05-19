/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function(config) {
    config.toolbarGroups = [
        { name: 'document',	   groups: [ 'mode' ] },
        { name: 'insert' },        
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
        { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
        '/',
        { name: 'styles' },
        { name: 'colors', groups: [ 'TextColor', 'BGColor' ] }
    ];
    
    config.removeButtons = "Underline,subscript,Flash,HorizontalRule,PageBreak,Iframe,CopyFormatting,RemoveFormat,BidiLtr,BidiRtl,Language,Save,NewPage,Preview,Print";
};
