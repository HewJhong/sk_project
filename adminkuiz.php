<?php 
require_once 'authController.php'; 
?>

<!DOCTYPE html>
<html>
    <head>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>  -->
    <script src="changepage.js"></script>
    </head>
    <body>
    <div class='text-center' style='margin-top: 20px;'><h2>Tambah Kuiz Baharu</h2></div>
    <div class="newquiz-container">
        <div class="row"></div>
            <div id="quiz-form-div "class="quiz-form-div" method="post">
                <!-- <form action="adminmain.php" method="post"> -->
                <form method="post" id="addquizform" action="adminkuizdb.php">
                <script>
                    $(document).ready(function(){
                        kuiztitle();
                        $('#addquizform').submit(function(){
                            return false;
                        });

                        $('#quizsubmit-btn').click(function(){
                            $.post(
                                $('#addquizform').attr('action'),
                                $('#addquizform :input').serializeArray(),
                                function(result){
                                    var results = result.split(',');
                                    var unique = [];
                                    $.each(results, function(i, el){
                                        if($.inArray(el, unique) === -1) unique.push(el);
                                    });
                                    $('#result').html(result);
                                    if (result.includes("Question existed")) {
                                        $('#result').html("<div class='alert alert-danger'>Soalan sudah dalam database!</div>")
                                    } else if (result.includes("Sila masukkan Topik")) {
                                        $('#result').html("<div></div>")
                                    } else if (result.includes("Undefined index") || result.includes("Sila masukkan jawapan betul")) {
                                        $('#result').html("<div></div>")
                                    } else {
                                        $('#result').html(result);
                                    }
                                }
                            )
                        })
                    });
                </script>

                    <!-- errors alert box -->
                    <?php if(count($errors) > 0): ?>
                    <div class="alert alert-danger">
                    <?php foreach($errors as $error):?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach;?>
                    </div>
                    <?php endif ?>

                    <div id="result"></div>

                    <div id="container">
                    <div class="form-group">
                        <label for="Topik">Topik</label>
                        <input list="Topik" type="text" name="Topik" class="form-control form-control-lg" required>
                        <datalist id="Topik">
                            <option value="Tambah"></option>
                            <option value="Tolak"></option>
                        </datalist>
                    </div>
                    <div class="soalan">
                    <div class="row">
                    <div class="form-group col-md-10">
                        <label for="NoSoal">No Soalan</label>
                        <p class="NoSoal">1</p>
                    </div>
                    <div class="form-group col-md-2 delete-btn">
                        <button id="delete" type="button" name="delete" class="btn btn-danger btn-block btn-lg">Delete</button>
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="Soal">Soalan</label>
                        <input type="text" name="psoal[]" class="form-control form-control-lg" autocomplete="off" required >
                    </div>
                    <div class="form-group">
                        <label for="Jaw">Jawapan</label>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="pilihradio1" id="pilihradio" value="A" required>
                                <div class="form-group">
                                    <input type="text" name="ppilih[]" class="form-control form-control-lg" autocomplete="off" required>
                                </div>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="pilihradio1" id="pilihradio" value="B" required>
                                <div class="form-group">
                                    <input type="text" name="ppilih[]" class="form-control form-control-lg" autocomplete="off" required>
                                </div>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="pilihradio1" id="pilihradio" value="C" required>
                                <div class="form-group">
                                    <input type="text" name="ppilih[]" class="form-control form-control-lg" autocomplete="off" required>
                                </div>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="pilihradio1" id="pilihradio" value="D" required>
                                <div class="form-group">
                                    <input type="text" name="ppilih[]" class="form-control form-control-lg" autocomplete="off" required>
                                </div>
                        </div>
                    </div>
                    </div>
                    </div>
                    <!-- click to add question button here -->
                    <div class="form-group">
                        <div class="col-19"></div>
                        <button title="Tambah soalan" id="add-btn" onclick="addques()" type="button" name="addQuestion" class="btn btn-primary btn-lg col-1"> + </button>
                    </div>
                    <script>
                    var index = 1;
                    function addques() {
                        index = index + 1;
                        var radio = "pilihradio"+index;
                        $('#container').append(
                        '<div class="soalan">'+
                            '<div class="row">'+
                                '<div class="form-group col-md-10">'+
                                    '<label for="NoSoal">No Soalan</label>'+
                                    '<p class="NoSoal">'+index+'</p>'+
                                '</div>'+
                                '<div class="form-group col-md-2 delete-btn">'+
                                    '<button id ="delete" type="button" name="delete" class="btn btn-danger btn-block btn-lg">Delete</button>'+
                                '</div>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<label for="Soal">Soalan</label>'+
                                '<input type="text" name="psoal[]" class="form-control form-control-lg" autocomplete="off" required>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<label for="Jaw">Jawapan</label>'+
                                '<div class="form-check">'+
                                    '<input type="radio" class="form-check-input" name="'+radio+'" id="pilihradio" value="A">'+
                                        '<div class="form-group">'+
                                            '<input type="text" name="ppilih[]" class="form-control form-control-lg" autocomplete="off" required>'+
                                        '</div>'+
                                '</div>'+
                                '<div class="form-check">'+
                                    '<input type="radio" class="form-check-input" name="'+radio+'" id="pilihradio" value="B">'+
                                        '<div class="form-group">'+
                                            '<input type="text" name="ppilih[]" class="form-control form-control-lg" autocomplete="off" required>'+
                                        '</div>'+
                                '</div>'+
                                '<div class="form-check">'+
                                    '<input type="radio" class="form-check-input" name="'+radio+'" id="pilihradio" value="C">'+
                                        '<div class="form-group">'+
                                            '<input type="text" name="ppilih[]" class="form-control form-control-lg" autocomplete="off" required>'+
                                        '</div>'+
                                '</div>'+
                                '<div class="form-check">'+
                                    '<input type="radio" class="form-check-input" name="'+radio+'" id="pilihradio" value="D">'+
                                        '<div class="form-group">'+
                                            '<input type="text" name="ppilih[]" class="form-control form-control-lg" autocomplete="off" required>'+
                                        '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'
                        ); 
                    }
                    $(document).on('click', '#delete', function() {
                        index = index - 1;
                        $(this).closest('.soalan').remove();
                        var index2 = 1;
                        var newelement = $('.soalan');
                        $(newelement).each(function() {
                            $(this).find('.NoSoal').text(index2);
                            var radio = "pilihradio"+index2;
                            $(this).find('.form-check-input').attr('name', radio);
                            index2++;
                        });
                    });
                    </script>
                    <div class="form-group">
                        <button id ="quizsubmit-btn" type="submit" name="quiz-submit-btn" class="btn btn-primary btn-block btn-lg">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
