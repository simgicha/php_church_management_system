<?php
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'church';
//connect with the database
$db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
//get search term
$searchTerm = $_GET['term'];
//get matched data from skills table
$query = $db->query("SELECT m.*, l.name as l_name FROM members m, local_church l WHERE m.local_church = l.id AND m.name LIKE '%".$searchTerm."%' ORDER BY m.name ASC");
while ($row = $query->fetch_assoc()) {
    $data[] = $row['name'];
}
//return json data
echo json_encode($data);
?>