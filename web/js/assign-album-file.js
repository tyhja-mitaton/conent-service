$('[name="registered-only[]"]').on('change', function() {
    let type = $(this).is(':checked') ? 1 : 0;console.log(type);
    $.ajax({
        url: 'set-type?id=' + $(this).val() + '&type=' + type,
        type: 'POST'
    });
});