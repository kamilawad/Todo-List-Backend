<?php
include('connection.php');

$user_id = $_POST['user_id'];
$todo = $_POST['todo'];

$check_user = $mysqli->prepare('select id from users where id = ?');
$check_user->bind_param('i', $user_id);
$check_user->execute();
$check_user->store_result();

$query = $mysqli->prepare('insert into todos (todo, user_id) values (?, ?)');
$query->bind_param('si', $todo, $user_id);
$query->execute();

if ($query->affected_rows > 0) {
    $response['status'] = "Todo added successfully";
} else {
    $response['status'] = "Failed to add todo";
}

echo json_encode($response);