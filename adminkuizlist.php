<?php require_once 'authController.php' ?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
  integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" 
  crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="styles.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" 
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" 
  crossorigin="anonymous"></script>
  <script src="changefile.js"></script>
  </head>
<body>
<script>
  $(document).ready(function() {
    $.ajax({
      type: "GET",
      url: "kuizlistdb.php",
      dataType: "html",
      success: function(response){
        $("#responsecontainer").html(response);
      }
    })
  });
  $(document).on('click', '.delete-soal', function() {
      var id = this.id
      $clicked_btn = $(this);
      $(this).closest('.row').remove();
      $.ajax({
        url: 'authController.php',
        type: 'GET',
        data: {
          'delete': 1,
          'id': id,
        },          
        success: function(result){
          $('#results').append(result);
        }
      });
    });
</script>
<div id="responsecontainer">
</div>
<div id="results"></div>
</body>
</html>