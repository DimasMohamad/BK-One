<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'third_party/tcpdf/tcpdf.php';

class PdfController extends CI_Controller
{

    public function generatePdfWithImage()
    {
        // Inisialisasi objek TCPDF
        $pdf = new TCPDF();

        // Set dokumen
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('PDF with Image');
        $pdf->SetHeaderData('', '', 'PDF with Image', '');

        // Tambahkan halaman
        $pdf->AddPage();

        // Tambahkan gambar ke halaman
        $imagePath = FCPATH . './ttd/ttd.png';
        $pdf->Image($imagePath, 10, 10, 50, 0, 'JPEG');

        // Simpan atau tampilkan PDF
        $pdf->Output('pdf_with_image.pdf', 'I');
    }
}
