<div id="editor-container-{{ $name }}"></div>
<input type="hidden" name="{{ $name }}" id="input-{{ $name }}">

<!-- Include the Quill library -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<!-- Initialize Quill editor -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var quill = new Quill('#editor-container-{{ $name }}', {
            theme: 'snow'
        });

        quill.on('text-change', function() {
            document.getElementById('input-{{ $name }}').value = quill.root.innerHTML;
        });
    });
</script>
