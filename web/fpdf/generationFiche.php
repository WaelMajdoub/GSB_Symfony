<?php
require('fpdf.php');

//Classe FPDF, laisser telle qu'elle
class PDF extends FPDF
{
}

//Création du PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->Cell(0,10,'Impression de la ligne numéro ',0,1);
$pdf->Output();