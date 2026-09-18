<?php 
include 'initialize.php';

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 5; // Records per page
$offset = ($page - 1) * $limit;

// Get total records for pagination math
$total_result = $connection->query("SELECT COUNT(*) as count FROM users");
$total_row = $total_result->fetch_assoc();
$total_pages = ceil($total_row['count'] / $limit);

// Fetch data
$sql = "SELECT id, firstname, lastname, username FROM users LIMIT $limit OFFSET $offset";
$result = $connection->query($sql);

$users = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode([
    'users' => $users,
    'totalPages' => $total_pages,
    'currentPage' => $page
]);
?>