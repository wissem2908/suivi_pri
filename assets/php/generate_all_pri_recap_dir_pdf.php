<?php
require_once('../TCPDF-main/tcpdf.php');
require_once('config.php');

$ids = json_decode($_POST['ids'][0] ?? '[]', true);

if (empty($ids)) {
    die("Aucun ID fourni.");
}

try {
    $bdd = new PDO(
        "mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=utf8",
        DB_USER,
        DB_PASS,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
} catch (Exception $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

$pdf = new TCPDF();
$pdf->AddPage();
$pdf->SetFont('dejavusans', '', 12);

// ===== Header =====
$pdf->SetXY(0, 20);
$pdf->MultiCell(0, 6, 
    "الجمهورية الجزائرية الديمقراطية الشعبية\nRépublique Algérienne Démocratique Populaire\nوزارة السكن والعمران\nMinistère de l'Habitat et de l'Urbanisme", 
    0, 'C', false);
$pdf->Image('../images/logo.jpg', 15, 45, 30);
$pdf->SetFont('dejavusans', '', 9);
$pdf->SetXY(20, 65);
$pdf->MultiCell(80, 6, "Direction administration et des finances.\nSection paie.", 0, 'L', false);
$pdf->SetFont('dejavusans', '', 14);
$pdf->SetXY(140, 50);
$pdf->setRTL(true);
$pdf->MultiCell(100, 6, "الوكالة الوطنية للتعمير\nAGENCE NATIONALE DE L'URBANISME", 0, 'R', false);
$pdf->setRTL(false);
$pdf->SetY(85);

$pdf->SetFont('dejavusans', 'B', 12);
$pdf->Cell(0, 10, 'Fiche de Notation P.R.I', 0, 1, 'C');
$pdf->Ln(2);
$pdf->SetFont('dejavusans', '', 10);
$pdf->Ln(2);

// Month names
$frenchMonths = [
    '01' => 'Janvier', '02' => 'Février', '03' => 'Mars', '04' => 'Avril',
    '05' => 'Mai', '06' => 'Juin', '07' => 'Juillet', '08' => 'Août',
    '09' => 'Septembre', '10' => 'Octobre', '11' => 'Novembre', '12' => 'Décembre'
];

$firstPeriodDisplayed = false;
$firstDirDisplayed = false;
$html = '
<h3 align="center">Tableau récapitulatif des employés notés</h3>
<table border="1" cellpadding="5" cellspacing="0" style="width:100%;">
<thead style="background-color:#f2f2f2;">
    <tr style="text-align:center">
        <th>Nom</th>
        <th>Prénom</th>
        <th>Fonction</th>
        <th>Total</th>
    </tr>
</thead>
<tbody>
';

// Fetch and insert rows
foreach ($ids as $id_pri) {
    $stmt = $bdd->prepare("SELECT e.nom, e.prenom, p.name AS poste, d.name AS direction, d.id_dir as dir, pr.period, pr.respect_objectif, pr.qualite_travail, pr.organisation, pr.disponibilite, pr.total 
        FROM pri pr 
        JOIN employee e ON pr.id_employee = e.employee_id 
        JOIN poste p ON e.poste = p.id_poste 
        JOIN direction d ON e.dir = d.id_dir 
        WHERE pr.id_pri = :id_pri");
    $stmt->execute(['id_pri' => $id_pri]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$data) continue;

    if (!$firstPeriodDisplayed) {
        list($month, $year) = explode('-', $data['period']);
        $formattedPeriod = $frenchMonths[$month] . ' ' . $year;
        $pdf->Cell(0, 7, 'Mois de : ' . $formattedPeriod, 0, 1, 'C');
        $pdf->Ln(4);
        $firstPeriodDisplayed = true;
    }

        if (!$firstDirDisplayed) {
   
         $pdf->Cell(100, 6, 'Affectation : ' . $data['direction'], 0, 1, 'L');
    $pdf->Ln(5);
        $firstDirDisplayed = true;
    }
 

    $html .= '<tr  style="text-align:center">
        <td>' . htmlspecialchars($data['nom']) . '</td>
        <td>' . htmlspecialchars($data['prenom']) . '</td>
        <td>' . htmlspecialchars($data['poste']) . '</td>
        <td><b>' . $data['total'] . '</b></td>
    </tr>';
}

$html .= '</tbody></table>';

// Output table
$pdf->writeHTML($html, true, false, true, false, '');

// Footer signature
$pdf->Ln(0);
$pdf->Cell(0,10, 'Signature du Responsable Hiérarchique', 0, 1, 'R');

    
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
$y2 = 243;
$width2 = 65;

if (file_exists($signaturePath2)) {
    $pdf->Image($signaturePath2, $x2, $y2, $width2);
} else {
    error_log("Image non trouvée : $signaturePath2");
}
}

// Output PDF
$pdf->Output("PRI_RECAP.pdf", 'I');
