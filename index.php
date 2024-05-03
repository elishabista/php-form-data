<?php ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <style>
    .error {
      color: red;
      margin-top: 4px;
    }

    .success {
      color: green;
      margin-top: 4px;
    }
  </style>
</head>

<body >
  <div class="d-flex justify-content-center align-items-center  vh-100"> 

  <form method="post" id="submitBtn"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
  <div class="card" style="width: 32rem;">
    <div class="card-body">
    <h3 class="card-title">Php Form</h3>

    <div class="mb-3">
      <label for="exampleInputName" class="form-label">Name:</label>

      <input type="text" name="name" class="form-control" id="exampleInputName" />
    </div>

    <div class="mb-3">
    <label for="exampleInputEmail" class="form-label">Email: </label>

      <input type="email" name="email" class="form-control" id="exampleInputEmail"/>
    </div>
    <div class="mb-3">
    <label for="exampleInputPhone" class="form-label"> Phone Number:</label>

     <input type="number" name="phone" class="form-control" id="exampleInputPhone" />
    </div>

    <div class="mb-3">
    <label for="exampleInputAddress" class="form-label">  Address: </label>

    <input type="text" name="address" class="form-control" id="exampleInputAddress"/>
    </div>

    <div class="mb-3">
    <label for="exampleInputMessage" class="form-label">Message:</label>

      <textarea name="message" rows="4" columns="10" class="form-control" id="exampleInputMessage"></textarea>
    </div>

    <button type="submit" class="btn btn-primary w-100" name="submit">Submit</button>

    <!-- <input type="submit" name="submit" value="Submit"> -->
  </div>
    </div>
  </form>
  </div>

  
  <div id="response"></div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

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
          url: 'formOop.php',
          data: $formData,
          success: function(response) {
            if (response.success) {
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