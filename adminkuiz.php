<?php require_once 'authController.php'; ?>

<!DOCTYPE html>
<html>
    <head></head>
    <body>
    <div class="newquiz-container">
        <div class="row">
            <div id="quiz-form-div "class="quiz-form-div">
                <form id="container" action="signup.php" method="post">
                    <h3 class="text-center">Tambah Kuiz Baharu</h3>

                    <?php if(count($errors) > 0): ?>
                    <div class="alert alert-danger">
                    <?php foreach($errors as $error):?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach;?>
                    </div>
                    <?php endif ?>

                    <div class="form-group">
                        <label for="topik">Topik</label>
                        <input type="text" name="topik[]" value="<?php echo $topik;?>" class="form-control form-control-lg" autocomplete="off";>
                    </div>
                    <br>
                    <div class="soal1">

                    </div>
                    <div class="form-group">
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
                    </div>
                    <div class="form-group addques-btn">
                        <div class="col-9"></div>
                            
                    </div>
                    <script>
                        var counter = 1;
                        function addQues() {
                        counter = counter + 1;
                        var btn = document.createElement("BUTTON");
                        btn.classList.add("collapsible");
                        btn.textContent = "Click Me";
                        var div = document.createElement("div");
                        div.classList.add("content");
                        var text_container = document.createElement("P");
                        var text = document.createTextNode("Hello World");
                        text_container.appendChild(text);
                        div.appendChild(text_container)
                        var container = document.getElementById("container");   
                        container.appendChild(btn);
                        container.appendChild(div);
                        }
                    </script>
                    <div class="form-group">
                        <button type="submit" name="quiz-submit-btn" class="btn btn-primary btn-block btn-lg">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
