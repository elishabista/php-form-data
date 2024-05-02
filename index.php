<?php ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <style>
    .error {
      color: red;
      margin-top: 4px;
    }
  </style>
</head>

<body>
  <h1>Php Form</h1>
  <form method="post" id="submitBtn" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Name: <input type="text" name="name" />
    <br />
    <br />
    Email: <input type="email" name="email" />
    <br />
    <br />
    Phone Number: <input type="number" name="phone" />

    <br />
    <br />
    Address: <input type="text" name="address" />

    <br />
    <br />
    Message: <textarea name="message" rows="4" columns="10"></textarea>

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
  <script>
    $(document).ready(function() {
      $('#submitBtn').on('submit', function(e) {
        e.preventDefault();

        // Perform client-side validation
        var name = $('input[name=name]').val();
        var email = $('input[name=email]').val();
        var phone = $('input[name=phone]').val();
        var address = $('input[name=address]').val();
        var message = $('textarea[name=message]').val();

        var $formData = $(this).serializeArray();



        
        $.ajax({
          type: 'POST',
          url: 'form.php',
          data: $formData,
          success: function(response) {
            if(response.success){
            $('#submitBtn')[0].reset();
            $('.error').remove();
          }
          },
          error: function(xhr, status, error) {
            $('.error').remove();
            var response = xhr.responseJSON;



            $.each(response.errors, function(fieldName, errorMessage) {

              var $inputField = fieldName === "message" ? $inputField = $('textarea[name="' + fieldName + '"]') :
                $('input[name="' + fieldName + '"]');


              $('<div class="error">' + errorMessage + '</div>').insertAfter($inputField);
            });
          }




        });
      });
    });
  </script>
</body>

</html>