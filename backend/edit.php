<?php
include('connection.php');

$user_id = $_POST['user_id'];
$todo = $_POST['todo'];
$is_completed = $_POST['is_completed'];

$query = $mysqli->prepare('update todos
                            set todo = ?, is_completed = ?
                            where user_id = ?');
$query -> bind_param('sii', $todo, $is_completed, $user_id);
$query -> execute();
$num_rows = $query -> num_rows();

if ($query->affected_rows > 0) {
    $response['status'] = "Todo updated successfully";
} else {
    $response['status'] = "Failed to edit todo";
}

echo json_encode($response);