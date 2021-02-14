<?php require_once 'authController.php'; ?>
<!DOCTYPE html>
<html>
<head>
</head>
<script>
$(document).ready(function() {
    $.ajax({
        type: "GET",
        url: "userinfodb.php",
        dataType: "html",
        success: function(response) {
            $("#responsecontainer").html(response);
        }
    });
});
</script>
<div id="responsecontainer"></div>
</body>
</html> 