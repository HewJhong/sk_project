<?php require_once 'authController.php'; ?>

<!DOCTYPE html>
<html>
    <head></head>
    <body>
    <div class="newquiz-container">
        <div class="row">
            <div id="quiz-form-div "class="quiz-form-div">
                <form id="container" action="adminmain.php" method="post">
                    <h3 class="text-center">Tambah Kuiz Baharu</h3>

                    <?php if(count($errors) > 0): ?>
                    <div class="alert alert-danger">
                    <?php foreach($errors as $error):?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach;?>
                    </div>
                    <?php endif ?>
                    <div id="container">
                    <div class="form-group">
                        <label for="nosoal">No Soalan</label>
                        <p class="nosoal"><?php echo $nosoal; ?></p>
                    </div>
                    <div class="form-group">
                        <label for="soal">Soalan</label>
                        <input type="text" name="psoal[]" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <label for="jaw">Jawapan</label>
                        <input type="text" name="ppilih[]" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <label for="nosoal">No Soalan</label>
                        <p class="nosoal"><?php echo $nosoal; ?></p>
                    </div>
                    <div class="form-group">
                        <label for="soal">Soalan</label>
                        <input type="text" name="psoal[]" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <label for="jaw">Jawapan</label>
                        <input type="text" name="ppilih[]" class="form-control form-control-lg">
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
                        <button onclick="addques()" type="button" name="addQuestion" class="btn btn-primary btn-lg col-1"> + </button>
                    </div>
                    <script>
                        function addques() {
                        var btn = document.createElement("BUTTON");
                        btn.classList.add("collapsible");
                        btn.textContent = "Click Me";
                        var soallabel1 = document.createElement("label");
                        label.setAttribute("for","nosoal");
                        label.textContent("text");
                        var soalinput = document.createElement("input");
                        var soaldiv = document.createElement("div");
                        soaldiv.textContent("text");
                        var container = document.getElementById("container");
                        container.appendChild(btn)
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
