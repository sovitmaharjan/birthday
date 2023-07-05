<script>
    var validation_errors = @json($errors->getMessages());
    for (const [key, value] of Object.entries(validation_errors)) {
        $(`#${key}`).css({
            "border": "1px solid #f1416c"
        });
        $(`
            <div class="text-danger">
                ${value[0]}
            </div>
        `).insertAfter($(`#${key}`));
    }
</script>
