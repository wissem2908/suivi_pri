<?php

include './config.php';

try {
    // Connection to the database
    $bdd = new PDO(
        "mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=utf8",
        DB_USER,
        DB_PASS,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );

    // Get filters from POST
    $dir_list = $_POST['dir_list'] ?? [];
    $s_dir_list = $_POST['s_dir_list'] ?? [];
    $period_input_raw = $_POST['period_input'] ?? '';

    // Convert YYYY-MM to MM-YYYY
    $period_input = '';
    if (!empty($period_input_raw)) {
        $parts = explode('-', $period_input_raw);
        if (count($parts) === 2) {
            $period_input = $parts[1] . '-' . $parts[0];
        }
    }

    // Base query
    $query = "SELECT * FROM `pri`
              LEFT JOIN employee ON pri.id_employee = employee.employee_id
              LEFT JOIN poste ON employee.poste = poste.id_poste
              WHERE pri.is_active = 0";

    $params = [];

    // Add filters dynamically
    if (!empty($dir_list)) {
        $placeholders = implode(',', array_fill(0, count($dir_list), '?'));
        $query .= " AND employee.dir IN ($placeholders)";
        $params = array_merge($params, $dir_list);
    }

    if (!empty($s_dir_list)) {
        $placeholders = implode(',', array_fill(0, count($s_dir_list), '?'));
        $query .= " AND employee.sous_dir IN ($placeholders)";
        $params = array_merge($params, $s_dir_list);
    }

    if (!empty($period_input)) {
        $query .= " AND pri.period = ?";
        $params[] = $period_input;
    }

    $query .= " ORDER BY id_pri DESC";

    $req = $bdd->prepare($query);
    $req->execute($params);

    $output = [];
    while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
        $output[] = $row;
    }

    echo json_encode($output);

} catch (Exception $e) {
    echo $e->getMessage();
}
