<?php

header('Content-Type: application/json; charset=utf-8');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "test";

$message_error = '';
$errors = [];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
// $name = $_POST['name'];
    $email = $_POST["email"];
    // var_dump($email);
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $message = $_POST["message"];
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if (empty($_POST["name"])) {
        $name_error = "Please Enter Name";
        $errors['name'] = $name_error;
    } else {
        $name = test_input($_POST["name"]);
    }
    $email = $_POST["email"];
    $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
    if (!preg_match($pattern, $email)) {
        $email_error = "Please Enter a Valid Email Address";
        $errors['email'] = $email_error;
    } else {
        $email = test_input($_POST["email"]);
    }
    if (empty($_POST["phone"])) {
        $phone_error = "Please Enter Phone Number";
        $errors['phone'] = $phone_error;
    } else {
        $number = test_input($_POST["phone"]);
        $numberPattern = '/^[0-9]{10}$/';
        if (!preg_match($numberPattern, $number)) {
            $phone_error = "Please Enter a Valid Phone Number";
            $errors['phone'] = $phone_error;
        }
    }
    if (empty($_POST["address"])) {
        $address_error = "Please Enter address";
        $errors['address'] = $address_error;
    } else {
        $address = test_input($_POST["address"]);
    }
    if (empty($_POST["message"])) {
        $message_error = "Please Enter message";
        $errors['message'] = $message_error;
    } else {
        $message = test_input($_POST["message"]);
    }

    
    if (empty($errors)) {
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die('Connection Failed : ' . $conn->connect_error);
        } else {
            $stmt = $conn->prepare("insert into registration(name,email,phone,address,message) values(?,?,?,?,?)");
            $stmt->bind_param("ssiss", $name, $email, $phone, $address, $message);
            $stmt->execute();
            $stmt->close();
            $conn->close();
        }
    }


    $response = [
        'success' => true,
    ];

    if (!empty($errors)) {
        http_response_code(400);
        $response['errors'] = $errors;
        $response['success'] = false;
    } else {
    }

    echo json_encode($response);
    exit();
}
