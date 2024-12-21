$(function () {
    $('#formGeneratingData').modal({show: false});
    $('#btn_backup').click(function() {
        $('#modal_footer').hide();
        $('#modal_content_data').html('Prosesing Backup Data ...');
        $('#formGeneratingData').modal('show');
        $.ajax({
            type: "POST",
            url: base_url + "admin_aplikasi/backup/backup_database",
            success: function(msg) {
                $('#modal_content_data').html(msg);
                $('#modal_footer').show();
                table.ajax.reload();
            },
            error: function(xhr, msg, e) {
                console.log(xhr.responseText);
            }
        });
    });
});