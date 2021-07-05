<?php require_once 'authController.php' ?>
<!DOCTYPE html>
<html>
<head>
  <div class='text-center' style='margin-top: 20px;'><h2>Senarai Kuiz</h2></div>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
  integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" 
  crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="styles.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" 
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" 
  crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" 
  integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" 
  crossorigin="anonymous"></script>
  <script src="changepage.js"></script>
  </head>
<script>
  $(document).ready(function() {
    $.ajax({
      type: "GET",
      url: "studentkuizlistdb.php",
      dataType: "html",
      success: function(response) {
        $("#responsecontainer").html(response);
      }
    });
  });
  $(document).on('click', '.edit-soal-btn', function() {
    var id = this.id;
    $.ajax({
      type: "POST",
      url: "authController.php",
      data: {'id':id},
      success: function(response) {
        studentjawabkuiz();
      }
    });
  });
</script>

<div class="quiz-form-div" id="responsecontainer"></div>

</html>