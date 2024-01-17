<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'libraries/fpdf181/fpdf.php';

class PdfController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function generatePdfWithImage()
    {
        // Load library FPDF
        $this->load->library('fpdf');

        // Create new PDF document
        $pdf = new FPDF();

        // Add a page to the PDF
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('Arial', 'B', 16);

        // Set some content
        $content = 'Hello, this is a PDF with an image.';

        // Output content to PDF
        $pdf->Cell(40, 10, $content);

        // Add an image to the PDF
        $imagePath = FCPATH . './ttd/ttd.png'; // Ganti dengan path gambar Anda
        $pdf->Image($imagePath, $x = 10, $y = 50, $w = 50, $h = 50);

        // Output PDF to browser or save to file
        $pdf->Output();
    }
}
