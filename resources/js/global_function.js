function set_option_select2(cmb_name, data, placeholder, key_name, value_name) {
    if ( key_name == '' )
        key_name = 'id';
    if ( value_name == '' )
        value_name = 'name';

    var result_html = '<option value="">'+placeholder+'</option>';
    var selected_text = '';
    for ( var i=0; i < data.length; i++ ) {
        result_html += '<option ';
        result_html += 'value="'+ data[i][key_name] +'">';
        result_html += data[i][value_name];
        result_html += '</option>';
    }
    $('#'+cmb_name).html(result_html);
    $('#select2-'+cmb_name+'-container').html('');
    $('#select2-'+cmb_name+'-container').append(placeholder);
}

function set_loader_select2(cmb_name) {
    $('#'+cmb_name).html('<option value=""></option>');
    $('#'+cmb_name).parent().children('.select2-selection__rendered').attr('title', '');
    $('#select2-'+cmb_name+'-container').html('');
    $('#select2-'+cmb_name+'-container').append('<span class="select2-selection__clear"><img src="'+base_url+'resources/images/small-loader.gif"></span>');
    $('#select2-'+cmb_name+'-container').append('<span class="select2-selection__placeholder">Loading</span>');
    $('#select2-'+cmb_name+'-container').show();
}
function reset_select2(cmb_name, placeholders) {
    $('#'+cmb_name).html('<option value="">'+placeholders+'</option>');
    $('#'+cmb_name).parent().children('.select2-selection__rendered').attr('title', '');
    $('#select2-'+cmb_name+'-container').html(placeholders);
    $('#select2-'+cmb_name+'-container').attr('title', placeholders);
}
function reset_selected_select2(cmb_name, placeholders) {
    $('#'+cmb_name).val('');
    $('#select2-'+cmb_name+'-container').attr('title', '');
    $('#select2-'+cmb_name+'-container').html(placeholders);
    $('#select2-'+cmb_name+'-container .select2-selection__placeholder').html(placeholders);
}
