<?php ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <style>
    .error {
      color: red;
      margin-top: 4px;
    }
    .success{
      color:green;
      margin-top:4px;
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
   <input type="submit" name="submit" value="Submit" class="p-5">

  </form>
  <div id="response"></div>
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->

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
            $('#response').html('<div class="success">Form Submitted successfully.</div>')
          }
          },
          error: function(xhr, status, error) {
            $('.error').remove();
            var response = xhr.responseJSON;



            $.each(response.errors, function(fieldName, errorMessage) {

              var $inputField = fieldName === "message" ? $inputField = $('textarea[name="' + fieldName + '"]') :
                $('input[name="' + fieldName + '"]');


              $('<div class="error">' + errorMessage + '</div>').insertAfter($inputField);
              $('#response').html('<div class="error">Form Failed.</div>')
            });
          }




        });
      });
    });
  </script>
</body>

</html>