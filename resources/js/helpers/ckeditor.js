export default function renderizeWYISYGEditor(textareaEditor, height) {


    CKEDITOR.config.language = 'es';
    const ckEditorInstance = CKEDITOR.replace(textareaEditor, {
        toolbar: [{
            name: 'clipboard',
            items: ['PasteFromWord', '-', 'Undo', 'Redo']
        },
            {
                name: 'basicstyles',
                items: ['Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat', 'Subscript', 'Superscript']
            },
            {
                name: 'links',
                items: ['Link', 'Unlink']
            },
            {
                name: 'paragraph',
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']
            },
            {
                name: 'insert',
                items: ['Image', 'Table']
            },
            {
                name: 'editing',
                items: ['Scayt']
            },
            '/',

            {
                name: 'styles',
                items: ['Format', 'Font', 'FontSize']
            },
            {
                name: 'colors',
                items: ['TextColor', 'BGColor', 'CopyFormatting']
            },
            {
                name: 'align',
                items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']
            },
            {
                name: 'document',
                items: ['Print', 'PageBreak', 'Source']
            }
        ],
        extraPlugins: 'colorbutton,font,justify,print,tableresize,pastefromword,liststyle,pagebreak',
        height: height,
        width: '100%',
        format_tags: 'p;h1;h2;h3;pre',
        removeDialogTabs: 'image:advanced;link:advanced',
        stylesSet: [
            {
                name: 'Marker',
                element: 'span',
                attributes: {
                    'class': 'marker'
                }
            },
            {
                name: 'Cited Work',
                element: 'cite'
            },
            {
                name: 'Inline Quotation',
                element: 'q'
            },
            {
                name: 'Special Container',
                element: 'div',
                styles: {
                    padding: '5px 10px',
                    background: '#eee',
                    border: '1px solid #ccc'
                }
            },
            {
                name: 'Compact table',
                element: 'table',
                attributes: {
                    cellpadding: '5',
                    cellspacing: '0',
                    border: '1',
                    bordercolor: '#ccc'
                },
                styles: {
                    'border-collapse': 'collapse'
                }
            },
            {
                name: 'Borderless Table',
                element: 'table',
                styles: {
                    'border-style': 'hidden',
                    'background-color': '#E6E6FA'
                }
            },
            {
                name: 'Square Bulleted List',
                element: 'ul',
                styles: {
                    'list-style-type': 'square'
                }
            }
        ]
    });

    ckEditorInstance.on('instanceReady', function () {
        $('form textarea').attr('required', '');
        $.each(CKEDITOR.instances, function (instance) {
            CKEDITOR.instances[instance].on("change", function (e) {
                for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }
            });
        });
    });

    return ckEditorInstance;
}
