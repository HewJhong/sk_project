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
    });
  });
  $(document).on('click', '.delete-soal-btn', function() {
      var id = this.id;
      $clicked_btn = $(this);

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
          $clicked_btn.closest('.row').remove();
        }
      });
      });
    });
    $(document).on('click', '.edit-soal-btn', function() {
      var nosoal = this.id;
      $.ajax({
        url: 'editkuiz.php',
        method: 'POST',
        data: {'nosoal':nosoal},
        dataType: 'json',
        success: function(data){
          console.log(data);
          $('#soalan').val(data.soal);
          $('#pilih1').val(data.pilih1);
          $('#pilih2').val(data.pilih2);
          $('#pilih3').val(data.pilih3);
          $('#pilih4').val(data.pilih4);
          $("#checkbox1").prop("checked", data.checkbox1);
          $("#checkbox2").prop("checked", data.checkbox2);
          $("#checkbox3").prop("checked", data.checkbox3);
          $("#checkbox4").prop("checked", data.checkbox4);
          $('#edit-soal').modal('show');
        }
      });
        $(document).on('click', '.edit-soal', function() {
        var soal = $("#soalan").val();
        var pilih1 = $("#pilih1").val();
        var pilih2 = $("#pilih2").val();
        var pilih3 = $("#pilih3").val();
        var pilih4 = $("#pilih4").val();
        var checkbox1 = $("#checkbox1").prop("checked")
        var checkbox2 = $("#checkbox2").prop("checked")
        var checkbox3 = $("#checkbox3").prop("checked")
        var checkbox4 = $("#checkbox4").prop("checked")
        $.ajax ({
          method: "POST",
          url: "updatekuiz.php",
          data: {
            'nosoal':nosoal,
            'soal':soal,
            'pilih1':pilih1,
            'pilih2':pilih2,
            'pilih3':pilih3,
            'pilih4':pilih4,
            'checkbox1':checkbox1,
            'checkbox2':checkbox2,
            'checkbox3':checkbox3,
            'checkbox4':checkbox4,
            },
            success:function(data){
              console.log(data);
              alert("Success");
            }
        });
      });
    });
    
</script>
<div class='modal fade' id='edit-soal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
      <div class='modal-content'>
        <div class='modal-header'>
          <h5 class='modal-title' id='exampleModalLabel'>Ubah Soalan</h5>
          <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class='modal-body'>
        <form method="post" id="addquizform" action="kuizdb.php">
        <div class="form-group">
              <label for="soal">Soalan</label>
              <input type="text" id='soalan' name="psoal[]" class="form-control form-control-lg" autocomplete="off" required >
        </div>
          <div class="form-group">
              <label for="jaw">Jawapan</label>
              <div class="form-check">
                  <input id="checkbox1" type="radio" class="form-check-input" name="pilihradio1" id="pilihradio" value="A">
                      <div class="form-group">
                          <input id="pilih1" type="text" name="ppilih[]" class="form-control form-control-lg" autocomplete="off" required>
                      </div>
              </div>
              <div class="form-check">
                  <input id="checkbox2" type="radio" class="form-check-input" name="pilihradio1" id="pilihradio" value="B">
                      <div class="form-group">
                          <input id="pilih2" type="text" name="ppilih[]" class="form-control form-control-lg" autocomplete="off" required>
                      </div>
              </div>
              <div class="form-check">
                  <input id="checkbox3" type="radio" class="form-check-input" name="pilihradio1" id="pilihradio" value="C">
                      <div class="form-group">
                          <input id="pilih3" type="text" name="ppilih[]" class="form-control form-control-lg" autocomplete="off" required>
                      </div>
              </div>
              <div class="form-check">
                  <input id="checkbox4" type="radio" class="form-check-input" name="pilihradio1" id="pilihradio" value="D">
                      <div class="form-group">
                          <input id="pilih4" type="text" name="ppilih[]" class="form-control form-control-lg" autocomplete="off" required>
                      </div>
              </div>
          </div>
        </form>
        </div>
        <div class='modal-footer'>
          <button type='button' class='btn btn-secondary' data-dismiss='modal'>Tidak</button>
          <button type='button' class='btn btn-primary edit-soal' data-dismiss='modal' id='confirm-btn'>Ya, teruskan</button>
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
<div class="quiz-form-div" id="responsecontainer">
</div>
<div id="results"></div>
</body>
</html>