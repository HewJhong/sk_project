<?php require_once 'authController.php' ?>
<!DOCTYPE html>
<html>
<head>
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