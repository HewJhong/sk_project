<?php require_once 'authController.php'; ?>

<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
    <script
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>
    </head>
    <body>

    <div class="newquiz-container">
        <div class="row"></div>
            <div id="quiz-form-div "class="quiz-form-div" method="post">
                <!-- <form action="adminmain.php" method="post"> -->
                <form method="post" id="addquizform" action="kuizdb.php">
                <script>
                    $(document).ready(function(){
                        $('#addquizform').submit(function(){
                            return false;
                        });

                        $('#quizsubmit-btn').click(function(){
                            $.post(
                                $('#addquizform').attr('action'),
                                $('#addquizform :input').serializeArray(),
                                function(result){
                                    $('#result').html(result);
                                }
                            )
                        })
                    });
                </script>
                    <h3 class="text-center">Tambah Kuiz Baharu</h3>

                    <!-- errors alert box -->
                    <?php if(count($errors) > 0): ?>
                    <div class="alert alert-danger">
                    <?php foreach($errors as $error):?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach;?>
                    </div>
                    <?php endif ?>

                    <span id="result"></span>
                    <div id="container">
                    <div class="form-group">
                        <label for="topik">Topik</label>
                        <input type="text" name="topik" class="form-control form-control-lg" autocomplete="off" required>
                    </div>
                    <div class="soalan">
                    <div class="row">
                    <div class="form-group col-md-10">
                        <label for="nosoal">No Soalan</label>
                        <p class="nosoal">1</p>
                    </div>
                    <div class="form-group col-md-2 delete-btn">
                        <button id="delete" type="button" name="delete" class="btn btn-danger btn-block btn-lg">Delete</button>
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="soal">Soalan</label>
                        <input type="text" name="psoal[]" class="form-control form-control-lg" autocomplete="off" required >
                    </div>
                    <div class="form-group">
                        <label for="jaw">Jawapan</label>
                        <input type="text" name="ppilih[]" class="form-control form-control-lg" autocomplete="off" required>
                        <input type="text" name="ppilih[]" class="form-control form-control-lg" autocomplete="off" required>
                    </div>
                    </div>
                    </div>
                    <!-- Question Format -->
                    <!-- <div class="form-group">
                        <label for="nosoal">No Soalan</label>
                        <p class="nosoal"><?php echo $nosoal; ?></p>
                    </div>
                    <div class="form-group">
                        <label for="soal">Soalan</label>
                        <input type="text" name="soal[]" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <label for="jaw">Jawapan</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="pilihradio[]" id="pilihradio" value="1">
                            <label for="pilih1" class="form-check-label"></label>
                            <div class="form-group">
                                <input type="text" name="pilih[]" class="form-control form-control-lg">
                            </div>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="pilihradio[]" id="pilihradio" value="1">
                            <label for="pilih2" class="form-check-label"></label>
                            <div class="form-group">
                                <input type="text" name="pilih[]" class="form-control form-control-lg">
                            </div>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="pilihradio[]" id="pilihradio" value="1">
                            <label for="pilih3" class="form-check-label"></label>
                            <div class="form-group">
                                <input type="text" name="pilih[]" class="form-control form-control-lg">
                            </div>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="pilihradio[]" id="pilihradio" value="1">
                            <label for="pilih4" class="form-check-label"></label>
                            <div class="form-group">
                                <input type="text" name="pilih[]" class="form-control form-control-lg">
                            </div>
                        </div>
                    </div> -->
                    <!-- click to add question button here -->
                    <div class="form-group">
                        <div class="col-19"></div>
                        <button id="add-btn" onclick="addques()" type="button" name="addQuestion" class="btn btn-primary btn-lg col-1"> + </button>
                    </div>
                    <script>
                    var index = 1;
                    function addques() {
                        index++;
                        $('#container').append(
                        '<div class="soalan">'+
                            '<div class="row">'+
                                '<div class="form-group col-md-10">'+
                                    '<label for="nosoal">No Soalan</label>'+
                                    '<p class="nosoal">'+index+'</p>'+
                                '</div>'+
                                '<div class="form-group col-md-2 delete-btn">'+
                                    '<button id ="delete" type="button" name="delete" class="btn btn-danger btn-block btn-lg">Delete</button>'+
                                '</div>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<label for="soal">Soalan</label>'+
                                '<input type="text" name="psoal[]" class="form-control form-control-lg" autocomplete="off" required>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<label for="jaw">Jawapan</label>'+
                                '<input type="text" name="ppilih[]" class="form-control form-control-lg" autocomplete="off" required>'+
                                '<input type="text" name="ppilih[]" class="form-control form-control-lg" autocomplete="off" required>'+
                            '</div>'+
                        '</div>'
                        ); 
                    }
                    document.ready(function() {
                        $(document).on('click', '#delete', function() {
                            index--;
                            $(this).closest('.soalan').remove();
                            var index2 = 1;
                            var newelement = $('#container');
                            $(newelement).each(function() {
                                $(this).find('.nosoal').text(index2);
                                index++;
                            });
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
