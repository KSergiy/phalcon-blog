{{ assets.outputJs('js') }}

{{ javascript_include("js/tinymce/tinymce.min.js") }}

{{ javascript_include('js/fileupload/jquery.iframe-transport.js') }}
{{ javascript_include('js/fileupload/jquery.fileupload.js') }}
{{ javascript_include('js/fileupload/jquery.fileupload-ui.js') }}

<script>
    $(function () {
        $('#fileupload').fileupload({
            formData: {
                ovner: $('#id').val()
            },
            dataType: 'json',
            add: function (e, data) {
                data.context = $('<p/>').text('Uploading...').appendTo(document.body);
                data.submit();
            },
            progressall: function ( e, data ) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .progress-bar').css(
                        'width',
                        progress + '%'
                );
            },
            done: function ( e, data ) {
                $(data.result.result).insertAfter('#base_line');
            }
        });
    });
</script>