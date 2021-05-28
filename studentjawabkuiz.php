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
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" 
  integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" 
  crossorigin="anonymous"></script>
  <script src="changepage.js"></script>
  </head>
<script>
  $(document).ready(function() {
    $('#jawabkuizform').submit(function(){
        return false;
    });
    $.ajax({
      type: "GET",
      url: "studentjawabkuizdb.php",
      dataType: "html",
      success: function(response) {
        $("#jawabkuizform").html(response);
      }
    }); 
  });
  $(document).off().on('click', '#submit-jawab-kuiz-btn', function() {
    var count = $('.soalcontainer').length
    var obj = $("#jawabkuizform").serializeArray();
    $.ajax({
      url: 'studentkuizprocessdb.php',
      type: 'POST',
      data: {data: obj, count: count},
      success: function(result){
        console.log(count);
        console.log(result);
        if (result == "errorNoAns") {
          $('#warningModel').modal('show');
        } else {
          studentresult();
        }
      }
    });
  });
</script>
<div class="modal fade" id="warningModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Warning</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Sila jawab semua soalan...
      </div>
    </div>
  </div>
</div>
<div class="quiz-form-div">
<form id="jawabkuizform">
</form>
</div>
</html>