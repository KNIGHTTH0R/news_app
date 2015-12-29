<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('generate_news_pdf')){
    function generate_news_pdf( $news) {
         $imagePath = $_SERVER['DOCUMENT_ROOT'].'news_app/uploads/news_images/';

        require $_SERVER['DOCUMENT_ROOT'].'news_app/app/libraries/FPDF/fpdf.php';
        $pdf = new FPDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        // Title
        //$pdf->Ln(4);
        $pdf->Write( 1, $news->title );
        //$pdf->Ln(10);
        $pdf->Image($imagePath.$news->news_image,50,30,'C');
        //$pdf->Ln(16);
        $pdf->SetFont('Arial','',12);
        $pdf->Write( 5, $news->news_text );
        $pdf->Output();

    }  
}

