<?php
require_once("../config/db.php");
header('Content-Type: application/json');

$sql = "SELECT id, CONCAT(data_programare, 'T', ora_programare) AS start,
               CONCAT(nume, ' ', prenume, ' - dr. ', medic) AS title,
               telefon, email, detalii
        FROM programari
        WHERE status = 'confirmata'";

$result = $conn->query($sql);
$evenimente = [];

while ($row = $result->fetch_assoc()) {
    $evenimente[] = [
        "id" => $row["id"],
        "start" => $row["start"],
        "title" => $row["title"],
        "extendedProps" => [
            "telefon" => $row["telefon"],
            "email" => $row["email"],
            "detalii" => $row["detalii"]
        ]
    ];
}

echo json_encode($evenimente);
?>
