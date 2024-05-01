<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script >
        $(document).ready(function(){
            $('#submitBtn').click(function(e){
              console.log('Clicked')
                e.preventDefault();
                // var name = $('#name').val();
                // var email = $('#email').val();
                // var phone = $('#phone').val();
                // var address = $('#address').val();
                // var message = $('#message').val();

                // $.ajax({
                //     type: 'POST',
                //     url: 'form.php',
                //     data: {name: name, email: email, phone: phone, address: address, message: message},
                //     success: function(response){
                //         $('#response').html(response);
                //     }
                // });
            });
        });
    </script>

  <style>
    .error{
      color:red;
      margin-top: 4px;
    }
  </style>
</head>

<body>
  <h1>Php Form</h1>
  <?php include 'form.php' ?>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
    Name: <input type="text" name="name" />
    <div class="error"><?php  if(isset($name_error)) echo  $name_error;?></div>
    <br />
    <br />
    Email: <input type="email" name="email" />
    <div class="error"><?php if(isset($email_error))  echo  $email_error;?></div>
    <br />
    <br />
    Phone Number: <input type="number" name="phone" />
    <div class="error"><?php if(isset($phone_error))  echo  $phone_error;?></div>

    <br />
    <br />
    Address: <input type="text" name="address" />
    <div class="error">
      <?php if(isset($address_error))   echo $address_error;?></div>
    <br />
    <br />
    Message: <textarea name="message" rows="4" columns="10"></textarea>
    <div class="error"><?php echo $message_error;?></div>
    <br />
    <br />
    <input type="submit" name="submit" value="Submit">  

  </form>
  <div id="response"></div>

  <?php 
  echo $name;
  echo "<br>";
  echo $email;
  echo "<br>";
  echo $phone;
  echo "<br>";
  echo $address;
  echo "<br>";
  echo $message;
  echo "<br>";

  ?>
</body>

</html>