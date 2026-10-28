import {
    ClassicEditor,
    Essentials,
    Paragraph,
    Bold,
    Italic,
    Underline,
    Strikethrough,
    Font,
    Alignment,
    List,
    Link,
    BlockQuote,
    Heading,
    Table,
    TableToolbar,
    Image,
    ImageToolbar,
    ImageCaption,
    ImageStyle
} from 'ckeditor5';

import {
    SimpleUploadAdapter
} from '@ckeditor/ckeditor5-upload';


const editorElement = document.querySelector('#isi');

if (editorElement) {
    ClassicEditor
        .create(editorElement, {
            licenseKey: 'GPL',

           plugins: [
            Essentials,
            Paragraph,
            Bold,
            Italic,
            Underline,
            Strikethrough,
            Font,
            Alignment,
            List,
            Link,
            BlockQuote,
            Heading,
            Table,
            TableToolbar,

            Image,
            ImageToolbar,
            ImageCaption,
            ImageStyle,
            SimpleUploadAdapter
        ],

           toolbar: [
            'undo',
            'redo',
            '|',
            'heading',
            '|',
            'bold',
            'italic',
            'underline',
            'strikethrough',
            '|',
            'fontSize',
            'fontFamily',
            'fontColor',
            'fontBackgroundColor',
            '|',
            'alignment',
            '|',
            'bulletedList',
            'numberedList',
            '|',
            'link',
            'uploadImage',
            'blockQuote',
            'insertTable'
        ],

        simpleUpload: {
            uploadUrl: '/admin/berita/upload-image',

            headers: {
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute('content')
            }
        },

        image: {
            toolbar: [
                'imageTextAlternative',
                '|',
                'imageStyle:inline',
                'imageStyle:block',
                'imageStyle:side'
            ]
        },

            table: {
                contentToolbar: [
                    'tableColumn',
                    'tableRow',
                    'mergeTableCells'
                ]
            }
        })
        .then(editor => {
            console.log('CKEditor 5 berhasil dijalankan.');
        })
        .catch(error => {
            console.error('CKEditor 5 error:', error);
        });
}