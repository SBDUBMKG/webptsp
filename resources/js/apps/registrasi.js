$(function () {
});

function get_kabkot(id_provinsi) {
    $.ajax({
        type: "GET",
        url: base_url + "services/get_data_kabkot?id_provinsi=" + id_provinsi,
        success: function(msg) {
            var data = JSON.parse(msg);
            var result_kabkot = data.kabkot;

            set_option_select2('kabupaten', result_kabkot, '- Pilih Kabupaten/Kota -', 'id_kabkot', 'kabkot');
        },
        error: function(xhr, msg, e) {
            console.log(xhr.responseText);
        }
    });
}

function get_kabkot_perusahaan(id_provinsi) {
    $.ajax({
        type: "GET",
        url: base_url + "services/get_data_kabkot?id_provinsi=" + id_provinsi,
        success: function(msg) {
            var data = JSON.parse(msg);
            var result_kabkot = data.kabkot;

            set_option_select2('kabupaten_perusahaan', result_kabkot, '- Pilih Kabupaten/Kota -', 'id_kabkot', 'kabkot');
        },
        error: function(xhr, msg, e) {
            console.log(xhr.responseText);
        }
    });
}

function get_kecamatan(id_kabkot) {
    $.ajax({
        type: "GET",
        url: base_url + "services/get_data_kecamatan?id_kabkot=" + id_kabkot,
        success: function(msg) {
            var data = JSON.parse(msg);
            var result_kecamatan = data.kecamatan;

            set_option_select2('kecamatan', result_kecamatan, '- Pilih Kecamatan -', 'id_kecamatan', 'kecamatan');
        },
        error: function(xhr, msg, e) {
            console.log(xhr.responseText);
        }
    });
}

function get_kecamatan_perusahaan(id_kabkot) {
    $.ajax({
        type: "GET",
        url: base_url + "services/get_data_kecamatan?id_kabkot=" + id_kabkot,
        success: function(msg) {
            var data = JSON.parse(msg);
            var result_kecamatan = data.kecamatan;

            set_option_select2('kecamatan_perusahaan', result_kecamatan, '- Pilih Kecamatan -', 'id_kecamatan', 'kecamatan');
        },
        error: function(xhr, msg, e) {
            console.log(xhr.responseText);
        }
    });
}

function get_kelurahan(id_kecamatan) {
    $.ajax({
        type: "GET",
        url: base_url + "services/get_data_kelurahan?id_kecamatan=" + id_kecamatan,
        success: function(msg) {
            var data = JSON.parse(msg);
            var result_kelurahan = data.kelurahan;

            set_option_select2('kelurahan', result_kelurahan, '- Pilih Kelurahan -', 'id_kelurahan', 'kelurahan');
        },
        error: function(xhr, msg, e) {
            console.log(xhr.responseText);
        }
    });
}

function get_kelurahan_perusahaan(id_kecamatan) {
    $.ajax({
        type: "GET",
        url: base_url + "services/get_data_kelurahan?id_kecamatan=" + id_kecamatan,
        success: function(msg) {
            var data = JSON.parse(msg);
            var result_kelurahan = data.kelurahan;

            set_option_select2('kelurahan_perusahaan', result_kelurahan, '- Pilih Kelurahan -', 'id_kelurahan', 'kelurahan');
        },
        error: function(xhr, msg, e) {
            console.log(xhr.responseText);
        }
    });
}

function get_kodepos(id_kelurahan) {
    $.ajax({
        type: "GET",
        url: base_url + "services/get_data_kodepos?id_kelurahan=" + id_kelurahan,
        success: function(msg) {
            var data = JSON.parse(msg);
            var result_kodepos = data.kodepos;

            document.getElementById('kode_pos').value = result_kodepos['kode_pos'];
        },
        error: function(xhr, msg, e) {
            console.log(xhr.responseText);
        }
    });
}

function get_kodepos_perusahaan(id_kelurahan) {
    $.ajax({
        type: "GET",
        url: base_url + "services/get_data_kodepos?id_kelurahan=" + id_kelurahan,
        success: function(msg) {
            var data = JSON.parse(msg);
            var result_kodepos = data.kodepos;

            document.getElementById('kode_pos_perusahaan').value = result_kodepos['kode_pos'];
        },
        error: function(xhr, msg, e) {
            console.log(xhr.responseText);
        }
    });
}