$(function () {
    $('#formFilter').modal({
        show: false
    });
    $('.table_reference').change(function(e) {
        var thisid = $(this).attr('id');
        var explid = thisid.split('_');
        var number = explid[3];
        var obj_pk_column = 'reference_pk_name_'+number;
        var obj_value_column = 'reference_value_name_'+number;
        var obj_filter_column = 'reference_filtered_by_'+number;
        set_loader_select2(obj_pk_column);
        set_loader_select2(obj_value_column);
        set_loader_select2(obj_filter_column);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>form_generator/get_columns",
            data: "table_name="+$(this).val(),
            success: function(msg) {
                var data = JSON.parse(msg);
                var columns = data.result;
                set_option_select2(obj_pk_column, columns, ' - Pilih Column - ');
                set_option_select2(obj_value_column, columns, ' - Pilih Column - ');
                set_option_select2(obj_filter_column, columns, ' - Pilih Column - ');
            },
            error: function(xhr, msg, e) {
                console.log(xhr.responseText);
            }
        });
    });
    $('.table_filter').change(function(e) {
        set_loader_select2('filter_key_name');
        set_loader_select2('filter_value_name');
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>form_generator/get_columns",
            data: "table_name="+$(this).val(),
            success: function(msg) {
                var data = JSON.parse(msg);
                var columns = data.result;
                set_option_select2('filter_key_name', columns, ' - Pilih Column - ');
                set_option_select2('filter_value_name', columns, ' - Pilih Column - ');
            },
            error: function(xhr, msg, e) {
                console.log(xhr.responseText);
            }
        });
    });
    $('.del_filter').click(function() {
        $(this).parent().parent().remove();
    });
    $('#form_filter').submit(function() {
        var column_name = $('#filter_column_name').val();
        var table_name = $('#filter_table_name').val();
        var key_name = $('#filter_key_name').val();
        var value_name = $('#filter_value_name').val();

        var text_column_name = $('#filter_column_name option:selected').text();
        var text_table_name = $('#filter_table_name option:selected').text();
        var text_key_name = $('#filter_key_name option:selected').text();
        var text_value_name = $('#filter_value_name option:selected').text();

        $('#template_filter .value_column_name').val(column_name);
        $('#template_filter .value_table_name').val(table_name);
        $('#template_filter .value_pk_name').val(key_name);
        $('#template_filter .value_value_name').val(value_name);

        $('#template_filter .text_filter_column_name').html(text_column_name);
        $('#template_filter .text_filter_table_name').html(text_table_name);
        $('#template_filter .text_filter_key_name').html(text_key_name);
        $('#template_filter .text_filter_value_name').html(text_value_name);

        var template_row = $('#template_filter tbody').html();
        $('#tbl_filter tbody').append(template_row);
        $('.del_filter').click(function() {
            $(this).parent().parent().remove();
        });
        $('#formFilter').modal('hide');
        return false;
    });
});
function add_filter() {
    $('#formFilter').modal('show');
    reset_select2('filter_column_name', ' - Pilih Column - ');
    reset_select2('filter_table_name', ' - Pilih Table - ');
    empty_select2('filter_key_name', ' - Pilih Key - ');
    empty_select2('filter_value_name', ' - Pilih Value - ');
}