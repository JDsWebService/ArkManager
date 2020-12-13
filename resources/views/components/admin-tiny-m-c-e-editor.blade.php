<div @if($margin)class="mt-3"@endif>
    <label for="{{ $id }}">{{ $label }}</label>
    <textarea id="{{ $id }}" name="{{ $id }}" placeholder="{{ $placeholder }}">
        @if($model){!! $model !!}@endif
    </textarea>
</div>
<script>
    var editor_config = {
        selector: 'textarea#{{ $id }}',
        plugins: 'autolink lists link hr anchor image',
        menubar: false,
        branding: false,
        style_formats: [
            { title: 'Headings', items: [
                    { title: 'Header', format: 'h4' },
                    { title: 'Sub-Header', format: 'h5' },
                ]},
            { title: 'Inline', items: [
                    { title: 'Bold', format: 'bold' },
                    { title: 'Italic', format: 'italic' },
                    { title: 'Underline', format: 'underline' },
                ]},
            { title: 'Align', items: [
                    { title: 'Left', format: 'alignleft' },
                    { title: 'Center', format: 'aligncenter' },
                    { title: 'Right', format: 'alignright' },
                    { title: 'Justify', format: 'alignjustify' }
                ]},
        ],
        toolbar: [
            {
                name: 'history', items: [ 'undo', 'redo' ]
            },
            {
                name: 'styles', items: [ 'styleselect' ]
            },
            {
                name: 'formatting', items: [ 'bold', 'italic', 'underline']
            },
            {
                name: 'alignment', items: [ 'alignleft', 'aligncenter', 'alignright', 'alignjustify' ]
            },
            {
                name: 'image', items: [ 'image' ]
            }
        ],
        path_absolute : "/",
        relative_urls: false,
        file_picker_callback : function(callback, value, meta) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + 'admin/laravel-filemanager?editor=' + meta.fieldname;
            if (meta.filetype == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.openUrl({
                url : cmsURL,
                title : 'ArkManager File Upload',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no",
                onMessage: (api, message) => {
                    callback(message.content);
                }
            });
        }
    };

    tinymce.init(editor_config);
</script>
