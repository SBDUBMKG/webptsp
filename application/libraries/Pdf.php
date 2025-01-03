<?php defined("BASEPATH") or exit("No direct script access allowed");

/**
 * CodeIgniter PDF Library
 *
 * Generate PDF's in your CodeIgniter applications.
 *
 * @package         CodeIgniter
 * @subpackage      Libraries
 * @category        Libraries
 * @author          Chris Harvey
 * @license         MIT License
 * @link            https://github.com/chrisnharvey/CodeIgniter-  PDF-Generator-Library
 */

require_once APPPATH . "third_party/dompdf/autoload.inc.php";

use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf extends DOMPDF
{
    /**
     * Get an instance of CodeIgniter
     *
     * @access  protected
     * @return  void
     */
    protected function ci()
    {
        return get_instance();
    }

    /**
     * Load a CodeIgniter view into domPDF
     *
     * @access  public
     * @param   string  $view The view to load
     * @param   array   $data The view data
     * @return  void
     */
    public function load_view($view, $data = [])
    {
        // Initialize Dompdf with options
        $options = new Options();
        $options->set("isHtml5ParserEnabled", true);
        // $options->set("isRemoteEnabled", true);

        $dompdf = new Dompdf($options);
        $html = $this->ci()->load->view($view, $data, true);

        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper("Legal", "landscape");

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream("laporan.pdf", ["Attachment" => 0]);
    }
}
