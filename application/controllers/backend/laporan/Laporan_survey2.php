<?php
defined("BASEPATH") or exit("No direct script access allowed");
class Laporan_survey2 extends MY_Controller
{
    var $page_title = "Laporan Survey 2";
    var $column_datatable = [
        "id_survey",
        "tanggal",
        "no_permohonan",
        "layanan",
        "nama",
        "pekerjaan",
        "usia",
        "perusahaan",
        "jenis_kelamin",
        "survey1",
        "survey2",
        "survey3",
        "survey4",
        "survey5",
        "survey6",
        "survey7",
        "survey8",
        "survey9",
        "survey10",
        "survey11",
        "survey12",
        "survey13",
        "survey14",
        "survey15",
        "survey16",
        "survey17",
        "survey18",
        "survey19",
        "survey20",
    ];
    var $folder = "backend/laporan";
    var $module = "";

    function __construct()
    {
        parent::__construct();
        $module = $this->folder . "/" . $this->router->fetch_class();
        $this->load->model(
            $this->folder . "/" . "laporan_survey2_model",
            "app_model"
        );
        $this->app_model->initialize($module);
        $this->module = $module;
    }
    public function index()
    {
        $module = $this->module;
        $tahun = $this->input->post("tahun");
        $bulan = $this->input->post("bulan");
        $this->load->model("global_model");
        $script =
            '
            $(function () {
                var oTable = $("#datatable").DataTable({
                    responsive: {
                        details: {
                            type: "column",
                            target: -1
                        }
                    },
                     columnDefs: [ {
                        className: "control",
                        orderable: false,
                        targets:   -1
                    }],
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    dom: \'Blfrtip\',
                    buttons: [
                      {
                          extend: \'copy\',
                          text: \'<div class="btn btn-sm btn-success" style="display: none;">Copy</div>\'
                      },
                      {
                          extend: \'excel\',
                          text: \'<div class="btn btn-sm btn-primary">Excel</div>\'
                      },
                      {
                          extend: \'print\',
                          text: \'<div class="btn btn-sm btn-warning" style="display: none;">Print</div>\'
                      },
                      {
                          text: \'<div class="btn btn-sm btn-info">Laporan</div>\',
                          action: function ( e, dt, node, config ) {
                              $.ajax({
                                  url: "' .
            base_url() .
            $module .
            "/laporan?tahun=" .
            $tahun .
            '",
                                  type: "GET",
                                  success: function(data){
                                      window.open("' .
            base_url() .
            $module .
            "/laporan?tahun=" .
            $tahun .
            '", "_blank");
                                  }
                              });
                          }
                        },
                      {
                        extend: \'pdfHtml5\',
                        text: \'<div class="btn btn-sm btn-warning" style="margin-left: 3px;">Print</div>\',
                        pageSize: \'LEGAL\',
                        orientation: \'landscape\',
			exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28]
                        },
			customize: function(doc) {
			   doc.styles.tableHeader.fontSize = 7
     			   doc.defaultStyle.fontSize = 7
 			}
                    }
                    ],
                    "order": [[ 0, "desc" ]],
"processing": true,
                    "serverSide": true,
                    "responsive": true,
                    "ajax" : {
                        "url": "' .
            base_url() .
            $module .
            "/getDataTable?tahun=" .
            $tahun .
            "&bulan=" .
            $bulan .
            '",
                        "type": "POST"
                    }
                });
            });
            ';
        $data["title"] = $this->page_title;
        $this->template->add_css("resources/plugins/select2/select2.min.css");
        $this->template->add_css(
            "resources/plugins/select2/select2-bootstrap.min.css"
        );
        $this->template->add_css(
            "resources/plugins/datatables/dataTables.bootstrap.css"
        );
        $this->template->add_css(
            "resources/plugins/datatables/extensions/Responsive/css/responsive.dataTables.min.css"
        );

