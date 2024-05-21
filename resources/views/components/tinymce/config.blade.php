<script src='{{"https://cdn.tiny.cloud/1/" . env('TINY_CLOUD_API_KEY') . "/tinymce/7/tinymce.min.js"}}'
        referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '.wysiwyg',
        plugins: 'code link wordcount',
        content_style: '@import url("https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap"); body { font-family: "Quicksand", sans-serif; font-optical-sizing: auto; }',
        menubar: false,
        language: 'fr_FR',
        toolbar: 'undo redo | bold italic | link code | wordcount'
    });

    tinymce.init({
        selector: '.advanced-wysiwyg',
        plugins: 'code lists link wordcount autosave searchreplace help autolink preview',
        content_style: '@import url("https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap"); body { font-family: "Quicksand", sans-serif; font-optical-sizing: auto; }',
        autosave_interval: '20s',
        menubar: 'file edit view tools help',
        language: 'fr_FR',
        toolbar: 'undo redo | blocks | bold italic | numlist bullist | link | searchreplace wordcount | restoredraft '
    });
</script>
