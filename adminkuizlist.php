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
  $(document).on('click', '.delete-soal-btn', function() {
      var id = this.id
      $clicked_btn = $(this);
      // $(this).closest('.row').remove();
      $(document).on('click', '.delete-soal', function() {
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
    });
</script>
<div class='modal fade' id='edit-soal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
      <div class='modal-content'>
        <div class='modal-header'>
          <h5 class='modal-title' id='exampleModalLabel'>Warning</h5>
          <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class='modal-body'>
          Edit
        </div>
        <div class='modal-footer'>
          <button type='button' class='btn btn-secondary' data-dismiss='modal'>Tidak</button>
          <button type='button' class='btn btn-primary edit-soal' data-dismiss='modal' id='".$nosoal."'>Ya, teruskan</button>
        </div>
      </div>
    </div>
  </div>
<div class='modal fade' id='confirmationmodal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
      <div class='modal-content'>
        <div class='modal-header'>
          <h5 class='modal-title' id='exampleModalLabel'>Warning</h5>
          <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class='modal-body'>
          Hapuskan Soalan Ini?
        </div>
        <div class='modal-footer'>
          <button type='button' class='btn btn-secondary' data-dismiss='modal'>Tidak</button>
          <button type='button' class='btn btn-primary delete-soal' data-dismiss='modal' id='".$nosoal."'>Ya, teruskan</button>
        </div>
      </div>
    </div>
  </div>
<div id="responsecontainer">
</div>
<div id="results"></div>
</body>
</html>