<script src='{{"https://cdn.tiny.cloud/1/" . env('TINY_CLOUD_API_KEY') . "/tinymce/7/tinymce.min.js"}}'
        referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '.wysiwyg',
        plugins: 'code link wordcount',
        content_style: '@import url("https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap"); body { font-family: "Quicksand", sans-serif; font-optical-sizing: auto; }',
        menubar: false,
        toolbar: 'undo redo | bold italic | link code | wordcount'
    });
</script>
