<!DOCTYPE html>
<html>
<head>
<title>Insert Data Without Refresh</title>
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
</head>
<script>
    $(document).ready(function(){
        $('#myForm').submit(function(){
        return false;
        });

        $('#submit').click(function(){
            $.post(
                $('#myForm').attr('action'),
                $('#myForm :input').serializeArray(),
                function(result){
                    $('#result').html(result);
                }
            )
        });
    });
</script>
<body>
    <form action="db.php" id="myForm" method="post">
    Username: <input id="NoP" type="text" name="NoP"/><br>
    Role: <input id="Peranan" type="text" name="Peranan"/><br>
    <button id="submit">Save</button>
    </form>

    <span id="errors"></span>
    <span id="result"></span>
</body>
</html> 