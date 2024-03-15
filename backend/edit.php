<?php
include('connection.php');

$todo = $_POST['todo'];
$todo_id = $_POST['todo_id'];
$is_completed = $_POST['is_completed'];

$check_todo = $mysqli->prepare('select id from todos where id = ?');
$check_todo->bind_param('i', $todo_id);
$check_todo->execute();
$check_todo->store_result();

if ($check_todo->num_rows > 0) {
    $query = $mysqli->prepare('update todos
                            set todo = ?, is_completed = ?
                            where id = ?');
    $query -> bind_param('sii', $todo, $is_completed, $todo_id);
    $query -> execute();

    if ($query->affected_rows > 0) {
        $response['status'] = "Todo updated successfully";
    } else {
        $response['status'] = "Failed to edit todo";
    }
} else {
    $response['status'] = "Todo not found";
}

echo json_encode($response);