        $this->template->add_js(
            "resources/plugins/select2/placeholders.jquery.min.js"
        );
        $this->template->add_js("resources/plugins/select2/select2.min.js");
        $this->template->add_js(
            "resources/plugins/datatables/jquery.dataTables.min.js"
        );
        $this->template->add_js(
            "resources/plugins/datatables/dataTables.bootstrap.min.js"
        );
        $this->template->add_js(
            "resources/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"
        );
        $this->template->add_js(
            "resources/plugins/datatables/dataTables.buttons.min.js"
        );
        $this->template->add_js(
            "resources/plugins/datatables/extensions/FixedHeader/js/dataTables.fixedHeader.min.js"
        );
        $this->template->add_js("resources/plugins/datatables/jszip.min.js");
        $this->template->add_js("resources/plugins/datatables/pdfmake.min.js");
        $this->template->add_js("resources/plugins/datatables/vfs_fonts.js");
        $this->template->add_js(
            "resources/plugins/datatables/buttons.flash.min.js"
        );
        $this->template->add_js(
            "resources/plugins/datatables/buttons.html5.min.js"
        );
        $this->template->add_js(
            "resources/plugins/datatables/buttons.print.min.js"
        );

        $this->template->add_js($script, "embed");
        $this->template->write("title", $data["title"]);
        $this->template->write_view(
            "content",
            $this->folder . "/laporan_survey2/datatable",
            $data,
            true
        );
        $this->template->render();
    }
    function getDataTable()
    {
        $iDisplayStart = $this->input->get_post("start", true);
        $iDisplayLength = $this->input->get_post("length", true);
        $order = $this->input->get_post("order", true);
        $sSearch = $this->input->get_post("search", true);
        $year = $this->input->get("tahun");
        $month = $this->input->get("bulan");

        $view = $this->app_model->show_datatable(
            $this->column_datatable,
            $iDisplayStart,
            $iDisplayLength,
            $order,
            $sSearch,
            $year,
            $month
        );

        echo $view;
    }
    private function valid_form($act = "add")
    {
        $this->load->library("form_validation");
        $config = [
            [
                "field" => "tanggal",
                "label" => "Tanggal",
                "rules" => "required",
            ],
            [
                "field" => "no_permohonan",
                "label" => "No_Permohonan",
                "rules" => "required",
            ],
            [
                "field" => "layanan",
                "label" => "Layanan",
                "rules" => "required",
            ],
            [
                "field" => "nama",
                "label" => "Nama",
                "rules" => "required",
            ],
            [
                "field" => "pekerjaan",
                "label" => "Pekerjaan",
                "rules" => "required",
            ],
            [
                "field" => "usia",
                "label" => "Usia",
                "rules" => "required",
            ],
            [
                "field" => "perusahaan",
                "label" => "Perusahaan",
                "rules" => "required",
            ],
            [
                "field" => "jenis_kelamin",
                "label" => "jenis_kelamin",
                "rules" => "required",
            ],
            [
                "field" => "survey1",
                "label" => "survey1",
                "rules" => "required",
            ],
            [
                "field" => "survey2",
                "label" => "survey2",
                "rules" => "required",
            ],
            [
                "field" => "survey3",
                "label" => "survey3",
                "rules" => "required",
            ],
            [
                "field" => "survey4",
                "label" => "survey4",
                "rules" => "required",
            ],
            [
                "field" => "survey5",
                "label" => "survey5",
                "rules" => "required",
            ],
            [
                "field" => "survey6",
                "label" => "survey6",
                "rules" => "required",
            ],
            [
                "field" => "survey7",
                "label" => "survey7",
                "rules" => "required",
            ],
            [
                "field" => "survey8",
                "label" => "survey8",
                "rules" => "required",
            ],
            [
                "field" => "survey9",
                "label" => "survey9",
                "rules" => "required",
            ],
            [
                "field" => "survey10",
                "label" => "survey10",
                "rules" => "required",
            ],
            [
                "field" => "survey11",
                "label" => "survey11",
                "rules" => "required",
            ],
            [
                "field" => "survey12",
                "label" => "survey12",
                "rules" => "required",
            ],
            [
                "field" => "survey13",
                "label" => "survey13",
                "rules" => "required",
            ],
            [
                "field" => "survey14",
                "label" => "survey14",
                "rules" => "required",
            ],
            [
                "field" => "survey15",
                "label" => "survey15",
                "rules" => "required",
            ],
            [
                "field" => "survey16",
                "label" => "survey16",
                "rules" => "required",
            ],
            [
                "field" => "survey17",
                "label" => "survey17",
                "rules" => "required",
            ],
            [
                "field" => "survey18",
                "label" => "survey18",
                "rules" => "required",
            ],
            [
                "field" => "survey19",
                "label" => "survey19",
                "rules" => "required",
            ],
            [
                "field" => "survey20",
                "label" => "survey20",
                "rules" => "required",
            ],
        ];
        $this->form_validation->set_rules($config);
    }

    function add()
    {
        $this->load->model("global_model");
        $module = $this->module;
        $data["detail"] = [];
        $data["title"] = "Tambah Data";
        $data["url_back"] =
            "window.location.href='" . base_url() . $module . "'";
        $errMsg = null;

        if ($_POST) {
            $data_post = $this->input->post();
            $data["detail"] = $data_post;
            $data_insert = [];
            $simpan = true;
            $this->valid_form(strtolower(__FUNCTION__));

            if ($this->form_validation->run() == false) {
                $simpan = false;
                $errMsg = "<ul>" . validation_errors("<li>", "</li>") . "</ul>";
            }

            if ($simpan) {
                $data_insert = [
                    "tanggal" => $this->input->post("tanggal"),
                    "no_permohonan" => $this->input->post("no_permohonan"),
                    "layanan" => $this->input->post("layanan"),
                    "nama" => $this->input->post("nama"),
                    "pekerjaan" => $this->input->post("pekerjaan"),
                    "usia" => $this->input->post("usia"),
                    "perusahaan" => $this->input->post("perusahaan"),
                    "jenis_kelamin" => $this->input->post("jenis_kelamin"),
                    "survey1" => $this->input->post("survey1"),
                    "survey2" => $this->input->post("survey2"),
                    "survey3" => $this->input->post("survey3"),
                    "survey4" => $this->input->post("survey4"),
                    "survey5" => $this->input->post("survey5"),
                    "survey6" => $this->input->post("survey6"),
                    "survey7" => $this->input->post("survey7"),
                    "survey8" => $this->input->post("survey8"),
                    "survey9" => $this->input->post("survey9"),
                    "survey10" => $this->input->post("survey10"),
                    "survey11" => $this->input->post("survey11"),
                    "survey12" => $this->input->post("survey12"),
                    "survey13" => $this->input->post("survey13"),
                    "survey14" => $this->input->post("survey14"),
                    "survey15" => $this->input->post("survey15"),
                    "survey16" => $this->input->post("survey16"),
                    "survey17" => $this->input->post("survey17"),
                    "survey18" => $this->input->post("survey18"),
                    "survey19" => $this->input->post("survey19"),
                    "survey20" => $this->input->post("survey20"),
                ];

                $insert = $this->app_model->insert_data($data_insert);
                if ($insert) {
                    redirect(base_url() . $module);
                } else {
                    $errMsg = "Data gagal disimpan";
                }
            }
        }
        $data["page_title"] = $this->page_title;
        $data["errMsg"] = $errMsg;
        $this->template->add_css("resources/plugins/select2/select2.min.css");
        $this->template->add_css(
            "resources/plugins/select2/select2-bootstrap.min.css"
        );
        $this->template->add_js(
            "resources/plugins/select2/placeholders.jquery.min.js"
        );
        $this->template->add_js("resources/plugins/select2/select2.min.js");
        $this->template->write("title", "Tambah " . $this->page_title);
        $this->template->write_view(
            "content",
            $this->folder . "/laporan_survey2/form",
            $data,
            true
        );
        $this->template->render();
    }

    function edit($id = 0)
    {
        $this->load->model("global_model");
        $module = $this->module;
        $data["detail"] = $this->app_model->get_by_id($id);
        if (!$data["detail"]) {
            show_404();
            return;
        }
        $data["title"] = "Edit Data";
        $data["url_back"] =
            "window.location.href='" . base_url() . $this->module . "'";
        $errMsg = null;

        if ($_POST) {
            $data_post = $this->input->post();
            $data["detail"] = $data_post;
            $simpan = true;

            $this->valid_form("edit");

            if ($this->form_validation->run() == false) {
                $simpan = false;
                $errMsg = "<ul>" . validation_errors("<li>", "</li>") . "</ul>";
            }

            if ($simpan) {
                $data_update = [
                    "tanggal" => $this->input->post("tanggal"),
                    "no_permohonan" => $this->input->post("no_permohonan"),
                    "layanan" => $this->input->post("layanan"),
                    "nama" => $this->input->post("nama"),
                    "pekerjaan" => $this->input->post("pekerjaan"),
                    "usia" => $this->input->post("usia"),
                    "perusahaan" => $this->input->post("perusahaan"),
                    "jenis_kelamin" => $this->input->post("jenis_kelamin"),
                    "survey1" => $this->input->post("survey1"),
                    "survey2" => $this->input->post("survey2"),
                    "survey3" => $this->input->post("survey3"),
                    "survey4" => $this->input->post("survey4"),
                    "survey5" => $this->input->post("survey5"),
                    "survey6" => $this->input->post("survey6"),
                    "survey7" => $this->input->post("survey7"),
                    "survey8" => $this->input->post("survey8"),
                    "survey9" => $this->input->post("survey9"),
                    "survey10" => $this->input->post("survey10"),
                    "survey11" => $this->input->post("survey11"),
                    "survey12" => $this->input->post("survey12"),
                    "survey13" => $this->input->post("survey13"),
                    "survey14" => $this->input->post("survey14"),
                    "survey15" => $this->input->post("survey15"),
                    "survey16" => $this->input->post("survey16"),
                    "survey17" => $this->input->post("survey17"),
                    "survey18" => $this->input->post("survey18"),
                    "survey19" => $this->input->post("survey19"),
                    "survey20" => $this->input->post("survey20"),
                ];
                $update = $this->app_model->update_data($id, $data_update);
                if ($update) {
                    redirect(base_url() . $module);
                } else {
                    $errMsg = "Data gagal disimpan";
                }
            }
        }
        $data["page_title"] = $this->page_title;
        $data["id"] = $id;
        $data["errMsg"] = $errMsg;
        $this->template->add_css("resources/plugins/select2/select2.min.css");
        $this->template->add_css(
            "resources/plugins/select2/select2-bootstrap.min.css"
        );
        $this->template->add_js(
            "resources/plugins/select2/placeholders.jquery.min.js"
        );
        $this->template->add_js("resources/plugins/select2/select2.min.js");
        $this->template->write("title", "Edit " . $this->page_title);
        $this->template->write_view(
            "content",
            $this->folder . "/laporan_survey2/form",
            $data,
            true
        );
        $this->template->render();
    }

    function delete($id = "")
    {
        $this->app_model->delete_data($id);
        redirect(base_url() . $this->module);
    }

    public function laporan()
    {
	ini_set('memory_limit', '2048M');

        $this->load->helper("skm");
        $this->load->helper("tgl_indo");
        $this->load->library("pdf");

        $year = (int) $this->input->get("tahun");
        $data = [];

        $signers = [
            "nama_kepala_bmkg",
            "nip_kepala_bmkg",
            "nama_kepala_ptsp",
            "nip_kepala_ptsp",
            "nama_kepala_biro",
            "nama_pembuat_laporan",
            "nip_pembuat_laporan",
        ];
        foreach ($signers as $signer) {
            $data[$signer] = $this->db
                ->get_where("tbl_setting_content", ["variable_task" => $signer])
                ->row()->value_task;
        }

        $result = $this->db
            ->select(
                "a.survey, d.jenis_kelamin, d.username, d.tanggal_lahir, d.pekerjaan, e.pendidikan"
            )
            ->from("tbl_survey a")
            ->join(
                "tbl_detail_permohonan b",
                "a.id_detail_permohonan = b.id_detail_permohonan",
                "left"
            )
            ->join(
                "tbl_permohonan c",
                "b.id_permohonan = c.id_permohonan",
                "left"
            )
            ->join("tbl_admin d", "c.id_pemohon = d.id_admin", "left")
            ->join(
                "m_pendidikan e",
                "d.id_pendidikan = e.id_pendidikan",
                "left"
            )
            ->where('b.is_survey = "Sudah"')
            ->where("c.status = 10")
            ->where("YEAR(c.tanggal_permohonan) = " . $year)
            ->get()
            ->result();

        // Useful to save all factors from all rows
        // and would be used later to generate average of all factors
        $nrr_factor_temp = [];
        $nrr_factor_keys = [
            "Persyaratan",
            "Prosedur",
            "Waktu Pelayanan",
            "Biaya/Tarif",
            "Produk Layanan",
            "Kompetensi Pelaksana",
            "Perilaku Pelaksana",
            "Penangangan Pengaduan, Saran dan Masukan",
            "Saran dan Prasaran",
        ];

        $factor_per_service = [];
        foreach ($result as $row) {
            $age = get_age($row->tanggal_lahir);
            $gender = $row->jenis_kelamin == 1 ? "Laki-laki" : "Perempuan";

            $row_data = [
                "username" => $row->username,
                "gender" => $gender,
                "age" => $age,
                "education" => $row->pendidikan,
                "job" => $row->pekerjaan,
            ];

            $factors = get_skm_factor_per_row($row->survey);
            $factor_with_keys = array_combine($nrr_factor_keys, $factors);
            $row_data = array_merge($row_data, $factor_with_keys);
            // $row_data[] = ""; // For description column

            array_push($factor_per_service, $row_data);
            array_push($nrr_factor_temp, $factors);
        }

        $grouped_factors = [];
        foreach ($factor_per_service as $factor) {
            $username = $factor["username"];
            if (!isset($grouped_factors[$username])) {
                $initial_values = array_fill_keys($nrr_factor_keys, [
                    "sum" => 0,
                    "count" => 0,
                ]);
                $old_values = [
                    "age" => $factor["age"],
                    "job" => $factor["job"],
                    "gender" => $factor["gender"],
                    "education" => $factor["education"],
                ];

                $grouped_factors[$username] = array_merge(
                    $old_values,
                    $initial_values
                );
            }

            foreach ($nrr_factor_keys as $key) {
                $grouped_factors[$username][$key]["sum"] +=
                    (float) $factor[$key];
                $grouped_factors[$username][$key]["count"] += 1;
            }
        }

        $tbody_rows = [];
        foreach ($grouped_factors as $username => $factor) {
            $row = [
                "gender" => $factor["gender"],
                "age" => $factor["age"],
                "education" => $factor["education"],
                "job" => $factor["job"],
            ];

            foreach ($nrr_factor_keys as $key) {
                $row[$key] = round(
                    $factor[$key]["sum"] / $factor[$key]["count"],
                    2
                );
            }

            $row[] = "";
            array_push($tbody_rows, $row);
        }

        $data["result"] = $tbody_rows;

        $nrr_factors = [];
        foreach ($nrr_factor_keys as $i => $key) {
            $nrr_factors[$key] = get_skm_factor($nrr_factor_temp, $i);
        }

        $data["nrr_factors"] = $nrr_factors;
        $data["avg_weighted_nrr_factor"] = round(
            number_format(array_sum($nrr_factors) / count($nrr_factors), 3),
            2
        );

        $weighted_nrr_factors = array_map(function ($factor) {
            return $factor * 0.11;
        }, $nrr_factors);
        $data["weighted_nrr_factors"] = $weighted_nrr_factors;

        $skm_score = array_sum($weighted_nrr_factors) * 25;
        $data["skm_score"] = round($skm_score, 2);

        $this->pdf->load_view(
            $this->folder . "/laporan_survey2/laporan",
            $data
        );

    }
}
