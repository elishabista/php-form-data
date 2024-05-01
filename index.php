<?php ?>
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
     console.log('clicked')
      // Perform client-side validation
      var name = $('input[name=name]').val();
        var email = $('input[name=email]').val();
        var phone = $('input[name=phone]').val();
        var address = $('input[name=address]').val();
        var message = $('textarea[name=message]').val();

        var $formData = $(this).serializeArray();

    

      // If all fields are valid, proceed with AJAX form submission
      $.ajax({
        type: 'POST',
        url: 'form.php',
        data: $formData,
        success: function(response){
         alert(response);
          console.log(response);
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
        },
        error: function(xhr, status, error) {
          var response = xhr.responseJSON;
          alert(response?.errors)
          console.log('......');
          console.log(response.errors.name);
          console.log('////////');
      
      

        

    }

    

      });
    });
  });
</script>
</body>

</html>