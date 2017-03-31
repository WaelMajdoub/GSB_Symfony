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

//Ajouter un logo GSB ?

//Couleur (bleu) de remplissage pour la cellule suivante (titre)
$pdf->SetFillColor(0, 204, 204);
$pdf->Cell(0,10,'Fiche de frais n METTRE LA VARIABLE L\'ID : METTRE LE LIBELLE DE LA FICHE',0,1, 'C', true);

//Saut de ligne d'une valeur de 10
$pdf->Ln(10);

$pdf->Cell(0,10,'Fiche de frais de : ' . 'METTRE LA VARIABLE DU MOIS',0,1, 'L');
$pdf->Cell(0,10,'Modifiee pour la derniere fois le : ' . 'METTRE LA VARIABLE DE DATE MODIF',0,1, 'L');

//Séparation (modifiable)
$pdf->Cell(0,10,'',0,1, 'C', true);
$pdf->Cell(0,10,'L\'etat de la fiche de frais est METTRE L\'ETAT',0,1, 'L');
$pdf->Cell(0,10,'Son montant est de METTRE LE MONTANT, et le montant valide est de METTRE MONTANT VALIDE',0,1, 'L');

$pdf->Output();