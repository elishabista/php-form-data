<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "test";

$message_error = '';

if($_SERVER["REQUEST_METHOD"] == "POST"){

// $name = $_POST['name']; 
$email = $_POST["email"];
$phone = $_POST["phone"];
$address = $_POST["address"];
$message = $_POST["message"];
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if (empty($_POST["name"])) {
        $name_error = "Please Enter Name";
    } else {
        $name = test_input($_POST["name"]);
    }
        $email = $_POST["email"];
    $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
    if (!preg_match($pattern, $email)) {
        $email_error = "Please Enter a Valid Email Address";
    } else {
        $email = test_input($_POST["email"]);
    }
    if (empty($_POST["phone"])) {
        $phone_error = "Please Enter Phone Number";
    } else{
        $number = test_input($_POST["phone"]);
        $numberPattern = '/^[0-9]{10}$/';
        if (!preg_match($numberPattern, $number)) {
            $phone_error = "Please Enter a Valid Phone Number";
        }
    }
    if (empty($_POST["address"])) {
        $address_error = "Please Enter address";
    } else {
        $address = test_input($_POST["address"]);
    }
    if (empty($_POST["message"])) {
        $message_error = "Please Enter message";
    } else {
        $message = test_input($_POST["message"]);
    }
    

$conn= new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){
    die('Connection Failed : '. $conn->connect_error);
}
else{
    $stmt = $conn->prepare("insert into registration(name,email,phone,address,message) values(?,?,?,?,?)");
    $stmt->bind_param("ssiss",$name,$email,$phone,$address,$message);
    $stmt->execute();
    $stmt->close();
    $conn->close();

}
}

echo empty($message_error) ? 'Success' : $message_error;
?>
