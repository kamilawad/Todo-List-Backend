<?php
include('connection.php');

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

$check_email = $mysqli->prepare('select email from users where email=?');
$check_email->bind_param('s', $email);
$check_email->execute();
$check_email->store_result();
$email_exists = $check_email->num_rows();


if ($email_exists == 0) {
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $query = $mysqli->prepare('insert into users(username,password,email) values(?,?,?);');
    $query->bind_param('sss', $username, $hashed_password, $email);
    $query->execute();
    $response['status'] = "success";
    $response['message'] = "user $username was created successfully";
} else {
    $response["status"] = "user already exists";
    $response["message"] = "user $username wasn't created";
}
echo json_encode($response);