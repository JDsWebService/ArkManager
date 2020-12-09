<div @if($margin)class="mt-3"@endif>
    <label for="{{ $id }}">{{ $label }}</label>
    <textarea id="{{ $id }}" name="{{ $id }}" placeholder="{{ $placeholder }}">
        @if($model){!! $model !!}@endif
    </textarea>
</div>
<script>
    tinymce.init({
        selector: 'textarea#{{ $id }}',
        plugins: 'autolink lists link hr anchor',
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
        ],
    });
</script>
