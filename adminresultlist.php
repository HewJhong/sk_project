<?php require_once 'authController.php' ?>
<!DOCTYPE html>
<html>
<head>
<script src="changepage.js"></script>
</head>
<script>
    $(document).ready(function() {
        $.ajax({
            type: "GET",
            url: "adminresultlistdb.php",
            dataType: "html",
            success: function(response) {
                $("#responsecontainer").html(response);
            }
        });
    });
    $(document).on('click', '.infolanjut-btn', function() {
        var id = this.id;
        $.ajax({
            type: "POST",
            url: "adminresultlistinfodb.php",
            data: {
            'id': id,
            }, 
            success: function(response) {
                $("#responsecontainer").html(response);
            }
        });
    });
</script>
<body>
    <div id="responsecontainer"></div>
</body>
</html>