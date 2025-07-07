<?php
require_once('../TCPDF-main/tcpdf.php');
require_once('config.php');
$ids = json_decode($_POST['ids'][0] ?? '[]', true); // Receive as array
//$ids = $_POST['ids'] ?? [];

if (empty($ids)) {
    die("Aucun ID fourni.");
}

try {
    $bdd = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

$pdf = new TCPDF();
$pdf->SetFont('dejavusans', '', 10);

// Month labels
$frenchMonths = [
    '01' => 'Janvier', '02' => 'Février', '03' => 'Mars', '04' => 'Avril',
    '05' => 'Mai', '06' => 'Juin', '07' => 'Juillet', '08' => 'Août',
    '09' => 'Septembre', '10' => 'Octobre', '11' => 'Novembre', '12' => 'Décembre'
];

foreach ($ids as $id_pri) {
    $stmt = $bdd->prepare("SELECT e.nom, e.prenom, p.name AS poste, d.name AS direction , d.id_dir as dir , pr.period, pr.respect_objectif, pr.qualite_travail, pr.organisation, pr.disponibilite, pr.total FROM pri pr JOIN employee e ON pr.id_employee = e.employee_id JOIN poste p ON e.poste = p.id_poste JOIN direction d ON e.dir = d.id_dir WHERE pr.id_pri = :id_pri");
    $stmt->execute(['id_pri' => $id_pri]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$data) continue;

    list($month, $year) = explode('-', $data['period']);
    $formattedPeriod = $frenchMonths[$month] . ' ' . $year;

    $pdf->AddPage();
    $pdf->SetFont('dejavusans', '', 12);

    // Header
    $pdf->SetXY(0, 20);
    $pdf->MultiCell(0, 6, "الجمهورية الجزائرية الديمقراطية الشعبية\nRépublique Algérienne Démocratique Populaire\nوزارة السكن والعمران\nMinistère de l'Habitat et de l'Urbanisme", 0, 'C', false);
    $pdf->SetXY(140, 45);
    // ===== Insert Logo on Top-Left =====

// ===== Right-aligned Agency Name =====

// ===== Insert Logo on Left near 45mm from top =====
$pdf->Image(
    '../images/logo.jpg', // Converted JPG path
    15,     // X position (left side)
    45,     // Y position (aligned with text below)
    30      // Width in mm
);
$pdf->SetFont('dejavusans', '', 9); // Set smaller font
$pdf->SetXY(20, 65); // X = same as image, Y = image Y + height + spacing
$pdf->MultiCell(
    80,                // Width
    6,                 // Line height
    "Direction administration et des finances.\nSection paie.", 
    0,                 // No border
    'L',               // Align left
    false
);
$pdf->SetFont('dejavusans', '', 14); // Set smaller font
// ===== Right-aligned Agency Name =====
$pdf->SetXY(140, 50); // X right side, Y aligned with image
$pdf->setRTL(true);
$pdf->MultiCell(
    100,               // Width
    6,
    "الوكالة الوطنية للتعمير\nAGENCE NATIONALE DE L'URBANISME",
    0,
    'R',
    false
);
$pdf->setRTL(false); // Reset RTL
$pdf->SetY(85); // Push Y down to leave space after logo/text block
$pdf->Ln(2);
$pdf->Ln(2);
$pdf->Ln(6);
$pdf->SetFont('dejavusans', 'B', 12);
$pdf->Cell(0, 10, 'Fiche de Notation P.R.I', 0, 1, 'C');
$pdf->SetFont('dejavusans', '', 10);
$pdf->Ln(2);


    $pdf->Cell(0, 7, 'Mois de : ' . $formattedPeriod, 0, 1, 'C');
    $pdf->Ln(2);

    $pdf->SetFont('dejavusans', '', 11);
    $pdf->Cell(60, 6, 'Nom : ' . $data['nom'], 0, 0, 'L');
    $pdf->Cell(60, 6, 'Prénom : ' . $data['prenom'], 0, 1, 'L');
    $pdf->Cell(100, 6, 'Fonction : ' . $data['poste'], 0, 1, 'L');
    $pdf->Cell(100, 6, 'Affectation : ' . $data['direction'], 0, 1, 'L');
    $pdf->Ln(5);

    $pdf->SetFont('dejavusans', '', 10);
    $html = '

<table border="1" cellpadding="5" cellspacing="0" style="width:100%;" align="center">
    <tr>
        <th width="25%">Appréciation Critères</th>
        <th width="12%">Excellent</th>
        <th width="12%">Bien</th>
        <th width="13%">Satisfaisant</th>
        <th width="12%">Médiocre</th>
        <th width="12%">Null</th>
        <th width="14%">Notation</th>
    </tr>
    <tr>
        <td>Respect des Objectifs et délais</td>
        <td>06</td><td>05</td><td>03</td><td>01</td><td>00</td>
        <td>' . $data['respect_objectif'] . '</td>
    </tr>
    <tr>
        <td>Qualité de Travail</td>
        <td>06</td><td>05</td><td>03</td><td>01</td><td>00</td>
        <td>' . $data['qualite_travail'] . '</td>
    </tr>
    <tr>
        <td>Organisation et Esprit d\'initiative</td>
        <td>04</td><td>03</td><td>02</td><td>01</td><td>00</td>
        <td>' . $data['organisation'] . '</td>
    </tr>
    <tr>
        <td>Disponibilité / Discipline générale</td>
        <td>04</td><td>03</td><td>02</td><td>01</td><td>00</td>
        <td>' . $data['disponibilite'] . '</td>
    </tr>
    <tr>
        <td colspan="6" align="center"><b>TOTAL :</b></td>
        <td><b>' . $data['total'] . ' / 20</b></td>
    </tr>
</table>';

    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Ln(15);
    $pdf->Cell(0, 10, 'Signature du Responsable Hiérarchique', 0, 1, 'R');

    
$signaturePath = '../images/cachet_rond_daf.png';
$x = 140; // distance from left
$y = 70; // vertical position
$width = 45;

if (!file_exists($signaturePath)) {
    die("Fichier image introuvable : $signaturePath");
}
$pdf->Image($signaturePath, $x, $y, $width);


if($data['dir']==3){
// === Deuxième image (signature DRSIG) ===
$signaturePath2 = '../images/Signature_DRSIG.png';
$x2 = 130;
$y2 = 235;
$width2 = 65;

if (file_exists($signaturePath2)) {
    $pdf->Image($signaturePath2, $x2, $y2, $width2);
} else {
    error_log("Image non trouvée : $signaturePath2");
}
}
}


$pdf->Output("Tous_les_PRI.pdf", 'I');
