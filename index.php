<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <style>
    .error{
      color:red;
      margin-top: 4px;
    }
  </style>
</head>

<body>
  <h1>Php Form</h1>
  <form method="post" id="submitBtn" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
    Name: <input type="text" name="name" />
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
    <input type="submit" name="submit" value="Submit" >  

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
    <script>
  $(document).ready(function(){
    $('#submitBtn').on('submit',function(e){
      e.preventDefault();

      // Perform client-side validation
      var name = $('#name').val();
      var email = $('#email').val();
      var phone = $('#phone').val();
      var address = $('#address').val();
      var message = $('#message').val();
      var isValid = true;

      if (name?.trim() === '') {
        $('#name-error').text('Please enter a name');
        isValid = false;
      } else {
        $('#name-error').text('');
      }

      // Add similar checks for other fields...

      // If any field is invalid, prevent form submission
      if (!isValid) {
        return;
      }

      // If all fields are valid, proceed with AJAX form submission
      $.ajax({
        type: 'POST',
        url: 'form.php',
        data: {name: name, email: email, phone: phone, address: address, message: message},
        success: function(response){
          // console.log(response);
          if ('Success' !== response) {
            console.log(response.trim());
            switch (response.trim()) {
              case 'Please Enter message':
                console.log('asdfsdf');
                console.log($('input[name="name"]'));
                $(`<div class="error">${response}</div>`).insertAfter($('input[name="name"]'))
                break;
            }
            return;
          } 
          // $('#response').html(response);
          // You can optionally clear the form fields here
          $('#name').val('');
          $('#email').val('');
          $('#phone').val('');
          $('#address').val('');
          $('#message').val('');
        }
      });
    });
  });
</script>
</body>

</html>