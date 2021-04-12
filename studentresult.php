<?php require_once 'authController.php' ?>
<!DOCTYPE html>
<html>
<head>
</head>
<script>
    $(document).ready(function() {
        $.ajax({
            type: "GET",
            url: "studentresultdb.php",
            dataType: "html",
            success: function(response) {
                $("#responsecontainer").html(response);
            }
        });
    });
    $(document).on('click', '.review-kuiz-btn', function() {
        var id = this.id;
        $.ajax({
            url: 'studentkuizreview.php',
            type: 'POST',
            data: {'id':id},
            success: function(result){
                $("#responsecontainer").html(result);
                console.log("Success");
            }
        });
    });
    $(document).on('click', '#balik-btn', function() {
        studentresult();
    });
</script>
<body>
    <div class="rekod-list-div" id="responsecontainer"></div>
</body>
</html>