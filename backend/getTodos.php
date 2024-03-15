<?php
include('connection.php');

$user_id = $_GET['user_id'];
$query = $mysqli->prepare('select id, todo, is_completed from todos where user_id = ?');
$query->bind_param('i', $user_id);
$query->execute();
$query->store_result();
$num_rows = $query->num_rows();

if ($num_rows == 0) {
    $response['status'] = 'no todos';
} else {
    $query->bind_result($id, $todo, $is_completed);
    $todos = [];
    while ($query->fetch()) {
        $toDo =[
            'id' => $id,
            'todo' => $todo,
            'is_completed' => $is_completed,
            'user_id' => $user_id
        ];
    $todos[] = $toDo;
}
}

$response['status'] = "success";
$response['todos'] = $todos;

echo json_encode($response);