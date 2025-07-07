<?php
require_once('../TCPDF-main/tcpdf.php'); // Adjust path if needed
require_once('config.php');

$id_pri = $_GET['id_pri'] ?? null;

if (!$id_pri) {
    die("ID PRI manquant.");
}

try {
    $bdd = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    die("Erreur de connexion : " . $e->getMessage());
}


$stmt = $bdd->prepare("
    SELECT 
        e.nom, e.prenom, p.name AS poste, d.name AS direction, d.id_dir as dir,
        pr.period, pr.respect_objectif, pr.qualite_travail, 
        pr.organisation, pr.disponibilite, pr.total
    FROM pri pr
    JOIN employee e ON pr.id_employee = e.employee_id
    JOIN poste p ON e.poste = p.id_poste
    JOIN direction d ON e.dir = d.id_dir
    WHERE pr.id_pri = :id_pri
");
$stmt->execute(['id_pri' => $id_pri]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    die("Données introuvables.");
}

$pdf = new TCPDF();
$pdf->AddPage();
$pdf->SetFont('times', '', 12);

// ===== Center-aligned main title =====
$pdf->SetFont('dejavusans', '', 12);

// ===== Centered Government Heading =====
$pdf->SetXY(0, 20); // Vertical position
$pdf->MultiCell(
    0,              // Full page width
    6,              // Line height
    "الجمهورية الجزائرية الديمقراطية الشعبية\nRépublique Algérienne Démocratique Populaire\nوزارة السكن والعمران\nMinistère de l'Habitat et de l'Urbanisme",
    0,              // No border
    'C',            // Center aligned
    false           // No fill
);


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


/*************************************************************** */


// Extract month and year
list($month, $year) = explode('-', $data['period']);

// Map month number to French names
$frenchMonths = [
    '01' => 'Janvier',
    '02' => 'Février',
    '03' => 'Mars',
    '04' => 'Avril',
    '05' => 'Mai',
    '06' => 'Juin',
    '07' => 'Juillet',
    '08' => 'Août',
    '09' => 'Septembre',
    '10' => 'Octobre',
    '11' => 'Novembre',
    '12' => 'Décembre',
];

// Format the label
$formattedPeriod = $frenchMonths[$month] . ' ' . $year;

/**************************************************************** */
$pdf->Cell(0, 7, 'Mois de : ' . $formattedPeriod, 0, 1, 'C');

// Personal Info
$pdf->Ln(2);
$pdf->SetFont('dejavusans', '', 11);

// Nom
$pdf->Cell(60, 6, 'Nom : ' . $data['nom'], 0, 0, 'L');

// Add space before Prénom
$pdf->Cell(60, 6, 'Prénom : ' . $data['prenom'], 0, 1, 'L');

// Fonction
$pdf->Cell(100, 6, 'Fonction : ' . $data['poste'], 0, 1, 'L');

// Affectation
$pdf->Cell(100, 6, 'Affectation : ' . $data['direction'], 0, 1, 'L');

// Scores
$pdf->Ln(5);


$pdf->SetFont('dejavusans', '', 10);

// Table header
$html = '
<table border="1" cellpadding="5" align="center">
    <tr>
        <th style="width:25%">Appréciation Critères</th>
        <th style="width:12%">Excellent</th>
        <th style="width:12%">Bien</th>
        <th style="width:13%">Satisfaisant</th>
        <th style="width:12%">Médiocre</th>
        <th style="width:12%">Null</th>
        <th style="width:15%">Notation</th>
    </tr>
    <tr>
        <td>Respect des Objectifs et délais</td>
        <td>06</td>
        <td>05</td>
        <td>03</td>
        <td>01</td>
        <td>00</td>
        <td>' . $data['respect_objectif'] . '</td>
    </tr>
    <tr>
        <td>Qualité de Travail</td>
        <td>06</td>
        <td>05</td>
        <td>03</td>
        <td>01</td>
        <td>00</td>
        <td>' . $data['qualite_travail'] . '</td>
    </tr>
    <tr>
        <td>Organisation et Esprit d\'initiative</td>
        <td>04</td>
        <td>03</td>
        <td>02</td>
        <td>01</td>
        <td>00</td>
        <td>' . $data['organisation'] . '</td>
    </tr>
    <tr>
        <td>Disponibilité/Discipline générale</td>
        <td>04</td>
        <td>03</td>
        <td>02</td>
        <td>01</td>
        <td>00</td>
        <td>' . $data['disponibilite'] . '</td>
    </tr>
    <tr>
        <td colspan="6" align="center"><b>TOTAL :</b></td>
        <td><b>' . $data['total'] . ' / 20</b></td>
    </tr>
</table>
';
$pdf->writeHTML($html, true, false, true, false, '');







// Signature
$pdf->Ln(15);
$pdf->Cell(0, 10, 'Signature du Responsable Hiérarchique', 0, 1, 'R');

// === Première image (cachet rond DAF) ===
$signaturePath1 = '../images/cachet_rond_daf.png';
$x1 = 140;
$y1 = 70;
$width1 = 45;

if (file_exists($signaturePath1)) {
    $pdf->Image($signaturePath1, $x1, $y1, $width1);
} else {
    error_log("Image non trouvée : $signaturePath1");
}


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


$pdf->Output("PRI_{$data['nom']}_{$data['prenom']}.pdf", 'I');