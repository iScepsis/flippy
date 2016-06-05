CKEDITOR.plugins.add( 'menus', {
    requires: 'widget',

    icons: 'menus',

    init: function( editor ) {
        editor.widgets.add( 'menus', {

            button: 'Добавить меню',

            template:
            '<div class="menus">' +
            '<h2 class="menus-title">Title</h2>' +
            '<div class="menus-content"><p>Content...</p></div>' +
            '</div>',

            editables: {
                title: {
                    selector: '.menus-title',
                    allowedContent: 'br strong em'
                },
                content: {
                    selector: '.menus-content',
                    allowedContent: 'p br ul ol li strong em'
                }
            },

            allowedContent:
                'div(!menus); div(!menus-content); h2(!menus-title)',

            requiredContent: 'div(menus)',

            upcast: function( element ) {
                return element.name == 'div' && element.hasClass( 'menus' );
            }
        } );
        editor.ui.addButton( 'menus', {
            label: 'Insert Timestamp',
            command: 'insertTimestamp',
            toolbar: 'insert'
        });
    }
} );