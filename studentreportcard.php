<!DOCTYPE html>
<html>
<head>
</head>
<script>
$(document).ready(function() {
    $.ajax({
        type: "GET",
        url: "studentreportdb.php",
        dataType: "html",
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