<?php
include('connection.php');

$user_id = $_POST['user_id'];
$todo_id = $_POST['todo_id'];

$check_todo = $mysqli->prepare('select id from todos where id = ?');
$check_todo->bind_param('i', $todo_id);
$check_todo->execute();
$check_todo->store_result();

$check_user = $mysqli->prepare('select id from users where id = ?');
$check_user->bind_param('i', $user_id);
$check_user->execute();
$check_user->store_result();

if ($check_todo->num_rows > 0 && $check_user->num_rows > 0) {
    $query = $mysqli->prepare('delete from todos where id = ?');
    $query -> bind_param('i', $todo_id);
    $query -> execute();

    if ($query->affected_rows > 0) {
        $response['status'] = "Todo deleted successfully";
    } else {
        $response['status'] = "Failed to delete todo";
    }
} else {
    $response['status'] = "Todo not found";
}

echo json_encode($response);