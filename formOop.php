<?php
header('Content-Type: application/json; charset=utf-8');

class FormHandler
{


    public $servername = "localhost";
    public $username = "root";
    public $password = "root";
    public $dbname = "test";

    public $message_error = '';
    public $errors = [];

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function DatabaseConnection($name, $email, $phone, $address, $message)
    {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
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
    //  public function ValidaitionName(){

    //  }
    public function ValidationName($name, &$errors)
    {
        if (empty($name)) {
            $name_error = "Please Enter Name";
            $errors['name'] = $name_error;
        } else {
            $name = $this->test_input($_POST["name"]);
        }
    }
    public function ValidationEmail($email, &$errors)
    {
        $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
        if (!preg_match($pattern, $email)) {
            $email_error = "Please Enter a Valid Email Address";
            $errors['email'] = $email_error;
        } else {
            $email = $this->test_input($_POST["email"]);
        }
    }
    public function ValidationPhone($phone, &$errors)
    {

        if (empty($phone)) {
            $phone_error = "Please Enter Phone Number";
            $errors['phone'] = $phone_error;
        } else {
            $number = $this->test_input($_POST["phone"]);
            $numberPattern = '/^[0-9]{10}$/';
            if (!preg_match($numberPattern, $number)) {
                $phone_error = "Please Enter a Valid Phone Number";
                $errors['phone'] = $phone_error;
            }
        }
    }
    public function ValidationAddress($address, &$errors)
    {
        if (empty($address)) {
            $address_error = "Please Enter address";
            $errors['address'] = $address_error;
        } else {
            $address = $this->test_input($_POST["address"]);
        }
    }
    public function ValidationMessage($message, &$errors)
    {
        if (empty($message)) {
            $message_error = "Please Enter message";
            $errors['message'] = $message_error;
        } else {
            $message = $this->test_input($_POST["message"]);
        }
    }

    public function FormHandleSubmission()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $email = $_POST["email"];
            // var_dump($email);
            $phone = $_POST["phone"];
            $address = $_POST["address"];
            $message = $_POST["message"];
        

            $this->ValidationName($name, $errors);
            $this->ValidationEmail($email, $errors);
            $this->ValidationPhone($phone, $errors);
            $this->ValidationAddress($address, $errors);
            $this->ValidationMessage($message, $errors);
            if (empty($errors)) {

                $this->DatabaseConnection($name, $email, $phone, $address, $message);
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
    }
}
$form = new FormHandler();
$form->FormHandleSubmission();
