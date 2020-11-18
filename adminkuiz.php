<?php require_once 'authController.php'; ?>

<DOCTYPE html>
<html>
    <head></head>
    <body style="overflow-x: hidden;">
    <div class="newquiz-container scrollbar-inner">
        <div class="row">
            <div class="quiz-form-div">
                <form action="signup.php" method="post">
                    <h3 class="text-center">Tambah Kuiz Baharu</h3>

                    <?php if(count($errors) > 0): ?>
                    <div class="alert alert-danger">
                    <?php foreach($errors as $error):?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach;?>
                    </div>
                    <?php endif ?>

                    <div class="form-group">
                        <label for="username">No. Pengguna</label>
                        <input type="text" name="nop" value="<?php echo $nop;?>" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" value="<?php echo $name;?>" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <label for="notel">Nombor Telefon</label>
                        <input type="text" name="notel" value="<?php echo $notel;?>" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <label for="password">Kata Laluan</label>
                        <input type="password" name="password" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <label for="passwordConf">Sahkan Kata Laluan</label>
                        <input type="password" name="passwordConf" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="signup-btn" class="btn btn-primary btn-block btn-lg">Sign Up</button>
                    </div>
                    <div class="form-group">
                        <label for="username">No. Pengguna</label>
                        <input type="text" name="nop" value="<?php echo $nop;?>" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" value="<?php echo $name;?>" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <label for="notel">Nombor Telefon</label>
                        <input type="text" name="notel" value="<?php echo $notel;?>" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <label for="password">Kata Laluan</label>
                        <input type="password" name="password" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <label for="passwordConf">Sahkan Kata Laluan</label>
                        <input type="password" name="passwordConf" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="signup-btn" class="btn btn-primary btn-block btn-lg">Sign Up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
