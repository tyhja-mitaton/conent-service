$('[name="select-user[]"]').on('change', function() {
    let url = $(this).is(':checked') ? 'appoint-admin?id=' + $(this).val() : 'dismiss-admin?id=' + $(this).val();
    $.ajax({
        url: 'user/' + url,
        type: 'POST'
    });
});