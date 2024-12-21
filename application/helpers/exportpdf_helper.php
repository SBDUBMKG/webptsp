<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function generate_pdf($object, $filename='', $direct_download=TRUE, $landscape=FALSE)
{
	require_once APPPATH."/third_party/dompdf/dompdf_config.inc.php";
//
    $dompdf = new DOMPDF();
    $dompdf->load_html($object);
    if ( $landscape == true ) {
        $dompdf->set_paper('a4', 'landscape');
    }
    $dompdf->render();
//
    if ($direct_download == TRUE)
        $dompdf->stream($filename);
    else
        return $dompdf->output();
}
?>